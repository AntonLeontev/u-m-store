<?php

namespace App\Http\Livewire\Partner;

use App\Enums\StatusEnum;
use App\Helpers\UmHelp;
use App\Models\Checkout\Order;
use App\Models\Checkout\Transaction;
use App\Services\YookassaService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\FranchiseRequest;
use Manny\Manny;
use Manny\Mask;

class FranchiseSaleComponet extends Component
{
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

    public function mount()
    {

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
        $this->description = 'Оплата доступа к программной разработке (unitedmarket.org)  для реализации товара в интернет пространстве';

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
        $description = $this->description .'. Телефон '. $this->phone_pay.'. Город '.$this->city;
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


        $this->reset(['fio','inn','ogrn','kpp','bik','kor_account','bank_account','legal_address','actual_address','phone','email']);
        if($respose) session()->flash('success');
        else session()->flash('error');

    }

    public function render()
    {
        return view('livewire.partner.franchise-sale-componet')->layout('layouts.base');
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
        if($propertyName == 'phone_pay' and strlen($propertyValue)>10)
        {
            $this->phone_pay = Manny::mask($propertyValue, '1(111) 111 11 11');
        }
        $this->validateOnly($propertyName);
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

        return $rules;
    }
}
