<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;
use App\Http\Controllers\MailController\MailController;
use App\Http\Controllers\SmsController;
use App\Models\Bonus;
use App\Models\BonusTransactions;
use App\Models\Checkout\Order;
use App\Models\Checkout\OrderProduct;
use App\Models\Checkout\Transaction;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Partners;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDetails\ReferralUser;
use App\Services\YookassaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Manny\Manny;
use Cart;

class CheckoutComponent extends Component
{
    public $recipient;
    public $recipient_name;
    public $recipient_surname;
    public $recipient_phone = '+7';
    public $recipient_message;

    public $card;
    public $token;
    public $amount;
    public $card_number;
    public $expiry_month;
    public $expiry_year;
    public $cvc;
    public $card_name;
    public $getToken;

    public $delivery;
    public $delivery_city;
    public $delivery_address;

    public $partner;

   public function mount(){
        $this->card = 0;
       $this->delivery_city = session('city')['name'];
       $this->partner = Partners::where('store_id', Store::store_id())->where('status', 1)->first();
       session()->put('previous_url', url()->current());
   }

    protected $card_rules = [
        'card_number' => 'required|min:19',
        'expiry_month' => 'required|max:2',
        'expiry_year' => 'required|max:2',
        'cvc' => 'required|max:3',
    ];

    protected $listeners = ['cardReady', 'cardErrorMessage'];

    protected function rules()
    {
        $rules = [
            'recipient' => 'required',
            'card'=> 'required',
            'delivery'=> 'required',
        ];
        if($this->recipient)
        {
            $rules['recipient_name'] = 'required|min:3';
//            $rules['recipient_surname'] = 'required|min:3';
            $rules['recipient_phone'] = 'required|min:18';
        }
        if($this->card)
        {
            $rules['card_number'] = 'required|min:19';
            $rules['expiry_month'] = 'required|max:2';
            $rules['expiry_year'] = 'required|max:2';
            $rules['cvc'] = 'required|max:3';
        }
        if($this->delivery)
        {
            $rules['delivery_city'] = 'required';
            $rules['delivery_address'] = 'required';
        }
        return $rules;
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        $this->calculateTotal();
        Cart::instance('cart')->update($rowId,$qty);
        if(session()->has('coupon')) $this->calculateDiscount();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        Cart::instance('cart')->store(Store::store_id());
    }

    public function decreaseQuantity($rowId)
    {

        $product = Cart::instance('cart')->get($rowId);
        if($product->qty > 1)
        {
            $qty = $product->qty - 1;
            Cart::instance('cart')->update($rowId,$qty);
            $this->calculateTotal();
            if(session()->has('coupon')) $this->calculateDiscount();
            $this->emitTo('includes.cart-count-component', 'refreshComponent');
        }
        Cart::instance('cart')->store(Store::store_id());
    }

    public function setQuantity($rowId, $qty)
    {
        Cart::instance('cart')->update($rowId,$qty);
        $this->calculateTotal();
        if(session()->has('coupon')) $this->calculateDiscount();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        Cart::instance('cart')->store(Store::store_id());
    }


    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->calculateTotal();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        if(session()->has('coupon')) $this->calculateDiscount();
        Cart::instance('cart')->store(Store::store_id());

    }


   public function calculateTotal()
   {
       session('checkout')['total'] = Cart::instance('cart')->total();
   }


   function inputMusk($field) {


       switch($field) {
            case 'card_number':
                $this->card_number = Manny::mask(strval($this->card_number), "1111 1111 1111 1111");
                break;
            case 'expiry_month':
                $this->expiry_month = Manny::mask(strval($this->expiry_month), "11");
                break;
            case 'expiry_year':
                $this->expiry_year = Manny::mask(strval($this->expiry_year), "11");
                break;
            case 'card_name':
                $this->card_name = strtoupper(Manny::stripper(strval($this->card_name), ['alpha','space']));
                break;
            case 'cvc':
                $this->cvc = Manny::mask(strval($this->cvc), '111');
                break;
            case 'recipient_phone':
                if(strlen($this->recipient_phone) > 10) {
                    $this->recipient_phone = Manny::mask(strval($this->recipient_phone), '+1 (111) 111 11 11');
                }
                break;
            default:
                break;
        }
       // if data of credit card is valid then in js function getToken() create payment token
       if($this->validate($this->card_rules))
       {
           $this->emit('cardReady');
       }
    }

   //action listener
    public function cardReady()
    {

    }

    public function cardErrorMessage($rrors)
    {

     foreach ($rrors as $error){
         if($error['code'] == 'expired_card' || $error['code'] == 'card_declined' || $error['code'] == 'processing_error' || $error['code'] == 'missing') {
             session()->flash('error_code', $error['message']);
         }
         else
             {
            session()->flash($error['code'], $error['message']);
         }
        }
     $this->token = null;
    }

// when user click confirm checkout(Подтвердить заказ)
public function create(Request $request,YookassaService  $service)
    {

        if(!Auth::check())
        {
            session()->put('previous_url', url()->current());
            $this->redirect(route('auth'));
        }
      $this->validate();

// Если получатель другой человек
        if($this->recipient)
        {
            session()->put('order' ,[
             'recipient' => $this->recipient,
             'name' => $this->recipient_name,
             'surname' => $this->recipient_surname,
             'phone' => $this->recipient_phone,
             'message' => $this->recipient_message,
                'user_name' => Auth::user()->name,
            ]);
        }
        else
            {
                session()->put('order' ,[
                    'recipient' => $this->recipient,
                     'name' => Auth::user()->name ? Auth::user()->name : 'NoName',
                     'surname' => ' ',
                     'phone' => Auth::user()->phone,
                     'message' => $this->recipient_message,
                    'user_name' => Auth::user()->name,

                ]);
            }
// Способ доставки
        if($this->delivery)
        {
            if($this->delivery_city != session('city')['name'])
            {
                $city = Store::firstwhere('real_name', $this->delivery_city);
                if(!$city)
                {
                    session()->flash('error_city', 'Приносим свои извенения, на данный момент нет партнеров в городе ' . $this->delivery_city . '.');
                    return false;
                }
            }


            session()->put('shipping' ,[
                'delivery'=> $this->delivery,
                'city' => $this->delivery_city,
                'address' => $this->delivery_address
            ]);
        }
        else
        {
            session()->put('shipping' ,[
                'delivery'=> $this->delivery,
                'city' => $this->delivery_city,
                'address' => $this->partner ? $this->partner->actual_address : ''
            ]);
        }

            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = 0;
            $transaction->total = session('checkout')['total'];
            $transaction->save();

            $order = $this->setOrder($transaction->id);
        if($order)
        {
            $description = 'Оформление заказа №' . $order->id;
            $transaction->order_id = $order->id;
            if($this->token) {
                    $payment = $service->createTokenPayment($this->token, session('checkout')['total'], $description, [
                        'transaction_id' => $transaction->id,
                        'order_id' => $order->id,
                        'store_id' => Store::store_id(),
                        'partner_id'=> Store::find(Store::store_id())->partner_id,
                    ]);

                if($payment)
                {
                    $transaction->payment_id = $payment->_id;
                    $transaction->mode = 'card';
                    $transaction->save();

                    return redirect()->away($payment->getConfirmation()->getConfirmationUrl());
                }
                else {
                    $transaction->status = 'FAILED';
                    $transaction->save();
                    session()->flash('error_pay', 'Произошла ошибка, возможно не правильно введены данные карты. Попробуйте другой способ оплаты.');
                }
            }
             else if(!$this->card)
                {
                    $payment = $service->createPayment(session('checkout')['total'], $description, [
                        'transaction_id' => $transaction->id,
                        'order_id' => $order->id,
                        'store_id' => Store::store_id(),
                        'partner_id'=> Store::find(Store::store_id())->partner_id,
                    ]);
                    $transaction->payment_id = $payment->_id;
                    $transaction->mode = 'yoomoney';
                    $transaction->save();
                    return redirect()->away($payment->getConfirmation()->getConfirmationUrl());
                }
       }
   }




 public function setOrder($transaction_id)
    {
        $user_id = Auth::id();
//        $partner_id = Store::find(Store::store_id())->partner_id;
        $partner_id = Partners::firstWhere('store_id',Store::store_id())->id;

        $order = Order::where('user_id', $user_id)->where('total', '=', session('checkout')['total'])->where('status', StatusEnum::ORDERED)->get()->last();
        if(!$order)
        {
            $order = new Order();
        }
            $order->user_id = $user_id;
            $order->partner_id = $partner_id;
            $order->transaction_id = $transaction_id;
            $order->subtotal = session('checkout')['subtotal'];
            $order->discount = session('checkout')['discount'];
            $order->total = session('checkout')['total'];
            $order->firstname = session('order')['name'];
            $order->lastname = session('order')['surname'];
            $order->mobile = session('order')['phone'];
            if(Auth::user()->email)  $order->email = Auth::user()->email;
            $order->comment = session('order')['message'];
            $order->city = session('shipping')['city'];
            $order->address = session('shipping')['address'];

            if (session('shipping')['delivery']) {
                $order->is_shipping_different = StatusEnum::DELIVERY;
            }
            else
            {
                $order->is_shipping_different = StatusEnum::SELF_DELIVERY;
            }

            $order->save();


            if (isset(session('discount')['coupon']))
            {
                $order->discount = session('checkout')['discount'];
                $order->discount_type = session('discount')['name'] . '(' . session('discount')['code'] . ')';

                $coupon = Coupon::find(session('discount')['id']);
                if ($coupon) {
                    if (!$coupon->promo_code) {
                        $coupon->status = '0';
                        $coupon->save();
                    }

                    $coupon_history = new CouponHistory();
                    $coupon_history->coupon_id = $coupon->id;
                    $coupon_history->order_id = $order->id;
                    $coupon_history->customer_id = $user_id;
                    $coupon_history->amount = $order->discount;
                    $coupon_history->save();
                }

            } else if(isset(session('discount')['bonuses'])) {
                $bonus_history = new BonusTransactions();
                $bonus_history->user_id = $user_id;
                $bonus_history->order_id = $order->id;
                $bonus_history->qty = session('discount')['value'];
                $bonus_history->date_end = date('Y-m-d', strtotime('+1 month', strtotime(date("Y-m-d"))));
                $bonus_history->status = StatusEnum::USED;
                $bonus_history->save();
            }


            $bonus_qty = 0;
            foreach (Cart::instance('cart')->content() as $item)
            {
                $order_item = OrderProduct::where('order_id', $order->id)
                    ->where('product_id', isset($item->options['product_id']) ? $item->options['product_id'] : $item->id)
                    ->where('store_id', Store::store_id())->first();
                if(!$order_item)
                {
                $order_item = new OrderProduct();
//           если есть опции то product_id берется из options..
                $name = isset($item->options['option_name']) ? $item->name . ' '. $item->options['option_name'] : $item->name;
                $order_item->product_id = isset($item->options['product_id']) ? $item->options['product_id'] : $item->id;
                $order_item->store_id = Store::store_id();
                $order_item->order_id = $order->id;
                $order_item->price = $item->price;
                $order_item->name = $name;
                $order_item->model = $item->name;
                $order_item->image = $item->options['image'];
                $order_item->quantity = $item->qty;
                $order_item->total = $item->subtotal;
                $order_item->save();

                $setBonusToUser = Bonus::firstWhere('product_id', $order_item->product_id);
                if ($setBonusToUser)
                    {
                        $bonus_qty += $setBonusToUser->qty * $item->qty;
                    }
                }
            }
            if ($bonus_qty > 0)
            {
                $user = User::find($user_id);
                if ($user)
                {
                    $user->bonus += $bonus_qty;
                    $user->save();
                }
                $bonus_history = new BonusTransactions();
                $bonus_history->user_id = $user_id;
                $bonus_history->order_id = $order->id;
                $bonus_history->qty = $bonus_qty;
                $bonus_history->date_end = date('Y-m-d', strtotime('+1 month', strtotime(date("Y-m-d"))));
                $bonus_history->save();
            }

            //if user was registered to referral link
            $referral_user = ReferralUser::where('user_id', $user_id)->where('status', StatusEnum::CREATED)->first();
            if ($referral_user) {
                $parent_user = User::find($referral_user->ref_user_id);
                if ($parent_user) {
                    $parent_user->bonus += $parent_user->bonuses_per_user;
                    $parent_user->save();

                    $referral_user->status = StatusEnum::CONFIRMED;
                    $referral_user->save();

                    $bonus_history = new BonusTransactions();
                    $bonus_history->user_id = $user_id;
                    $bonus_history->order_id = $order->id;
                    $bonus_history->qty = $parent_user->bonuses_per_user;
                    $bonus_history->date_end = date('Y-m-d', strtotime('+1 month', strtotime(date("Y-m-d"))));
                    $bonus_history->save();
                }
            }

           session()->forget('discount');
            return $order;

    }

    public function render()
    {
        return view('livewire.checkout-component')->layout("layouts.base");
    }
}
