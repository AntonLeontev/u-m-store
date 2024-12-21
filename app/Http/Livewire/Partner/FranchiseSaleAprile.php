<?php

namespace App\Http\Livewire\Partner;

use App\Enums\StatusEnum;
use App\Helpers\UmHelp;
use App\Models\Checkout\Order;
use App\Models\Checkout\Transaction;
use App\Models\Directions;
use App\Models\FranchiseRequest;
use App\Models\PartnerFormRegistration;
use App\Models\QuestionsRemainGeneralPartner;
use App\Models\Store;
use App\Services\YookassaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Manny\Manny;

class FranchiseSaleAprile extends Component
{
    public function render(Request $request)
    {
        if($request->utm_source) {
            switch($request->utm_source) {
                case 'ip_1':
                    $operator_name = 'Eкатерина';
                    break;
                case 'ip_4':
                    $operator_name = 'Eвгений';
                    break;
                case 'ip_7':
                    $operator_name = 'Юля';
                    break;
                case 'ip_0':
                    $operator_name = 'Анастасия';
                    break;
                case 'ip_11':
                    $operator_name = 'Ринат';
                    break;
                case 'ip_10':
                    $operator_name = 'Маргарита';
                    break;
                default: $operator_name = 'Оператора нужно зарегистрировать!';
            }

            session()->put('operator', $operator_name);
        }
        $directions = Directions::all();
        $cities = Store::all()->sortBy('real_name');

        return view('livewire.partner.franchise-sale-aprile',
            compact('directions', 'cities'))->layout('layouts.base');
    }

    public $fio;
    public $inn;
    public $ogrn;
    public $kpp;
    public $bik;
    public $kor_account;
    public $bank_account;
    public $legal_address;
    public $actual_address;
    public $phone;
    public $email;


    public $description;
    public $city;
    public $phone_pay;
    public $pay_sum;

    public $questions_name;
    public $questions_phone;
    public $questions_email;
    public $questions_message;

    // массив валидации ген.партнера
    public $general_partner = [];
    // индивидуальный предприниматель организация
    public $individual_business = [];
    // OOO
    public $organization = [];
    // Самозанятый
    public $self_employed = [];

    public function mount()
    {
//        $this->questions_name = 'test_name';
////        $this->questions_phone = '+7 900 000 00 00';
//        $this->questions_email = 'a@a.ru';
//        $this->questions_message = 'Остались вопросы тест.';
//        $this->turnover =0;
//        $this->fio = 'Тест Фамилия';
//        $this->inn = '1111111111';
//        $this->ogrn = '2222222222222';
//        $this->kpp = '999999999';
//        $this->bik = '999999999';
//        $this->kor_account = '99999999999999999920';
//        $this->bank_account = '99999999999999999920';
//        $this->legal_address = 'Юридический Адрес Тест';
//        $this->actual_address = 'Фактический Адрес Тест';
//        $this->phone = '798077785028';
//        $this->email = 'a@a.ru';


        $this->pay_sum = 40000;
//        $this->pay_sum = 1;
        $this->description = 'Оплата Сотрудничества';

    }

    public function questionsRemain()
    {
//        dd($request);
        $this->validate([
            'questions_name' => 'required|max:60',
            'questions_phone' => 'required|max:20',
            'questions_email' => 'required|max:60',
            'questions_message' => 'required|max:250',

        ]);
        #Write to database
        $question = QuestionsRemainGeneralPartner::create([
            'status' => 'CREATE',
            'questions_name' => $this->questions_name,
            'questions_phone' => $this->questions_phone,
            'questions_email' => $this->questions_email,
            'questions_message' => $this->questions_message,
        ]);
        #Send a message to telegram
        $question_arr = $question->toArray();
        $question_arr['Вопрос №'] = $question_arr['id'];
        $question_arr['Источник'] = 'СТРАНИЦА ГЕНЕРАЛЬНОГО ПАРТНЕРА.';
        $question_arr['Имя'] = $question_arr['questions_name'];
        $question_arr['Телефон'] = $question_arr['questions_phone'];
        $question_arr['Email адрес'] = $question_arr['questions_email'];
        $question_arr['Текст сообщения'] = $question_arr['questions_message'];
        session()->has('operator') ? $question_arr['Оператор'] = session()->get('operator') : $question_arr['Оператор'] = 'Нет оператора';

        unset($question_arr['created_at']);
        unset($question_arr['updated_at']);
        unset($question_arr['status']);
        unset($question_arr['id']);
        unset($question_arr['questions_name']);
        unset($question_arr['questions_phone']);
        unset($question_arr['questions_email']);
        unset($question_arr['questions_message']);


        UmHelp::sendTelegramToManager($question_arr,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 464744447);
        UmHelp::sendTelegramToManager($question_arr,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 265481925);
        $response = UmHelp::sendTelegramToManager($question_arr,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!');
        $this->reset(['questions_name', 'questions_phone','questions_email','questions_message']);
        if ($response) session()->flash('success_question');
        else session()->flash('error_question');
        $this->emit('alert_remove');


    }

    protected $messages = [
        // Ген. Партнер
        'general_partner.name.required' => 'Необходимо указать ФИО',
        'general_partner.name.max' => 'ФИО не должно быть больше 150 символов',
        'general_partner.name.min' => 'ФИО не может быть меньше 5 символов',
        'general_partner.inn.required' => 'Необходим указать ИНН',
        'general_partner.inn.min' => 'ИНН не может быть меньше 10 символов',
        'general_partner.inn.max' => 'ИНН не может быть больше 12 символов',
        'general_partner.ogrn.required' => 'Необходимо указать ОГРН',
        'general_partner.ogrn.digits' => 'ОГРН должно состоять из 13 цифр',
        'general_partner.kpp.required' => 'Необходимо указать КПП',
        'general_partner.kpp.digits' => 'КПП должно состоять из 9 цифр',
        'general_partner.bik.required' => 'Необходимо указать БИК',
        'general_partner.bik.digits' => 'БИК должен состоять из 9 цифр',
        'general_partner.corr_account.required' => 'Необходимо указать корреспондентский счет',
        'general_partner.corr_account.digits' => 'Корреспондентский счет должен состоять из 20 символов',
        'general_partner.account.required' => 'Необходимо указать счет',
        'general_partner.legal_address.required' => 'Необходимо указать Юридический адрес',
        'general_partner.legal_address.max' => 'Юридический адрес не может быть больше 150 символов',
        'general_partner.legal_address.min' => 'Юридический адрес не может меньше 3ex символов',
        'general_partner.actual_address.required' => 'Необходимо указать Фактический адрес',
        'general_partner.actual_address.max' => 'Фактический адрес не может быть больше 150 символов',
        'general_partner.actual_address.min' => 'Фактический адрес не может меньше 3ex символов',
        'general_partner.phone_number.required' => 'Необходимо указать номер мобильного телефона',
        'general_partner.phone_number.min' => 'Номер моб.телефона не может быть меньше 10 символов',
        'general_partner.phone_number.max' => 'Номер моб.телефона не может быть больше 15 символов',
        'general_partner.email.required' => 'Необходимо указать Email',
        'general_partner.email.max' => 'Email не может быть больше 150 символов',
        'general_partner.email.min' => 'Email не может быть меньше 5 символов',
        'general_partner.email.email' => 'Введенные данные не соответствует формату Email',
        // ИП
        'individual_business.direction.required' => 'Необходимо указать сферу услуг/товаров',
        'individual_business.direction.max' => 'Сфера услуг/товаров не должна быть больше 150 символов',
        'individual_business.direction.min' => 'Сфера услуг/товаров не должна быть меньше 3 символов',
        'individual_business.city_name.required' => 'Необходимо указать город',
        'individual_business.city_name.min' => 'Название города не может быть меньше 3ex символов',
        'individual_business.city_name.max' => 'Название города не может быть больше 170 символов',
        'individual_business.organization.required' => 'Необходимо указать название организации',
        'individual_business.organization.min' => 'Название организации не может быть меньше 3ex символов',
        'individual_business.organization.max' => 'Название организации не может быть больше 150 символов',
        'individual_business.short_name_organization.required' => 'Необходимо указать сокращенное наименование организации',
        'individual_business.short_name_organization.min' => 'Сокращенное наименование организации не может быть меньше 3ex символов',
        'individual_business.short_name_organization.max' => 'Сокращенное наименование организации не может быть больше 150 символов',
        'individual_business.legal_address.required' => 'Необходимо указать юридический адрес организации',
        'individual_business.legal_address.min' => 'Юридический адрес организации не может быть меньше 3ex символов',
        'individual_business.legal_address.max' => 'Юридический адрес организации не может быть больше 150 символов',
        'individual_business.actual_address.required' => 'Необходимо указать фактический адрес организации',
        'individual_business.actual_address.min' => 'Фактический адрес организации не может быть меньше 3ex символов',
        'individual_business.actual_address.max' => 'Фактический адрес организации не может быть больше 150 символов',
        'individual_business.mailing_address.required' => 'Необходимо указать почтовый адрес организации',
        'individual_business.mailing_address.min' => 'Почтовый адрес организации не может быть меньше 3ex символов',
        'individual_business.mailing_address.max' => 'Почтовый адрес организации не может быть больше 150 символов',
        'individual_business.inn.required' => 'Необходимо указать ИНН',
        'individual_business.inn.min' => 'ИНН не может быть меньше 10 символов',
        'individual_business.inn.max' => 'ИНН не может быть больше 12 символов',
        'individual_business.kpp.required' => 'Необходимо указать КПП',
        'individual_business.kpp.digits' => 'КПП должно состоять из 9 цифр',
        'individual_business.ogrn.required' => 'Необходимо указать ОГРН',
        'individual_business.ogrn.digits' => 'ОГРН должно состоять из 13 цифр',
        'individual_business.bank_name.required' => 'Необходимо указать наименование банка',
        'individual_business.bank_name.max' => 'Наименование банка не должно превышать 150 символов',
        'individual_business.bank_name.min' => 'Наименование банка не должно быть менее 3 символов',
        'individual_business.check_account.required' => 'Необходимо указать расчетный счет',
        'individual_business.check_account.digits' => 'Расчетный счет должен состоять из 20 цифр',
        'individual_business.correspondent_account.required' => 'Необходимо указать корреспондентский счет',
        'individual_business.correspondent_account.digits' => 'Корреспондентский счет должен состоять из 20 цифр',
        'individual_business.bik.required' => 'Необходимо указать БИК',
        'individual_business.bik.digits' => 'БИК должен состоять из 9 цифр',
        'individual_business.email.required' => 'Необходимо указать Email',
        'individual_business.email.max' => 'Email не может быть больше 150 символов',
        'individual_business.email.min' => 'Email не может быть меньше 5 символов',
        'individual_business.email.email' => 'Введенные данные не соответствует формату Email',
        'individual_business.phone_number.required' => 'Необходимо указать номер мобильного телефона',
        'individual_business.phone_number.min' => 'Номер моб.телефона не может быть меньше 10 символов',
        'individual_business.phone_number.max' => 'Номер моб.телефона не может быть больше 15 символов',
        'individual_business.socials.max' => 'Ссылка на соц.сеть не может быть больше 255 символов',
        'individual_business.socials.url' => 'Допускается указание только ссылок',
        // OOO
        'organization.direction.required' => 'Необходимо указать сферу услуг/товаров',
        'organization.direction.max' => 'Сфера услуг/товаров не должна быть больше 150 символов',
        'organization.direction.min' => 'Сфера услуг/товаров не должна быть меньше 3 символов',
        'organization.city_name.required' => 'Необходимо указать город',
        'organization.city_name.min' => 'Название города не может быть меньше 3ex символов',
        'organization.city_name.max' => 'Название города не может быть больше 170 символов',
        'organization.org_name.required' => 'Необходимо указать название организации',
        'organization.org_name.min' => 'Название организации не может быть меньше 3ex символов',
        'organization.org_name.max' => 'Название организации не может быть больше 150 символов',
        'organization.short_name_organization.required' => 'Необходимо указать сокращенное наименование организации',
        'organization.short_name_organization.min' => 'Сокращенное наименование организации не может быть меньше 3ex символов',
        'organization.short_name_organization.max' => 'Сокращенное наименование организации не может быть больше 150 символов',
        'organization.legal_address.required' => 'Необходимо указать юридический адрес организации',
        'organization.legal_address.min' => 'Юридический адрес организации не может быть меньше 3ex символов',
        'organization.legal_address.max' => 'Юридический адрес организации не может быть больше 150 символов',
        'organization.actual_address.required' => 'Необходимо указать фактический адрес организации',
        'organization.actual_address.min' => 'Фактический адрес организации не может быть меньше 3ex символов',
        'organization.actual_address.max' => 'Фактический адрес организации не может быть больше 150 символов',
        'organization.mailing_address.required' => 'Необходимо указать почтовый адрес организации',
        'organization.mailing_address.min' => 'Почтовый адрес организации не может быть меньше 3ex символов',
        'organization.mailing_address.max' => 'Почтовый адрес организации не может быть больше 150 символов',
        'organization.gen_director.min' => 'ФИО генерального директора не может быть меньше 5 символов',
        'organization.gen_director.max' => 'ФИО генерального директора не может быть больше 150 символов',
        'organization.glav_bug.min' => 'ФИО главного бухгалтера не может быть меньше 5 символов',
        'organization.glav_bug.max' => 'ФИО главного бухгалтера не может быть больше 150 символов',
        'organization.inn.required' => 'Необходимо указать ИНН',
        'organization.inn.min' => 'ИНН не может быть меньше 10 символов',
        'organization.inn.max' => 'ИНН не может быть больше 12 символов',
        'organization.kpp.required' => 'Необходимо указать КПП',
        'organization.kpp.digits' => 'КПП должно состоять из 9 цифр',
        'organization.ogrn.required' => 'Необходимо указать ОГРН',
        'organization.ogrn.digits' => 'КПП должно состоять из 13 цифр',
        'organization.bank_name.required' => 'Необходимо указать наименование банка',
        'organization.bank_name.max' => 'Наименование банка не должно превышать 150 символов',
        'organization.bank_name.min' => 'Наименование банка не должно быть менее 3 символов',
        'organization.check_account.required' => 'Необходимо указать расчетный счет',
        'organization.check_account.digits' => 'Расчетный счет должен состоять из 20 цифр',
        'organization.correspondent_account.required' => 'Необходимо указать корреспондентский счет',
        'organization.correspondent_account.digits' => 'Корреспондентский счет должен состоять из 20 цифр',
        'organization.bik.required' => 'Необходимо указать БИК',
        'organization.bik.digits' => 'БИК должен состоять из 9 цифр',
        'organization.email.required' => 'Необходимо указать Email',
        'organization.email.max' => 'Email не может быть больше 150 символов',
        'organization.email.min' => 'Email не может быть меньше 5 символов',
        'organization.email.email' => 'Введенные данные не соответствует формату Email',
        'organization.phone_number.required' => 'Необходимо указать номер мобильного телефона',
        'organization.phone_number.min' => 'Номер моб.телефона не может быть меньше 10 символов',
        'organization.phone_number.max' => 'Номер моб.телефона не может быть больше 15 символов',
        'organization.socials.max' => 'Ссылка на соц.сеть не может быть больше 255 символов',
        'organization.socials.url' => 'Допускается указание только ссылок',
        // самозанятый
        'self_employed.direction.required' => 'Необходимо указать сферу услуг/товаров',
        'self_employed.direction.max' => 'Сфера услуг/товаров не должна быть больше 150 символов',
        'self_employed.direction.min' => 'Сфера услуг/товаров не должна быть меньше 3 символов',
        'self_employed.city_name.required' => 'Необходимо указать город',
        'self_employed.city_name.min' => 'Название города не может быть меньше 3ex символов',
        'self_employed.city_name.max' => 'Название города не может быть больше 170 символов',
        'self_employed.fullName.required' => 'Необходимо указать ФИО',
        'self_employed.fullName.max' => 'ФИО не может быть более 150 символов',
        'self_employed.fullName.min' => 'ФИО не может быть менее 5 символов',
        'self_employed.pasport_seria_number.required' => 'Необходимо указать серию/номер паспорта',
        'self_employed.pasport_seria_number.max' => 'Серия/номер паспорта не может превышать 150 символов',
        'self_employed.pasport_seria_number.min' => 'Серия/номер паспорта не может быть меньше 7 символов',
        'self_employed.when_issued_whom.required' => 'Необходимо указать когда и кем был выдан паспорт',
        'self_employed.when_issued_whom.max' => 'Адрес пункта выдачи паспорта не может превышать 200 символов',
        'self_employed.when_issued_whom.min' => 'Адрес пункта выдачи паспорта не может быть менее 5 символов',
        'self_employed.registration_address.required' => 'Необходимо указать адрес регистрации',
        'self_employed.registration_address.max' => 'Адрес регистрации не может превышать 200 символов',
        'self_employed.registration_address.min' => 'Адрес регистрации не может быть менее 10 символов',
        'self_employed.actual_address.required' => 'Необходимо указать фактический адрес ведения деятельности',
        'self_employed.actual_address.max' => 'Фактический адрес не может превышать 200 символов',
        'self_employed.actual_address.min' => 'Фактический адрес не может быть менее 10 символов',
        'self_employed.inn.required' => 'Необходим указать ИНН',
        'self_employed.inn.min' => 'ИНН не может быть меньше 10 символов',
        'self_employed.inn.max' => 'ИНН не может быть больше 12 символов',
        'self_employed.mailing_address.required' => 'Необходимо указать почтовый адрес',
        'self_employed.mailing_address.min' => 'Почтовый адрес не может быть меньше 3ex символов',
        'self_employed.mailing_address.max' => 'Почтовый адрес не может быть больше 150 символов',
        'self_employed.bank_name.required' => 'Необходимо указать наименование банка',
        'self_employed.bank_name.max' => 'Наименование банка не должно превышать 150 символов',
        'self_employed.bank_name.min' => 'Наименование банка не должно быть менее 3 символов',
        'self_employed.check_account.required' => 'Необходимо указать расчетный счет',
        'self_employed.check_account.digits' => 'Расчетный счет должен состоять из 20 цифр',
        'self_employed.correspondent_account.required' => 'Необходимо указать корреспондентский счет',
        'self_employed.correspondent_account.digits' => 'Корреспондентский счет должен состоять из 20 цифр',
        'self_employed.bik.required' => 'Необходимо указать БИК',
        'self_employed.bik.digits' => 'БИК должен состоять из 9 цифр',
        'self_employed.email.required' => 'Необходимо указать Email',
        'self_employed.email.max' => 'Email не может быть больше 150 символов',
        'self_employed.email.min' => 'Email не может быть меньше 5 символов',
        'self_employed.email.email' => 'Введенные данные не соответствуют формату Email',
        'self_employed.phone_number.required' => 'Необходимо указать номер мобильного телефона',
        'self_employed.phone_number.min' => 'Номер моб.телефона не может быть меньше 10 символов',
        'self_employed.phone_number.max' => 'Номер моб.телефона не может быть больше 15 символов',
        'self_employed.socials.max' => 'Ссылка на соц.сеть не может быть более 255 символов',
        'self_employed.socials.url' => 'Допускается указание только ссылок'
    ];

    // Ген.партнер
    public function generalPartner() {

        $this->validate([
            'general_partner.name' => 'required|max:150|min:5',
            'general_partner.inn' => 'required|min:10|max:12',
            'general_partner.ogrn' => 'required|digits:13',
            'general_partner.kpp' => 'required|digits:9',
            'general_partner.bik' => 'required|digits:9',
            'general_partner.corr_account' => 'required|digits:20',
            'general_partner.account' => 'required',
            'general_partner.legal_address' => 'required|max:150|min:3',
            'general_partner.actual_address' => 'required|max:150|min:3',
            'general_partner.phone_number' => 'required|min:10|max:15',
            'general_partner.email' => 'required|max:150|min:5|email',
        ]);

        #Write to database
        $general_partner_id = $this->savePartnerData('gen');

        #Send a message to telegram
        $telegram_msg = [];
        $telegram_msg['Заявка №'] = $general_partner_id;
        $telegram_msg['Источник'] = 'СТРАНИЦА ГЕНЕРАЛЬНОГО ПАРТНЕРА.';
        $telegram_msg['ФИО'] = $this->general_partner['name'];
        $telegram_msg['Телефон'] = $this->general_partner['phone_number'];
        $telegram_msg['Email адрес'] = $this->general_partner['email'];
        $telegram_msg['ИНН'] = $this->general_partner['inn'];
        $telegram_msg['ОГРН'] = $this->general_partner['ogrn'];
        $telegram_msg['КПП'] = $this->general_partner['kpp'];
        $telegram_msg['БИК'] = $this->general_partner['bik'];
        $telegram_msg['кор. счет №'] = $this->general_partner['corr_account'];
        $telegram_msg['счет №'] = $this->general_partner['account'];
        $telegram_msg['Юридический адрес'] = $this->general_partner['legal_address'];
        $telegram_msg['Фактический адрес'] = $this->general_partner['actual_address'];
        session()->has('operator') ? $telegram_msg['Оператор'] = session()->get('operator') : $telegram_msg['Оператор'] = 'Нет оператора';
         //Телеграм Артем
         UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 464744447);
         //Телеграм Глеб
         UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 265481925);
         //Телеграм группа менеджеров
         UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', -1001679721539);

         // сбрасываем весь массив, чтобы повторно не отправлялось
         $this->reset();

         // if ($response) session()->flash('success_question');
         // else session()->flash('error_question');

    }

    // Индивидуальный предприниматель
    public function individualBusiness() {
        $this->validate([
            'individual_business.direction' => 'required|max:150|min:3',
            'individual_business.city_name' => 'required|max:170|min:3',
            'individual_business.organization' => 'required|max:150|min:3',
            'individual_business.short_name_organization' => 'required|max:150|min:3',
            'individual_business.legal_address' => 'required|max:150|min:3',
            'individual_business.actual_address' => 'required|max:150|min:3',
            'individual_business.mailing_address' => 'required|max:150|min:3',
            'individual_business.inn' => 'required|min:10|max:12',
            'individual_business.kpp' => 'required|digits:9',
            'individual_business.ogrn' => 'required|digits:13',
            'individual_business.bank_name' => 'required|max:50|min:3',
            'individual_business.check_account' => 'required|digits:20',
            'individual_business.correspondent_account' => 'required|digits:20',
            'individual_business.bik' => 'required|digits:9',
            'individual_business.email' => 'required|max:150|min:5|email',
            'individual_business.phone_number' => 'required|min:10|max:15',
            'individual_business.socials' => 'url|max:255',
        ]);
        #Write to database
        $individual_business_id = $this->savePartnerData('ip');

        #Send a message to telegram
        $telegram_msg = [];
        $telegram_msg['Заявка №'] = $individual_business_id;
        $telegram_msg['Источник'] = 'СТРАНИЦА ГЕНЕРАЛЬНОГО ПАРТНЕРА.';
        $telegram_msg['Сфера услуг/товаров'] = $this->individual_business['direction'];
        $telegram_msg['Город'] = $this->individual_business['city_name'];
        $telegram_msg['Полное наименование организации'] = $this->individual_business['organization'];
        $telegram_msg['Сокращенное наименование'] = $this->individual_business['short_name_organization'];
        $telegram_msg['Юридический адрес'] = $this->individual_business['legal_address'];
        $telegram_msg['Фактический адрес'] = $this->individual_business['actual_address'];
        $telegram_msg['Почтовый адрес (а/я)'] = $this->individual_business['mailing_address'];
        $telegram_msg['ИНН'] = $this->individual_business['inn'];
        $telegram_msg['КПП'] = $this->individual_business['kpp'];
        $telegram_msg['ОГРН'] = $this->individual_business['ogrn'];
        $telegram_msg['Наименование Банка'] = $this->individual_business['bank_name'];
        $telegram_msg['Расчётный счет (р/с)'] = $this->individual_business['check_account'];
        $telegram_msg['Корреспондентский счёт: (к/c)'] = $this->individual_business['correspondent_account'];
        $telegram_msg['БИК'] = $this->individual_business['bik'];
        $telegram_msg['Электронный почтовый адрес (E-mail)'] = $this->individual_business['email'];
        $telegram_msg['Мобильный номер телефона'] = $this->individual_business['phone_number'];
        if(!empty($this->individual_business['socials'])) $telegram_msg['Сайт/соц.сети'] = $this->individual_business['socials'];
        session()->has('operator') ? $telegram_msg['Оператор'] = session()->get('operator') : $telegram_msg['Оператор'] = 'Нет оператора';
        //Телеграм Артем
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 464744447);
        //Телеграм Глеб
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 265481925);
        //Телеграм группа менеджеров
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', -1001679721539);

        // сбрасываем весь массив, чтобы повторно не отправлялось
        $this->reset();

        // if ($response) session()->flash('success_question');
        // else session()->flash('error_question');
    }

    // Организация
    public function organization() {
        $this->validate([
            'organization.direction' => 'required|max:150|min:3',
            'organization.city_name' => 'required|max:170|min:3',
            'organization.org_name' => 'required|max:150|min:3',
            'organization.short_name_org' => 'required|max:150|min:3',
            'organization.legal_address' => 'required|max:150|min:3',
            'organization.actual_address' => 'required|max:150|min:3',
            'organization.mailing_address' => 'required|max:150|min:3',
            'organization.gen_director' => 'max:150|min:5',
            'organization.glav_bug' => 'max:150|min:5',
            'organization.inn' => 'required|min:10|max:12',
            'organization.kpp' => 'required|digits:9',
            'organization.ogrn' => 'required|digits:13',
            'organization.bank_name' => 'required|max:50|min:3',
            'organization.check_account' => 'required|digits:20',
            'organization.correspondent_account' => 'required|digits:20',
            'organization.bik' => 'required|digits:9',
            'organization.email' => 'required|max:150|min:5|email',
            'organization.phone_number' => 'required|min:10|max:15',
            'organization.socials' => 'url|max:255',
        ]);

        #Write to database
        $organization_id = $this->savePartnerData('ooo');

        #Send a message to telegram
        $telegram_msg = [];
        $telegram_msg['Заявка №'] = $organization_id;
        $telegram_msg['Источник'] = 'СТРАНИЦА ГЕНЕРАЛЬНОГО ПАРТНЕРА.';
        $telegram_msg['Сфера услуг/товаров'] = $this->organization['direction'];
        $telegram_msg['Город'] = $this->organization['city_name'];
        $telegram_msg['Полное наименование организации'] = $this->organization['org_name'];
        $telegram_msg['Сокращенное наименование'] = $this->organization['short_name_org'];
        $telegram_msg['Юридический адрес'] = $this->organization['legal_address'];
        $telegram_msg['Фактический адрес'] = $this->organization['actual_address'];
        $telegram_msg['Почтовый адрес (а/я)'] = $this->organization['mailing_address'];
        $telegram_msg['Генеральный Директор'] = $this->organization['gen_director'];
        $telegram_msg['Главный бухгалтер'] = $this->organization['glav_bug'];
        $telegram_msg['ИНН'] = $this->organization['inn'];
        $telegram_msg['КПП'] = $this->organization['kpp'];
        $telegram_msg['ОГРН'] = $this->organization['ogrn'];
        $telegram_msg['Наименование Банка'] = $this->organization['bank_name'];
        $telegram_msg['Расчётный счет (р/с)'] = $this->organization['check_account'];
        $telegram_msg['Корреспондентский счёт: (к/c)'] = $this->organization['correspondent_account'];
        $telegram_msg['БИК'] = $this->organization['bik'];
        $telegram_msg['Электронный почтовый адрес (E-mail)'] = $this->organization['email'];
        $telegram_msg['Мобильный номер телефона'] = $this->organization['phone_number'];
        if(!empty($this->organization['socials'])) $telegram_msg['Сайт/соц.сети'] = $this->organization['socials'];
        session()->has('operator') ? $telegram_msg['Оператор'] = session()->get('operator') : $telegram_msg['Оператор'] = 'Нет оператора';

        //Телеграм Артем
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 464744447);
        //Телеграм Глеб
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 265481925);
        //Телеграм группа менеджеров
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', -1001679721539);

        // сбрасываем весь массив, чтобы повторно не отправлялось
        $this->reset();

        // if ($response) session()->flash('success_question');
        // else session()->flash('error_question');

    }

    // Cамозанятый
    public function selfEmpoyed() {
        $this->validate([
            'self_employed.direction' => 'required|max:150|min:3',
            'self_employed.city_name' => 'required|max:170|min:3',
            'self_employed.fullName' => 'required|max:150|min:5',
            'self_employed.pasport_seria_number' => 'required|max:70|min:7',
            'self_employed.when_issued_whom' => 'required|max:200|min:5',
            'self_employed.registration_address' => 'required|max:200|min:10',
            'self_employed.actual_address' => 'required|max:200|min:5',
            'self_employed.inn' => 'required|min:10|max:12',
            'self_employed.mailing_address' => 'required|max:150|min:3',
            'self_employed.bank_name' => 'required|max:50|min:3',
            'self_employed.check_account' => 'required|digits:20',
            'self_employed.correspondent_account' => 'required|digits:20',
            'self_employed.bik' => 'required|digits:9',
            'self_employed.email' => 'required|max:150|min:5|email',
            'self_employed.phone_number' => 'required|min:10|max:15',
            'self_employed.socials' => 'url|max:255',
        ]);

        #Write to database
        $self_employed_id = $this->savePartnerData('self');

        #Send a message to telegram
        $telegram_msg = [];
        $telegram_msg['Заявка №'] = $self_employed_id;
        $telegram_msg['Источник'] = 'СТРАНИЦА ГЕНЕРАЛЬНОГО ПАРТНЕРА.';
        $telegram_msg['Сфера услуг/товаров'] = $this->self_employed['direction'];
        $telegram_msg['Город'] = $this->self_employed['city_name'];
        $telegram_msg['Имя'] = $this->self_employed['fullName'];
        $telegram_msg['Серия и номер паспорта'] = $this->self_employed['pasport_seria_number'];
        $telegram_msg['Когда и кем выдан'] = $this->self_employed['when_issued_whom'];
        $telegram_msg['Адрес регистрации'] = $this->self_employed['registration_address'];
        $telegram_msg['Фактический адрес ведения деятельности'] = $this->self_employed['actual_address'];
        $telegram_msg['ИНН'] = $this->self_employed['inn'];
        $telegram_msg['Почтовый адрес (а/я)'] = $this->self_employed['mailing_address'];
        $telegram_msg['Наименование Банка'] = $this->self_employed['bank_name'];
        $telegram_msg['Расчётный счет (р/с)'] = $this->self_employed['check_account'];
        $telegram_msg['Корреспондентский счёт: (к/c)'] = $this->self_employed['correspondent_account'];
        $telegram_msg['БИК'] = $this->self_employed['bik'];
        $telegram_msg['Электронный почтовый адрес (E-mail)'] = $this->individual_business['email'];
        $telegram_msg['Мобильный номер телефона'] = $this->individual_business['phone_number'];
        if(!empty($this->self_employed['socials'])) $telegram_msg['Сайт/соц.сети'] = $this->self_employed['socials'];
        session()->has('operator') ? $telegram_msg['Оператор'] = session()->get('operator') : $telegram_msg['Оператор'] = 'Нет оператора';

        //Телеграм Артем
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 464744447);
        //Телеграм Глеб
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', 265481925);
        //Телеграм группа менеджеров
        UmHelp::sendTelegramToManager($telegram_msg,'ВОПРОС О ГЕНЕРАЛЬНОМ ПАРТНЕРСТВЕ!', -1001679721539);

        // сбрасываем весь массив, чтобы повторно не отправлялось
        $this->reset();

        // if ($response) session()->flash('success_question');
        // else session()->flash('error_question');

    }

    // запись в таблицу данных о партнере
    public function savePartnerData($partner_type)
    {

        $partner = false; // проверка, на заполнение партнера
        $user_id = null;
        if(Auth::check()) $user_id = Auth::id();

        switch($partner_type) {
            case 'gen':
                $partner = PartnerFormRegistration::create([
                    "partner_type" => 'Ген. Партнер',
                    "user_id" => $user_id,
                    "fio" => $this->general_partner['name'],
                    "inn" => $this->general_partner['inn'],
                    "kpp" => $this->general_partner['kpp'],
                    "ogrn" => $this->general_partner['ogrn'],
                    "bik" => $this->general_partner['bik'],
                    "kor_account" => $this->general_partner['corr_account'],
                    "bank_account" => $this->general_partner['account'],
                    "legal_address" => $this->general_partner['legal_address'],
                    "actual_address" => $this->general_partner['actual_address'],
                    "mobile_tel_owner" => $this->general_partner['phone_number'],
                    "email" => $this->general_partner['email'],
                ]);
                break;
            case 'ooo':
                $partner = PartnerFormRegistration::create([
                    "partner_type" => 'ООО',
                    "user_id" => $user_id,
                    "direction" => $this->organization['direction'],
                    "city_name" => $this->organization['city_name'],
                    "org_full_name" => $this->organization['org_name'],
                    "org_short_name" => $this->organization['short_name_org'],
                    "legal_address" => $this->organization['legal_address'],
                    "actual_address" => $this->organization['actual_address'],
                    "post_address" => $this->organization['mailing_address'],
                    "director_name" => $this->organization['gen_director'],
                    "bohalter_name" => $this->organization['glav_bug'],
                    "inn" => $this->organization['inn'],
                    "kpp" => $this->organization['kpp'],
                    "ogrn" => $this->organization['ogrn'],
                    "bank_name" => $this->organization['bank_name'],
                    "kor_account" => $this->organization['check_account'],
                    "bik" => $this->organization['bik'],
                    "email" => $this->organization['email'],
                    "mobile_tel_owner" => $this->organization['phone_number'],
                    "socials" => !empty($this->organization['socials']) ? $this->organization['socials'] : null,
                ]);
                break;
            case 'ip':
                $partner = PartnerFormRegistration::create([
                    "partner_type" => 'ИП',
                    "user_id" => $user_id,
                    "direction" => $this->individual_business['direction'],
                    "city_name" => $this->individual_business['city_name'],
                    "org_full_name" => $this->individual_business['organization'],
                    "org_short_name" => $this->individual_business['short_name_organization'],
                    "legal_address" => $this->individual_business['legal_address'],
                    "actual_address" => $this->individual_business['actual_address'],
                    "post_address" => $this->individual_business['mailing_address'],
                    "inn" => $this->individual_business['inn'],
                    "kpp" => $this->individual_business['kpp'],
                    "ogrn" => $this->individual_business['ogrn'],
                    "bank_name" => $this->individual_business['bank_name'],
                    "bank_account" => $this->individual_business['check_account'],
                    "kor_account" => $this->individual_business['correspondent_account'],
                    "bik" => $this->individual_business['bik'],
                    "email" => $this->individual_business['email'],
                    "mobile_tel_owner" => $this->individual_business['phone_number'],
                    "socials" => !empty($this->individual_business['socials']) ? $this->individual_business['socials'] : null,
                ]);
                break;
            case 'self':
                $partner = PartnerFormRegistration::create([
                    "partner_type" => 'Самозанятый',
                    "user_id" => $user_id,
                    "direction" => $this->self_employed['direction'],
                    "city_name" => $this->self_employed['city_name'],
                    "fio" => $this->self_employed['fullName'],
                    "passport_data" => $this->self_employed['pasport_seria_number'],
                    "who_gave" => $this->self_employed['when_issued_whom'],
                    "reg_address" => $this->self_employed['registration_address'],
                    "actual_address" => $this->self_employed['actual_address'],
                    "inn" => $this->self_employed['inn'],
                    "post_address" => $this->self_employed['mailing_address'],
                    "bank_name" => $this->self_employed['bank_name'],
                    "bank_account" => $this->self_employed['check_account'],
                    "kor_account" => $this->self_employed['correspondent_account'],
                    "bik" => $this->self_employed['bik'],
                    "email" => $this->self_employed['email'],
                    "mobile_tel_owner" => $this->self_employed['phone_number'],
                    "socials" => !empty($this->self_employed['socials']) ? $this->self_employed['socials'] : null,
                ]);
            default:
                $partner = null;
        }

        if(!$partner) return false; // возращаемся, если не получилось добавить партнера
        UmHelp::sendTelegramToManager($partner->getAttributes(),'ДАННЫЕ ФОРМЫ РЕГИСТРАЦИИ ПАРТНЕРА');

        // возращаем id добавленного партнера
        return $partner->id;
    }

    public function franchisePay()
    {
        $this->validate([
            'city' => 'required|max:50',
            'phone_pay' => 'required|min:11|max:20'
        ]);

        #Создаем транзакцию
        $transaction = new Transaction();
        $transaction->user_id = Auth::check() ? Auth::user()->id : 1;
        $transaction->order_id = 0;
        $transaction->total = $this->pay_sum;
        $transaction->save();
        #Создаем ордер на оплату.
        $order = new Order();
        $order->user_id = Auth::check() ? Auth::user()->id : 1;
        $order->partner_id = 0;
        $order->transaction_id = $transaction->id;
        $order->subtotal = 0;
        $order->discount = 0;
        $order->total = $this->pay_sum;
        $order->firstname = 0;
        $order->lastname = 0;
        $order->mobile = $this->phone_pay;
        $order->comment = 'ПОКУПКА ФРАНШИЗЫ';
        $order->city = $this->city;
        $order->address = 0;
        $order->is_shipping_different = StatusEnum::SELF_DELIVERY;

        $order->save();

        #Создание платежа через Yookassa
        $description = $this->description . '. Телефон ' . $this->phone_pay . '. Город ' . $this->city;
        $service = new  YookassaService();
        $payment = $service->createPayment($this->pay_sum, $description, [
            'phone' => $this->phone_pay,
            'city' => $this->city,
            'transaction_id' => $transaction->id,
            'order_id' => $order->id,
            'store_id' => 0,
            'partner_id' => 0,
        ]);

        #Сохраняем транзакцию оплаты.
        $transaction->order_id = $order->id;
        $transaction->payment_id = $payment->_id;
        $transaction->mode = 'yoomoney';
        $transaction->save();

        return redirect()->away($payment->getConfirmation()->getConfirmationUrl());

    }

    public function InvoiceForPayment()
    {
        $this->validate();
        $frachise_request = FranchiseRequest::create([
            'status' => 'CREATE',
            'fio' => $this->fio,
            'inn' => $this->inn,
            'ogrn' => $this->ogrn,
            'kpp' => $this->kpp,
            'bik' => $this->bik,
            'kor_account' => $this->kor_account,
            'bank_account' => $this->bank_account,
            'legal_address' => $this->legal_address,
            'actual_address' => $this->actual_address,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $frachise_request = $frachise_request->toArray();

        unset($frachise_request['created_at']);
        unset($frachise_request['updated_at']);
        $frachise_request['Заявка №'] = $frachise_request['id'];
        $frachise_request['Источник'] = 'Форма покупки франшизы';
        unset($frachise_request['id']);
        #Отправляем сообщение в группу в телеграм и Ивану лично.
        $respose = UmHelp::sendTelegramToManager($frachise_request, 'СЧЕТ НА ПОКУПКУ ФРАНШИЗЫ');
        UmHelp::sendTelegramToManager($frachise_request, 'СЧЕТ НА ПОКУПКУ ФРАНШИЗЫ', 5023363551);

        //Обнуляем данные в форме


        $this->reset(['fio', 'inn', 'ogrn', 'kpp', 'bik', 'kor_account', 'bank_account', 'legal_address', 'actual_address', 'phone', 'email']);
        if ($respose) session()->flash('success');
        else session()->flash('error');

    }


    protected $validationAttributes = [
        'fio' => 'ФИО',
        'inn' => 'ИНН',
        'ogrn' => 'ОГРН',
        'kpp' => 'КПП',
        'bik' => 'БИК',
        'kor_account' => 'Кор. Счет',
        'bank_account' => 'Счет',
        'legal_address' => 'Юридический Адрес',
        'actual_address' => 'Фактический Адрес',
        'phone' => 'Телефон',
        'email' => 'Email адрес',
        'description' => 'Назначение платежа',
        'city' => 'Город',
        'phone_pay' => 'Номер телефона',
        'pay_sum' => 'Сумма оплаты',

    ];

    public function updated($propertyName, $propertyValue)
    {
        if ($propertyName == 'phone_pay' and strlen($propertyValue) > 10) {
            $this->phone_pay = Manny::mask($propertyValue, '1(111) 111 11 11');
        }
        if ($propertyName == 'questions_phone' and strlen($propertyValue) > 10) {

            $this->questions_phone = Manny::mask($propertyValue, '1(111) 111 11 11');
        }

        $this->validateOnly($propertyName, [
            // Ген. Партнер
            'general_partner.name' => 'required|max:150|min:5',
            'general_partner.inn' => 'required|min:10|max:12',
            'general_partner.ogrn' => 'required|digits:13',
            'general_partner.kpp' => 'required|digits:9',
            'general_partner.bik' => 'required|digits:9',
            'general_partner.corr_account' => 'required|digits:20',
            'general_partner.account' => 'required',
            'general_partner.legal_address' => 'required|max:150|min:3',
            'general_partner.actual_address' => 'required|max:150|min:3',
            'general_partner.phone_number' => 'required|min:10|max:15',
            'general_partner.email' => 'required|max:150|min:5|email',
            // ИП
            'individual_business.direction' => 'required|max:150|min:3',
            'individual_business.city_name' => 'required|max:170|min:3',
            'individual_business.organization' => 'required|max:150|min:3',
            'individual_business.short_name_organization' => 'required|max:150|min:3',
            'individual_business.legal_address' => 'required|max:150|min:3',
            'individual_business.actual_address' => 'required|max:150|min:3',
            'individual_business.mailing_address' => 'required|max:150|min:3',
            'individual_business.inn' => 'required|min:10|max:12',
            'individual_business.kpp' => 'required|digits:9',
            'individual_business.ogrn' => 'required|digits:13',
            'individual_business.bank_name' => 'required|max:50|min:3',
            'individual_business.check_account' => 'required|digits:20',
            'individual_business.correspondent_account' => 'required|digits:20',
            'individual_business.bik' => 'required|digits:9',
            'individual_business.email' => 'required|max:150|min:5|email',
            'individual_business.phone_number' => 'required|min:10|max:15',
            'individual_business.socials' => 'url|max:255',
            // ООО
            'organization.direction' => 'required|max:150|min:3',
            'organization.city_name' => 'required|max:170|min:3',
            'organization.org_name' => 'required|max:150|min:3',
            'organization.short_name_org' => 'required|max:150|min:3',
            'organization.legal_address' => 'required|max:150|min:3',
            'organization.actual_address' => 'required|max:150|min:3',
            'organization.mailing_address' => 'required|max:150|min:3',
            'organization.gen_director' => 'max:150|min:5',
            'organization.glav_bug' => 'max:150|min:5',
            'organization.inn' => 'required|min:10|max:12',
            'organization.kpp' => 'required|digits:9',
            'organization.ogrn' => 'required|digits:13',
            'organization.bank_name' => 'required|max:50|min:3',
            'organization.check_account' => 'required|digits:20',
            'organization.correspondent_account' => 'required|digits:20',
            'organization.bik' => 'required|digits:9',
            'organization.email' => 'required|max:150|min:5|email',
            'organization.phone_number' => 'required|min:10|max:15',
            'organization.socials' => 'url|max:255',
            // самозанятый
            'self_employed.direction' => 'required|max:150|min:3',
            'self_employed.city_name' => 'required|max:170|min:3',
            'self_employed.fullName' => 'required|max:150|min:5',
            'self_employed.pasport_seria_number' => 'required|max:70|min:7',
            'self_employed.when_issued_whom' => 'required|max:200|min:5',
            'self_employed.registration_address' => 'required|max:200|min:10',
            'self_employed.actual_address' => 'required|max:200|min:5',
            'self_employed.inn' => 'required|min:10|max:12',
            'self_employed.mailing_address' => 'required|max:150|min:3',
            'self_employed.bank_name' => 'required|max:50|min:3',
            'self_employed.check_account' => 'required|digits:20',
            'self_employed.correspondent_account' => 'required|digits:20',
            'self_employed.bik' => 'required|digits:9',
            'self_employed.email' => 'required|max:150|min:5|email',
            'self_employed.phone_number' => 'required|min:10|max:15',
            'self_employed.socials' => 'url|max:255',
        ]);
    }


    protected function rules()
    {
        $rules = [
            'fio' => 'required|min:10|max:90',
            'inn' => 'required|min:10|max:12',
            'ogrn' => 'required|digits:13',
            'kpp' => 'required|digits:9',
            'bik' => 'required|digits:9',
            'kor_account' => 'required|digits:20',
            'bank_account' => 'required|digits:20',
            'legal_address' => 'required|max:200',
            'actual_address' => 'required|max:200',
            'phone' => 'required|max:20',
            'email' => 'required|email|min:5|max:60',


        ];

        if(isset($this->questions_name))
        {
            $rules['questions_name']='required|max:50';
        }
        if(isset($this->questions_message))
        {
            $rules['questions_message']='required|max:250';
        }

        return $rules;
    }
}

