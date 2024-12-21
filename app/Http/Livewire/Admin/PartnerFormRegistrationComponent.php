<?php

namespace App\Http\Livewire\Admin;

use App\Helpers\UmHelp;
use App\Models\Directions;
use App\Models\PartnerFormRegistration;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Lukeraymonddowning\Honey\Facades\Honey;
use Lukeraymonddowning\Honey\Traits\WithHoney;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;
use PDF;
class PartnerFormRegistrationComponent extends Component
{
    use WithRecaptcha;
    use WithHoney;
    public $partner_type;
    public $direction;
    public $city_name;
    public $org_full_name;
    public $org_short_name;

    public $legal_address;
    public $actual_address;
    public $post_address;
    public $shop_name;

// ООО
    public $director_name;
    public $bohalter_name;
    public $kpp;
    public $ogrn;
//    ИП
    public $ogrn_ip;

//  Самозанятый
    public $fio;
    public $passport_data;
    public $reg_address;
    public $fact_actual_address;
    public $who_gave;

    //for all
    public $inn;
    public $bank_name;
    public $bank_account;
    public $kor_account;
    public $bik;
    public $email;
    public $org_tel;
    public $mobile_tel_owner;
    public $socials;
    public $delivery_address;
    public $delivery_price;




    protected $validationAttributes = [
        'direction' => 'Сфера услуг/товаров',
        'city_name' => 'Город',
        'org_full_name' => 'Полное наименование',
        'org_short_name' => 'Сокращенное наименование',
        'shop_name'=> 'Название магазина',
        'legal_address' => 'Юридический адрес',
        'actual_address' => 'Фактический адрес',
        'post_address' => 'Почтовый адрес',
        'director_name' => 'Генеральный Директор',
        'bohalter_name' => 'Главный бухгалтер',
        'kpp' => 'КПП',
        'ogrn' => 'ОГРН',
        'ogrn_ip' => 'ОГРНИП',
        'fio' => 'ФИО',
        'passport_data' => '№ и серия Паспорта',
        'reg_address' => 'Адрес регистрации',
        'fact_actual_address' => 'адрес ведения деятельности',
        'who_gave' => 'Кем выдан',
        'inn' => 'ИНН',
        'bank_name' => 'Наименование Банка',
        'bank_account' => 'Расчетный счет',
        'kor_account' => 'Корреспондентский счет',
        'bik' => 'БИК',
        'email' => 'email адрес',
        'org_tel' => 'Телефон',
        'mobile_tel_owner' => 'Мобильный телефон',
        'socials' => 'Социальные сети',
        'delivery_address' => 'Адрес самовывоза',
        'delivery_price' => 'Цена доставки',
    ];

    protected function rules()
    {
        //ООО rules
        $rules = [
            'direction' => 'required|max:150|min:3',
            'city_name' => 'required|max:170|min:3',
            'org_full_name' => 'required|max:150|min:3',
            'org_short_name' => 'required|max:150|min:3',
            'legal_address' => 'required|max:150|min:3',
            'shop_name' => 'required|max:150',
            'actual_address' => 'required|max:150|min:3',
            'post_address' => 'required|max:150|min:',
            'director_name' => 'max:150|min:5',
            'bohalter_name' => 'max:150|min:5',
            'kpp' => 'required|digits:9',
            'ogrn' => 'required|digits:13',
            'inn' => 'required|min:10|max:12',
            'bank_name' => 'required|max:50|min:3',
            'bank_account' => 'required|digits:20',
            'kor_account' => 'required|digits:20',
            'bik' => 'required|digits:9',
            'email' => 'required|max:150|min:5|email',
            'org_tel' => 'required|min:10|max:15',
            'mobile_tel_owner' => 'required|min:10|max:15',
            'socials' => 'max:255|',
            'delivery_address' => 'required|max:150',
            'delivery_price' => 'required|min:1|numeric',
        ];
        if ($this->partner_type == 'ipr') {

            $rules['ogrn_ip'] = 'required|digits:15';
//            unset($rules['org_tel']);
            unset($rules['director_name']);
            unset($rules['bohalter_name']);
            unset($rules['kpp']);
            unset($rules['ogrn']);
        } elseif ($this->partner_type == 'sam') {
            $rules['fio'] = 'required|max:150|min:5';
            $rules['passport_data'] = 'required|max:70|min:7';
            $rules['reg_address'] = 'required|max:200|min:10';
            $rules['fact_actual_address'] = 'required|max:200|min:5';
            $rules['who_gave'] = 'required|max:200|min:5';

            unset($rules['org_tel']);
            unset($rules['director_name']);
            unset($rules['bohalter_name']);
            unset($rules['kpp']);
            unset($rules['ogrn']);
            unset($rules['legal_address']);
            unset($rules['actual_address']);
            unset($rules['org_full_name']);
            unset($rules['org_short_name']);
        }
//        dd($rules);
        return $rules;
    }


    public function mount()
    {
        $this->partner_type = false;


//        $this->partner_type = 'ooo';
        // $this->direction = 'Доставка цветов';
//        $this->city_name = 'city_test';
//        $this->org_full_name = 'full_name_test';
//        $this->org_short_name = 'org_short_name  test';
//        $this->legal_address = 'legal_address  test';
//        $this->actual_address = 'actual_address  test';
//        $this->post_address = 'post_address  test';
//        $this->director_name = 'director_name  test';
//        $this->bohalter_name = 'bohalter_name  test';
//        $this->kpp = '111111111';
//        $this->ogrn = '1111111111113';
//        $this->shop_name = 'Магазин тест';
//        $this->ogrn_ip = '111111111111111';
//
//        $this->fio = 'Иванов Иван Иваныч';
//        $this->passport_data = '55487845';
//        $this->reg_address = 'ул. Завававава';
//        $this->fact_actual_address = 'ул. фвыафвыафыва';
//        $this->who_gave = 'Мвд Рос';
//        $this->inn = '1111111110';
//        $this->bank_name = 'Тинькофф';
//        $this->bank_account = '22222222222222222220';
//        $this->kor_account = '22222222222222222220';
//        $this->bik = '999999999';
//        $this->email = 'test@email.ru';
//        $this->org_tel = '78888888889';
//        $this->mobile_tel_owner = '7888888888';
//        $this->socials = 'vk.com';
//        $this->delivery_address = 'Ул. Самовывоза для теста';
//        $this->delivery_price = '200';

    }

    public function updated($field)
    {
        $this->validateOnly($field);
//        dd($val);
    }


    public function sendPartnerData()
    {
//        dd(request()->all());
//        $token = request()->all();
//        $token = request()->get('serverMemo')['data']['honeyInputs']['honey_recaptcha_token'];
//        dd($token);
//        $score = Honey::recaptcha()->checkToken($token);
//        dd($score);
//        $score = Honey::recaptcha()->check($token)['score'];
//        dd($noSpam);
        $this->validate();
        if($this->honeyPasses())
        {
//            $val = $this->valid_field =

            if ($this->partner_type == 'ooo') {
                $Partner = PartnerFormRegistration::create([
                    "partner_type" => 'ООО',
                    "user_id" => Auth::id(),
                    "direction" => $this->direction,
                    "city_name" => $this->city_name,
                    "org_full_name" => $this->org_full_name,
                    "org_short_name" => $this->org_short_name,
                    "shop_name" => $this->shop_name,
                    "legal_address" => $this->legal_address,
                    "actual_address" => $this->actual_address,
                    "post_address" => $this->post_address,
                    "director_name" => $this->director_name,
                    "bohalter_name" => $this->bohalter_name,
                    "kpp" => $this->kpp,
                    "ogrn" => $this->ogrn,
                    "inn" => $this->inn,
                    "bank_name" => $this->bank_name,
                    "bank_account" => $this->bank_account,
                    "kor_account" => $this->kor_account,
                    "bik" => $this->bik,
                    "email" => $this->email,
                    "org_tel" => $this->org_tel,
                    "mobile_tel_owner" => $this->mobile_tel_owner,
                    "socials" => $this->socials,
                    "delivery_address" => $this->delivery_address,
                    "delivery_price" => $this->delivery_price,
                ]);
            } elseif ($this->partner_type == 'ipr') {
                $Partner = PartnerFormRegistration::create([
                    "partner_type" => 'ИП',
                    "user_id" => Auth::id(),
                    "direction" => $this->direction,
                    "city_name" => $this->city_name,
                    "shop_name" => $this->shop_name,
                    "org_full_name" => $this->org_full_name,
                    "org_short_name" => $this->org_short_name,
                    "legal_address" => $this->legal_address,
                    "actual_address" => $this->actual_address,
                    "post_address" => $this->post_address,
                    "inn" => $this->inn,
                    "bank_name" => $this->bank_name,
                    "bank_account" => $this->bank_account,
                    "kor_account" => $this->kor_account,
                    "bik" => $this->bik,
                    "email" => $this->email,
                    "mobile_tel_owner" => $this->mobile_tel_owner,
                    "socials" => $this->socials,
                    "delivery_address" => $this->delivery_address,
                    "delivery_price" => $this->delivery_price,
                    "org_tel" => $this->org_tel,
                    "ogrn_ip" => $this->ogrn_ip,
                ]);
            } elseif ($this->partner_type == 'sam') {
                $Partner = PartnerFormRegistration::create([
                    "partner_type" => 'Самозанятый',
                    "user_id" => Auth::id(),
                    "direction" => $this->direction,
                    "city_name" => $this->city_name,
                    "shop_name" => $this->shop_name,
                    "post_address" => $this->post_address,
                    "inn" => $this->inn,
                    "bank_name" => $this->bank_name,
                    "bank_account" => $this->bank_account,
                    "kor_account" => $this->kor_account,
                    "bik" => $this->bik,
                    "email" => $this->email,
                    "mobile_tel_owner" => $this->mobile_tel_owner,
                    "socials" => $this->socials,
                    "delivery_address" => $this->delivery_address,
                    "delivery_price" => $this->delivery_price,
                    "fio" => $this->fio,
                    "passport_data" => $this->passport_data,
                    "reg_address" => $this->reg_address,
                    "actual_address" => $this->fact_actual_address,
                    "who_gave" => $this->who_gave,
                ]);
            }
            if(!$Partner) return;
            UmHelp::sendTelegramToManager($Partner->getAttributes(),'ДАННЫЕ ФОРМЫ РЕГИСТРАЦИИ ПАРТНЕРА', config('telegram.chats.applications'));

            session()->flash('success','yes');
            $this->reset();
//            $this->partner_type = 'ooo';
        }
        else
        {
            Log::warning("A bot is trying to access partner form.");
            return;
        }
    }



    public function render()
    {
        $directions = Directions::all();
        $cities = Store::all()->sortBy('real_name');
        $user_check = PartnerFormRegistration::where('user_id', Auth::id())->first();
//        dd($user_check);
        if ($user_check)
        {


            return view('livewire.admin.partner-form-alredy-component', compact('user_check'))->layout('layouts.base');
        }
        return view('livewire.admin.partner-form-registration-component', compact('directions', 'cities'))->layout('layouts.base');
    }
}
