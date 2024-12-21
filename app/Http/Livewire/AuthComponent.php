<?php

namespace App\Http\Livewire;

use App\Models\Notifications;
use App\Models\User;
use App\Models\UserDetails\ReferralUser;
use App\Services\SmsService;
use Carbon\Carbon;
use Composer\DependencyResolver\Request;
use http\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Manny\Manny;
use stdClass;
use function Symfony\Component\Translation\t;

class AuthComponent extends Component
{
    public $code;
    public $phone;
    public $mail;
    public $user_id;
    public $get_code = false;
    public $submit_method;
    public $counter = 0;
    public $referral_slug;

    public $reCaptcha;
    public $token;
    protected $listeners = ['phoneReady', 'phoneNotReady','resendCode', 'back'];



public function mount($referral_slug = 0)
{
    if(Auth::check()) $this->redirect(url()->previous());

    if(session()->has('user') && isset(session('user')['phone']))
    {
        $user = User::firstWhere('phone', session('user')['phone']);
        if($user && session('user')['phone'] == $user->phone)
        {
            $this->phone = session('user')['phone'];
            $this->user_id = $user->id;
            $this->submit_method = 'wire:submit.prevent=login()';
        }
        else
        {
            $this->submit_method = 'wire:submit.prevent=sendCode()';
        }
    }
    else
    {
        $this->submit_method = 'wire:submit.prevent=sendCode()';
    }
    if($referral_slug)
    {
        $this->referral_slug = $referral_slug;
    }
}

protected function rules()
    {
        $rules = [
            'phone' => 'required|min:15'
        ];
        if($this->code)
        {
            $rules['code'] = 'required|min:4';
        }
        return $rules;
    }


//    public function captcha()
//    {
//
//        $score = (new RecaptchaV3)->verify($request->get('g-recaptcha-response'), 'phone');
//        if($score > 0.7) {
//            dd($request);
//            } elseif($score > 0.3) {
//            dd($request);
//            } else {
//                return abort(400, 'You are most likely a bot');
//        }
//
//    }
// validate phone when user input
public function phoneMask()
{

    if(strlen($this->phone) > 9) {
        $arr = str_split($this->phone);
        if($arr[0] != 7)
        {
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
    }
    else
    {
        $this->emit('phoneNotReady');
    }

}

// login user or create new user
protected function setUser()
{
     $new_user= User::firstWhere('phone', session('user')['phone']);

    if($new_user)
    {

        Auth::loginUsingId($new_user->id, true);
    }
    else
    {
        $new_user = new User();
        $new_user->phone = session('user')['phone'];
        $new_user->password = Hash::make(Str::random(8));
        $new_user->utype = 'USR';
        $new_user->referral_slug = Str::random(12);
        $new_user->bonuses_per_user = '500';


        $new_user->save();
        //if user follow the referral link
        if($this->referral_slug)
        {
            $ref_user = User::firstWhere('referral_slug', $this->referral_slug);
            if($ref_user)
            {
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
        $new_notification->date= Carbon::parse(Carbon::now())->format('d.m.Y');
        $new_notification->save();
        Auth::loginUsingId($new_user->id, true);
    }

    if(session()->has('previous_url')) {
        $this->redirect(session('previous_url'));
    }
    else
    {
        $this->redirect('/');
    }
}


protected function getUser($user_id)
{
    if($this->sendCode())
    {
        Auth::loginUsingId($user_id, true);
    }
}

// get code and validate from input user
public function getCode()
{
    $this->code = Manny::mask($this->code, '1111');
    if(session('user')['code'] == $this->code) {
//        session()->flash('error_code', 'Верный код');
        $this->setUser();
    }
    else if($this->validateOnly('code'))
    {
        session()->flash('error_code', 'Не верный код');
    }
}


// send and get code to sms service
public function sendCode()
{


//    $score = RecaptchaV3::verify($this->token, 'sendCode');
//    if($score > 0.7) {
////        dd($score);
//    } elseif($score > 0.3) {
//
//    } else {
//        $this->reCaptcha = true;
//        $this->emit('phoneReady');
//        return false;
//    }


    $this->validate();

        $new_code = rand(1000, 9999);
        $smsru = new SmsService('B0C4B1BB-CF6C-9D8E-408F-753E14ECE28D'); // Ваш уникальный программный ключ, который можно получить на главной странице

        $data = new stdClass();
        $data->to = $this->phone;
        $data->text = $new_code; // Текст сообщения
        $data->from = 'UnitedM'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
    // $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
    // $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
//       $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
    // $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
        $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную
        if ($sms->status == "OK") { // Запрос выполнен успешно
    //        echo "Сообщение отправлено успешно. ";
    //        echo "ID сообщения: $sms->sms_id. ";
    //        echo "Ваш новый баланс: $sms->balance";
            session()->put('user', ['phone'=> $this->phone, 'code' => $new_code]);
            return true;
        } else {
//            dd($sms->status);
    //        echo "Сообщение не отправлено. ";
    //        echo "Код ошибки: $sms->status_code. ";
    //        echo "Текст ошибки: $sms->status_text.";
            $this->emit('phoneNotReady');
            session()->put('phone-error', 'Не верный номер');
            return false;
    }

}

public function resendCode() {

   if(session()->has('resend'))
   {
       if(session('resend') < 3)
       {
           $count = session('resend') + 1;
           session()->put('resend', $count);
           $this->sendCode();
       }
       else
       {
           $body = file_get_contents("https://sms.ru/callcheck/add?api_id=B0C4B1BB-CF6C-9D8E-408F-753E14ECE28D&phone=380996085890&json=1");
           $res = json_decode($body);
          if($res->status == "OK")
          {
              session()->put('callback',
                  [
                      'message' => 'Если не приходит смс с кодом, позвоните на бесплатный номер для авторизации',
                      'phone' => $res->call_phone_html
                  ]);
          }
       }
   }
   else
       {
           session()->put('resend', 1);
           $this->sendCode();
       }

   if(session()->has('back'))
   {
       session()->forget('back');
   }
}

//listeners
public function phoneReady(){}
public function phoneNotReady(){}

// when user click back arrow
public function back()
{
    session()->forget('callback');
    session()->forget('resend');
    session()->forget('user');
    session()->put('back', '');
}
    public function render()
    {
        return view('livewire.auth-component')->layout('layouts.base');
    }
}
