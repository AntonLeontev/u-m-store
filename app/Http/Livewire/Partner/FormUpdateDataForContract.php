<?php

namespace App\Http\Livewire\Partner;
use App\Helpers\UmHelp;
use App\Models\Directions;
use App\Models\Partner\DeliveryAddresses;
use App\Models\PartnerFormRegistration;
use App\Models\Partners;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithHoney;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class FormUpdateDataForContract extends Component
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

    public $partner_id;

    protected $validationAttributes = [
        'direction' => 'Сфера услуг/товаров',
        'city_name' => 'Город',
        'org_full_name' => 'Полное наименование',
        'org_short_name' => 'Сокращенное наименование',
        'shop_name' => 'Название магазина',
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
            'org_full_name' => 'required|max:150|min:30',
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
        $this->partner_type = 'ipr';
        $partner = Partners::where('user_id', Auth::id())->first();
//        dd(Auth::id());
        if ($partner) {
            $this->partner_id = $partner->id;
            $delivery_address = DeliveryAddresses::where('partner_id', $this->partner_id)->first();
            if($delivery_address)
            {
                $this->delivery_address=$delivery_address->address;
            }
            $this->city_name = Store::find($partner->store_id)->real_name;

            $this->direction = 'Доставка цветов';
            if ($this->partner_type == 'ipr') {
                $this->org_full_name = 'Индивидуальный предприниматель' . Str::after($partner->partner_name, 'ИП');
            }
//            if($partner_id != 123 and $partner_id !=44)
//            {
//                $this
//            }

            $this->org_short_name = $partner->partner_name;
            $this->legal_address = $partner->legal_address;
            $this->actual_address = $partner->actual_address;
            $this->post_address = $partner->post_address;
            $this->kpp = $partner->kpp;
            $this->shop_name = $partner->organisation_name;
            $this->ogrn_ip = $partner->ogrn_ip;
            if (!$this->ogrn_ip) $this->ogrn_ip =$partner->orgn_ip;

//        $this->fio = 'Иванов Иван Иваныч';
//        $this->reg_address = 'ул. Зава';
//        $this->fact_actual_address = 'ул.';
//        $this->who_gave = 'Мвд Рос';
            $this->bank_name=$partner->bank_name;
            $this->inn = $partner->inn;
            $this->bank_account = $partner->bank_account;
            $this->kor_account = $partner->kor_account;
            $this->bik = $partner->bik;
            $this->email = $partner->email;
            $this->org_tel = $partner->telephone;
            $this->mobile_tel_owner = $partner->mobile_tel_owner;
            $this->socials = $partner->socials;
            $this->delivery_price = $partner->delivery_price;
        }
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
        if ($this->honeyPasses()) {
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
                    "status" => 'UPDATE_OLD',
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
                    "status" => 'UPDATE_OLD',
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
                    "status" => 'UPDATE_OLD',
                ]);
            }
            if (!$Partner) return;
            $this->UpdatePartner($Partner, $this->partner_id);
            UmHelp::sendTelegramToManager($Partner->getAttributes(), 'Обновлены данные ПАРТНЕРА через форму');

            session()->flash('success', 'yes');
            $this->reset();
//            $this->partner_type = 'ooo';
        } else {
            Log::warning("A bot is trying to access partner form.");
            return;
        }
    }

    public function UpdatePartner($Partner, $partner_id)
    {
        $partner_update = Partners::where('id', $partner_id)->first();
        if ($partner_update) {
            $partner_update->update([
                'partner_type' => $Partner->partner_type,
                'user_id' => $Partner->user_id,
                'organisation_name' => $Partner->shop_name,
                'org_full_name' => $Partner->org_full_name,
                'partner_name' => $Partner->org_short_name,
                'director_name' => $Partner->director_name,
                'bohalter_name' => $Partner->bohalter_name,
                'telephone' => $Partner->org_tel,
                'mobile_tel_owner' => $Partner->mobile_tel_owner,
                'email' => $Partner->email,
                'socials' => $Partner->socials,
                'bank_name' => $Partner->bank_name,
                'kpp' => $Partner->kpp,
                'inn' => $Partner->inn,
                'ogrn' => $Partner->ogrn,
                'ogrn_ip' => $Partner->ogrn_ip,
                'bik' => $Partner->bik,
                'kor_account' => $Partner->kor_account,
                'bank_account' => $Partner->bank_account,
                'legal_address' => $Partner->legal_address,
                'actual_address' => $Partner->actual_address,
                'post_address' => $Partner->post_address,
                'markup' => 17.7,
                'delivery_price' => $Partner->delivery_price,
                'fio' => $Partner->fio,
                'passport_data' => $Partner->passport_data,
                'reg_address' => $Partner->reg_address,
                'who_gave' => $Partner->who_gave,
                'delivery_address' => $Partner->delivery_address

            ]);
            if($Partner->delivery_address)
            {
//                dd($Partner->delivery_address);
                DeliveryAddresses::updateOrCreate(
                    ['partner_id' => $this->partner_id],
                    ['address'=> $Partner->delivery_address, 'status'=>1]
                );
            }
        }
    }


    public function render()
    {
        if (Auth::user()->partner_id) {
            $directions = Directions::all();
            $cities = Store::all()->sortBy('real_name');
            $user_check = PartnerFormRegistration::where('user_id', Auth::id())->first();
//        dd($user_check);
            if ($user_check) {
                return view('livewire.admin.partner-form-alredy-component', compact('user_check'))->layout('layouts.base');
            }
            return view('livewire.partner.form-update-data-for-contract', compact('directions', 'cities'))->layout('layouts.base');
        } else {
            return view('livewire.partner.you-not-status-parner-componet')->layout('layouts.base');
        }

    }
}
