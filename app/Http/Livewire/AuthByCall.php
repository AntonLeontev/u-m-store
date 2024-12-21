<?php

namespace App\Http\Livewire;

use App\Models\FirewallIps;
use App\Models\FirewallLogs;
use App\Models\Notifications;
use App\Models\User;
use App\Models\UserDetails\ReferralUser;
use Carbon\Carbon;
use GreenSMS\GreenSMS;
use GreenSMS\Http\RestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Manny\Manny;

class AuthByCall extends Component
{
    public $code;
    public $phone;
    public $mail;
    public $user_id;
    public $get_code = false;
    public $submit_method;
    public $counter = 0;
    public $referral_slug;
    protected $response;
    public $reCaptcha;
    public $token;

    protected $listeners = ['phoneReady', 'phoneNotReady', 'resendCode', 'back'];
//    protected $dontReport = [
//        RestException::class,
//    ];
    public $count_input_digits;
    protected $count_phone_call;


    public function callePhone()
    {

    }

    public function mount($referral_slug = 0)
    {
        $this->count_input_digits = 0;
//        $this->phone = '7(918) 098 46 56';
//    $this->phone = '7(927) 390 67 57';
        if (Auth::check()) $this->redirect(url()->previous());

        if (session()->has('user') && isset(session('user')['phone'])) {
            $user = User::firstWhere('phone', session('user')['phone']);
            if ($user && session('user')['phone'] == $user->phone) {
                $this->phone = session('user')['phone'];
                $this->user_id = $user->id;
                $this->submit_method = 'wire:submit.prevent=login()';
            } else {
                $this->submit_method = 'wire:submit.prevent=sendCode()';
            }
        } else {
            $this->submit_method = 'wire:submit.prevent=sendCode()';
        }
        if ($referral_slug) {
            $this->referral_slug = $referral_slug;
        }
    }

    protected function rules()
    {
        $rules = [
            'phone' => 'required|min:15'
        ];
        if ($this->code) {
            $rules['code'] = 'required|min:4';
        }
        return $rules;
    }


// validate phone when user input
    public function phoneMask()
    {

        if (strlen($this->phone) > 9) {
            $arr = str_split($this->phone);
            if ($arr[0] != 7) {
                $arr[0] = 7;
                $this->phone = implode('', $arr);

            }

            $this->phone = Manny::mask($this->phone, '1(111) 111 11 11');
            $this->emit('phoneNotReady');

            if ($this->validateOnly('phone')) {
                $this->emit('phoneReady');
            }
            if (session()->has('phone-error')) {
                session()->forget('phone-error');
            }
        } else {
            $this->emit('phoneNotReady');
        }

    }

// login user or create new user
    protected function setUser()
    {
        $new_user = User::firstWhere('phone', session('user')['phone']);

        if ($new_user) {

            Auth::loginUsingId($new_user->id, true);
        } else {
            $new_user = new User();
            $new_user->phone = session('user')['phone'];
            $new_user->password = Hash::make(Str::random(8));
            $new_user->utype = 'USR';
            $new_user->referral_slug = Str::random(12);
            $new_user->bonuses_per_user = '500';


            $new_user->save();
            //if user follow the referral link
            if ($this->referral_slug) {
                $ref_user = User::firstWhere('referral_slug', $this->referral_slug);
                if ($ref_user) {
                    $new_referral = new ReferralUser();
                    $new_referral->ref_user_id = $ref_user->id;
                    $new_referral->user_id = $new_user->id;
                    $new_referral->save();
                }
            }
            $new_notification = new Notifications();
            $new_notification->user_id = $new_user->id;
            $new_notification->url = 'registered';
            $new_notification->title = 'Вы успешно зарегистрировались на Onion Market';
            $new_notification->date = Carbon::parse(Carbon::now())->format('d.m.Y');
            $new_notification->save();
            Auth::loginUsingId($new_user->id, true);
            $new_user->markEmailAsVerified();
        }

        if (session()->has('previous_url')) {
            $this->redirect(session('previous_url'));
        } else {
            $this->redirect('/');
        }
    }


    protected function getUser($user_id)
    {
        if ($this->sendCode()) {
            Auth::loginUsingId($user_id, true);
        }
    }

// get code and validate from input user
    public function getCode(Request $request)
    {

        if ($this->count_input_digits > 3) {
            if (session()->has('resend')) session()->put('resend', 10);
            session()->flash('error_code', 'Превышен лимит попыток ввода!');
            $this->count_input_digits++;
            if ($this->count_input_digits == 5) {

                //Write to the fire wall log
                $firewallLog = new FirewallLogs();
                $firewallLog->ip = $request->ip();
                $firewallLog->level = 'medium';
                $firewallLog->middleware = 'LoginByCall';
                $firewallLog->url = $request->fullUrl();

                $firewallLog->save();

                //Block ip
                $firewallIps = new FirewallIps();
                $firewallIps->ip = $request->ip();
                $firewallIps->log_id = $firewallLog->id;
                $firewallIps->blocked = 1;

                $firewallIps->save();
                return redirect()->to('login');
            }
            return;
        }
        $this->code = Manny::mask($this->code, '1111');
        if (session('user')['code'] == $this->code) {
            session()->flash('allow_code', 'Вход в аккаунт');
            $this->setUser();
        } else if ($this->validateOnly('code')) {
            $this->count_input_digits = $this->count_input_digits + 1;

            session()->flash('error_code', 'Неправильные цифры');
        }
    }


// send and get code to sms service
    public function sendCode()
    {
        if (session()->has('phone_number') and session('phone_number') != $this->phone) {
            session()->forget('phone_number');
            session()->put('resend', 0);
        }
        if (session()->has('resend') and session()->has('phone_number')) {
            session()->put('resend', session('resend') + 1);
        } else session()->put('resend', 1);

        session()->put('phone_number', $this->phone);
        if (session()->has('resend') and session('resend') > 3) {
            session()->put('callback',
                [
                    'message' => 'Если у вас проблемы с авторизацией по звонку. Воспользуйтесь авторизацией через email.',
                    'phone' => '7 800 800 88 88',
                ]);
            return;
        }

        // Phone number digits only
        $phone = Manny::mask($this->phone, '11111111111');

        // Trying to call the phone
		$client = new GreenSMS(['user' => 'svetlanaW', 'pass' => 'Dv6dmTEYLw70']);

		try {
			$this->response = $client->call->send(['to' => $phone]);
		} catch (RestException $e) {
			echo 'Ошибка' . $e->getMessage();
		}
        // $this->response = Http::get('https://umclone.pp.ua/calling/'.$phone);

        // $this->response = json_decode($this->response->body());
        if(!is_object($this->response)) {
            session()->flash('phone-error', 'Видимо слишком много попыток. Воспользуйтесь авторизацией через почту.');
            return false;
        }

        if (strlen($this->response->code) == 4) { // Запрос выполнен успешно
            session()->put('user', ['phone' => $this->phone, 'code' => $this->response->code,
                'request_id' => $this->response->request_id]);
            return true;
        } else {

            $this->emit('phoneNotReady');
            session()->flash('phone-error', 'Не верный номер либо другая ошибка. Воспользуйтесь авторизацией через почту.');
            return false;
        }

    }

    public function resendCode()
    {

        if (session()->has('resend')) {
            if (session('resend') < 3) {
                $count = session('resend') + 1;
                session()->put('resend', $count);
                $this->sendCode();
            } else {

                session()->put('callback',
                    [
                        'message' => 'Если у вас проблемы с авторизацией по звонку. Воспользуйтесь авторизацией через email. Сообщить о проблеме вы можете по номеру',
                        'phone' => '+7 999 333 54 01',

                    ]);
//                }
            }
        } else {
            session()->put('resend', 1);
            $this->sendCode();
        }

        if (session()->has('back')) {
            session()->forget('back');
        }
    }

//listeners
    public function phoneReady()
    {
    }

    public function phoneNotReady()
    {
    }

// when user click back arrow
    public function back()
    {
        $this->count_input_digits = 0;
        session()->forget('callback');
//        session()->forget('resend');
        session()->forget('user');
        session()->put('back', '');
    }

    public function render()
    {
        return view('livewire.auth-by-call')->layout('layouts.base');
    }
}
