<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;
use App\Http\Controllers\MailController\MailController;
use App\Models\Bonus;
use App\Models\BonusTransactions;
use App\Models\Checkout\Order;
use App\Models\Checkout\OrderProduct;
use App\Models\Checkout\Transaction;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\DeliveryPrice;
use App\Models\Directions;
use App\Models\GiftCertificate;
use App\Models\Notifications;
use App\Models\Partner\DeliveryAddresses;
use App\Models\Partners;
use App\Models\QrCodeSalePartner;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDetails\ReferralUser;
use App\Services\YookassaService;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Manny\Manny;

class CartComponent extends Component
{

    public $coupon_code;
    public $promo_code;
    public $discount;
    public $subtotalAfterDiscount;
    public $totalAfterDiscount;
    public $haveCode;
    public $qty;
    public $bonuses_total;
    public $bonuses;
    public $use_bonuses;
    public $delivery_price;
    public $delivery_prices;
    public $delivery_price_sochi;
    public $partner;

    public $recipient;
    public $recipient_name;
    public $recipient_email;
    public $recipient_phone;

    public $delivery;
    public $delivery_time = 0;
    public $delivery_date;
    public $delivery_hour = '10:00';
    public $delivery_address;
    public $partner_address;
    public $partner_address_selected;
    public $delivery_city;
    public $delivery_city_sochi = false;
    public $recipient_message;

    public $user_ip;
    public $user_phone;

    #Переменные для доставки через соц. сети.
    public $social_delivery;
    public $url_sender;
    public $url_recipient;
    public $social_telegram_sender;
    public $telegram_sender;
    public $social_telegram_recipient;
    public $telegram_recipient;

    #Переменные для подарочного сертификата.
    public $gift_certificate;
    public $gift_certificate_nominal;
    public $gift_certificate_type;

    #Название атрибутов для валидации
    protected $validationAttributes = [
        'recipient_message' => 'Комментарий',
        'user_phone' => 'Номер телефона',
        'coupon_code' => 'Промокод',
        'social_delivery' => 'Доставка через соц сети',
        'url_sender' => 'Ссылка отправителя',
        'url_recipient' => 'Ссылка получателя',
        'telegram_sender' => 'Никнейм отправителя',
        'telegram_recipient' => 'Никнейм получателя',
    ];

    #Сообщения при валидации
    protected $messages = [
        'url_sender.regex' => 'Ссылка должна начинаться с https://vk.com/ или https://ok.ru/',
//         или https://www.facebook.com/ или https://www.instagram.com/',
        'url_recipient.regex' => 'Ссылка должна начинаться с https://vk.com/ или https://ok.ru/',
//         или https://www.facebook.com/ или https://www.instagram.com/',
        'telegram_sender.regex' => 'Ник телеграм должен начинаться с @ и может содержать a-z 0-9 и знак подчеркивания. Минимум 5 и максимум 32 символа.',
        'telegram_recipient.regex' => 'Ник телеграм должен начинаться с @ и может содержать a-z 0-9 и знак подчеркивания. Минимум 5 и максимум 32 символа.',

    ];
    #Правила валидации
    protected function rules()
    {
        $rules = [
            'recipient' => 'required',
            'delivery' => 'required',
            'recipient_message' => 'max:250',
            'coupon_code' => 'max:20',

        ];
        if ($this->social_delivery) {
            $rules['recipient'] = '';
            if ($this->social_telegram_recipient) {
                $rules['telegram_recipient'] = array('required', 'regex:/^@(?=\w{5,32}\b)[a-z_A-Z0-9]*/im');
            } else {
                $rules['url_recipient'] = array('required', 'url', 'regex:/^(https:\/\/ok\.ru\/|https:\/\/vk\.com\/|https:\/\/www\.vk\.com\/|https:\/\/www\.instagram\.com\/|https:\/\/www\.facebook\.com\/|https:\/\/instagram\.com\/|https:\/\/facebook\.com\/)/i');
            }
            if ($this->social_telegram_sender) {
                $rules['telegram_sender'] = array('required', 'regex:/^@(?=\w{5,32}\b)[a-z_A-Z0-9]*/im');
            } else {
                $rules['url_sender'] = array('required', 'url', 'regex:/^(https:\/\/ok\.ru\/|https:\/\/vk\.com\/|https:\/\/www\.vk\.com\/|https:\/\/www\.instagram\.com\/|https:\/\/www\.facebook\.com\/|https:\/\/instagram\.com\/|https:\/\/facebook\.com\/)/i');
            }

        }
        if (Auth::check()) {
            if (!Auth::user()->phone && !$this->social_delivery) {
                $rules['user_phone'] = 'required|min:11';
            }
        }

        if ($this->recipient && !$this->social_delivery) {
            $rules['recipient_name'] = 'required|min:3';
            $rules['recipient_phone'] = 'required|min:10';
        }
        if ($this->delivery_time) {
            $rules['delivery_date'] = 'required';
        }
        return $rules;
    }

    #Установка первоночальных значений
    public function mount(Request $request)
    {
        #Установка переменных для заказа через соц. сети.
        $this->url_sender = 'https://';
        $this->social_delivery = false;

        $this->user_ip = $request->ip();
        $this->haveCode = 1;
        $this->recipient = false;
        if (isset(session('city')['name'])) {
            $this->delivery_city = session('city')['name'];
            if($this->delivery_city == 'Менделеево') {
                $this->delivery_city_sochi = 1;
            }
        }
        // if(session()->has('direction_id')) {
        //     $partner = Partners::where('store_id', Store::store_id())->where('direction_id',session()->get('direction_id'))->first();
        // } else {
		// }
		$partner = Partners::firstWhere('store_id', Store::store_id());


        if ($partner) {
            $this->partner = $partner;
            if ($partner->delivery_price) {
                $this->delivery_price = $partner->delivery_price;
            }
            $partner_addresses = DeliveryAddresses::where('partner_id', $partner->id)->where('status', 1)->get();

            if (!$partner_addresses->isEmpty()) {
                $this->partner_address_selected = 0;
                $this->partner_address = $partner_addresses;
                $this->delivery = 0;

            } else {

                $this->delivery = true;
            }
        }

		$this->delivery_prices = DeliveryPrice::where('partner_id', $partner->id)->get();

        if (Auth::check()) {
            $this->bonuses_total = BonusTransactions::where('user_id', Auth::id())->where('status', StatusEnum::BUYED)->sum('qty');
            $this->delivery_address = Auth::user()->address ? Auth::user()->address : '';
        }
        session()->put('previous_url', route('product.cart'));
        if (session()->has('discount')) $this->calculateDiscount();

        #Подарочный сертификат
        if (session()->has('certificate')) {
            $gift_certificate = GiftCertificate::validateCertificate($this->partner);

            if ($gift_certificate) {
                $this->gift_certificate = $gift_certificate;
                $this->gift_certificate_nominal = $gift_certificate->nominal;
            }
        }

        if(session()->has('certificate_type'))
        {
            $this->gift_certificate_type = session()->get('certificate_type');
        }
    }

    #Функция похоже не используется код вызова закомментирован.
    public function editRecipient($arg)
    {
        $this->recipient = $arg;
        if (!$arg) {
            session()->put('recipient', [
                'name' => $this->recipient_name,
                'phone' => $this->recipient_phone,
                'email' => $this->recipient_email

            ]);
        }
    }

    #Увеличение количества товара +1
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        if (session()->has('coupon')) $this->calculateDiscount();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        Cart::instance('cart')->store($this->user_ip . Store::store_id());
    }

    #Уменьшение количества товара -1
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        if ($product->qty > 1) {
            $qty = $product->qty - 1;
            Cart::instance('cart')->update($rowId, $qty);
            if (session()->has('coupon')) $this->calculateDiscount();
            $this->emitTo('includes.cart-count-component', 'refreshComponent');
        }
        Cart::instance('cart')->store($this->user_ip . Store::store_id());
    }

    #Установка количества единиц товара из выпадающего списка в мобильной версии.
    public function setQuantity($rowId, $qty)
    {
        Cart::instance('cart')->update($rowId, $qty);
        if (session()->has('coupon')) $this->calculateDiscount();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        Cart::instance('cart')->store($this->user_ip . Store::store_id());
    }

    #Функция применения промокода
    public function haveCode()
    {

        $coupon = Coupon::where('code', $this->coupon_code)
            ->where('total', '<', (int)Cart::instance('cart')->subtotal())
            ->where('date_start', '<=', Carbon::today())
            ->where('date_end', '>=', Carbon::today())
            ->where('status', 1)
            ->first();

        if ($coupon) {
            session()->put('discount', [
                'coupon' => true,
                'id' => $coupon->id,
                'name' => $coupon->name,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'is_promo' => $coupon->promo_code,
                'value' => $coupon->discount,
                'max_discount' => $coupon->max_discount
            ]);

            $this->calculateDiscount();
            if ($coupon->promo_code) {
                session()->flash('success_message', 'Промокод успешно активирован!');
            } else {
                session()->flash('success_message', 'Купон успешно активирован!');
            }

        } else {

            session()->flash('success_message', 'Ошибка: Купон или промокод не действителен, либо истек срок его действия!');
            session()->forget('coupon');
        }
    }

    #Использование бонусов.
    public function useBonuses()
    {
        if ($this->bonuses && $this->bonuses > 0) {
            if ($this->bonuses > $this->bonuses_total) {
                $this->bonuses = $this->bonuses_total;
            }
            if ($this->bonuses > Cart::instance('cart')->subtotal() / 2) {
                $this->bonuses = Cart::instance('cart')->subtotal() / 2;
            }


            session()->put('discount', ['bonuses' => true, 'value' => $this->bonuses]);
            $this->calculateDiscount();
            session()->flash('success_message', 'Бонусы успешно активированы!');

        }

    }

    #Подсчет скидки на товар
    public function calculateDiscount()
    {

        if (isset(session('discount')['coupon'])) {
            if (session()->get('discount')['type'] == 'F') {

                $this->discount = session()->get('discount')['value'];
            } else {
                $this->discount = number_format((Cart::instance('cart')->subtotal() * session()->get('discount')['value']) / 100, 0, '', '');

                if (session()->get('discount')['max_discount'] > 0 && $this->discount > session()->get('discount')['max_discount']) {
                    $this->discount = session()->get('discount')['max_discount'];
                }
            }

            $this->coupon_code = session()->get('discount')['code'];
        } elseif (isset(session('discount')['bonuses'])) {
            $this->discount = session()->get('discount')['value'];
        } elseif (isset(session('discount')['gift_certificate']))
        {
            $this->discount = session()->get('discount')['value'];
        }

        $this->subtotalAfterDiscount = number_format(Cart::instance('cart')->subtotal() - $this->discount, 0, '', '');
        $this->totalAfterDiscount = (int)$this->subtotalAfterDiscount;

        if ($this->delivery && $this->delivery_price) {
            $this->totalAfterDiscount = (int)$this->subtotalAfterDiscount + (int)$this->delivery_price;
        }
//        if($this->delivery_price) $this->totalAfterDiscount += (int)$this->delivery_price;
    }

    #Удалить скидку на товар
    public function removeDiscount()
    {
        session()->forget('discount');
        $this->coupon_code = '';
    }

    #Обновление на странице
    public function updated($name, $value)
    {
        if ($name == 'recipient' && $value == false) $this->social_delivery = false;
        if ($name === 'delivery' && $value === 1) {
            $this->calculateDiscount();
        }
//        dd($name);
        $this->validateOnly($name);
    }

    #Функция налаживания маски на телефонный номер
    public function phoneMask()
    {
        if ($this->recipient_phone) {
            if (strlen($this->recipient_phone) > 9) {
                $arr = str_split($this->recipient_phone);
                if ($arr[0] != 7) {
                    $arr[0] = 7;
                    $this->recipient_phone = implode('', $arr);
                }
                $this->recipient_phone = Manny::mask($this->recipient_phone, '1(111) 111 11 11');

            }
        }
        if ($this->user_phone) {
            if (strlen($this->user_phone) > 10) {
                $arr = str_split($this->user_phone);
                if ($arr[0] != 7) {
                    $arr[0] = 7;
                    $this->user_phone = implode('', $arr);
                }
                $this->user_phone = Manny::mask($this->user_phone, '1(111) 111 11 11');

            }
        }

    }

    #Установка цены для заказа
    public function setAmountForCheckout()
    {
        /** Обнуление доставки при заказе на сумму более 2000руб
         * код добавлен в феврале 2022  */
        if (Cart::instance('cart')->total() > 2000 && $this->delivery_city_sochi !=2) {
            $this->delivery_price = 0;
        }
//        if($this->gift_certificate_nominal)
//        {
//            Cart::istance('cart');
//        }

        if ($this->delivery && !$this->delivery_address && !$this->social_delivery) {
            session()->flash('delivery_address_error', 'Укажите адрес*');
            return false;
        }
        $total_qty = 0;
        foreach (Cart::instance('cart')->content() as $item) {
            $total_qty += $item->qty;
        }

        if (session()->has('discount')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'qty' => $total_qty,
                'subtotal' => $this->subtotalAfterDiscount,
                'total' => $this->totalAfterDiscount,
                'delivery_price' => $this->delivery_price
            ]);
        } else {
            $total = Cart::instance('cart')->total();
            if ($this->delivery && $this->delivery_price) {
                $total += $this->delivery_price;
            }

            #Добавил для учета сертификата в заказе.
            if($this->gift_certificate_nominal)
            {
                $total-=$this->gift_certificate_nominal;
                if($total<0) $total=0;
            }

            session()->put('checkout', [
                'discount' => 0,
                'qty' => $total_qty,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'total' => $total,
                'delivery_price' => $this->delivery_price
            ]);
        }

        if ($this->recipient && !$this->social_delivery) {
            session()->put('order', [
                'recipient' => $this->recipient,
                'name' => $this->recipient_name ? $this->recipient_name : 'NoName',
                'surname' => ' ',
                'phone' => $this->recipient_phone ? $this->recipient_phone : 'NoPhone',
                'message' => $this->recipient_message,
                'user_name' => Auth::user()->name,
            ]);
        } else {
            #Eсли в базе нет телефона пользователя то добавляем
            if (!Auth::user()->phone) {
                $phone = $this->user_phone;
                User::find(Auth::user()->id)->update([
                    'phone' => $phone
                ]);
            } else $phone = Auth::user()->phone;

            session()->put('order', [
                'recipient' => $this->recipient,
                'name' => Auth::user()->name ? Auth::user()->name : 'NoName',
                'surname' => ' ',
                'phone' => $phone,
                'message' => $this->recipient_message,
                'user_name' => Auth::user()->name,
            ]);

        }

// Способ доставки

        if ($this->delivery) {
            session()->put('shipping', [
                'delivery' => $this->delivery,
                'city' => $this->delivery_city,
                'address' => $this->delivery_address
            ]);
        } else {
            session()->put('shipping', [
                'delivery' => $this->delivery,
                'city' => $this->delivery_city,
                'address' => ($this->partner and isset($this->partner_address[$this->partner_address_selected]))
                    ? $this->partner_address[$this->partner_address_selected]->address : 'no_address'
            ]);
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = 0;
        $transaction->total = session('checkout')['total'];
        $transaction->save();

        $order = $this->setOrder($transaction->id);
        if ($order and session('checkout')['total']>0) {
            $description = 'Оформление заказа №' . $order->id;
            $transaction->order_id = $order->id;

            #Создание платежа через Yookassa
            $service = new  YookassaService();
            $payment = $service->createPayment(session('checkout')['total'], $description, [
                'transaction_id' => $transaction->id,
                'order_id' => $order->id,
                'store_id' => Store::store_id(),
//                'partner_id' => Store::find(Store::store_id())->partner_id,
                'partner_id' => $this->partner->id,
            ]);
            $transaction->payment_id = $payment->_id;
            $transaction->mode = 'yoomoney';
            $transaction->save();
            return redirect()->away($payment->getConfirmation()->getConfirmationUrl());
        }
    }

    #Удаление отдельного товара в корзине
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        if (session()->has('coupon')) $this->calculateDiscount();
        Cart::instance('cart')->store($this->user_ip . Store::store_id());

    }

    #Удаление всех товаров в корзине
    public function destroyAll()
    {
        session()->forget('coupon');
        Cart::instance('cart')->destroy();
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        Cart::instance('cart')->store($this->user_ip . Store::store_id());
    }

    #Добавление товара в избранное
    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
    }

    #Удаление товара из избранного
    public function removeFromWishList($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
            }
        }

    }

    #Оформление заказа
    public function checkout()
    {

        $this->validate();

        if (session()->has('discount')) $this->calculateDiscount();
        $this->setAmountForCheckout();
//        return redirect()->route('checkout');

    }

    public function getDate($value)
    {
        dd($value);
    }
    #Формирование ордера продажи товара
    public function setOrder($transaction_id)
    {
        $user_id = Auth::id();
        #Закоментировал ошибочное определение партнера в городе.
//        $partner_id = Store::find(Store::store_id())->partner_id;
        $partner_id = Partners::firstWhere('store_id', Store::store_id())->id;

        $order = Order::where('user_id', $user_id)->where('total', '=', session('checkout')['total'])->where('status', StatusEnum::ORDERED)->get()->last();
//        dd($order,session('checkout')['total']);
        if (!$order) {
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
        if (Auth::user()->email) $order->email = Auth::user()->email;
        $order->comment = session('order')['message'];
        $order->city = session('shipping')['city'];
        $order->address = session('shipping')['address'];
        if ($this->delivery_time) $order->delivery_date = Carbon::parse($this->delivery_date . ' ' . $this->delivery_hour);

        if (session('shipping')['delivery']) {
            $order->is_shipping_different = StatusEnum::DELIVERY;
        } else {
            $order->is_shipping_different = StatusEnum::SELF_DELIVERY;
        }

        #Дополнительная информация, если заказ через социальные сети.
        if ($this->social_delivery) {
            #Сохраняем ссылки на соцсети получателя и отправителя в таблицу orders
            $order->order_type = 'social_delivery';
            $order->url_sender = $this->social_telegram_sender ? $this->telegram_sender : $this->url_sender;
            $order->url_recipient = $this->social_telegram_recipient ? $this->telegram_recipient : $this->url_recipient;

        }
        #Цена доставки для клиента.
        $order->delivery_price_for_recipient = $this->delivery_price;
        #Проверка зашел ли пользователь по qr коду. Если да то записываем это в заказ.
        if ($qr_id = $this->QrCodeOrderAdd()) $order->qr_id = $qr_id;

        $order->save();


        if (isset(session('discount')['coupon'])) {
            $order->discount = session('checkout')['discount'];
            $order->discount_type = session('discount')['name'] . '(' . session('discount')['code'] . ')';

//            ?? Должен быть save его нет, похоже что не работает.

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

        } else if (isset(session('discount')['bonuses'])) {
            $bonus_history = new BonusTransactions();
            $bonus_history->user_id = $user_id;
            $bonus_history->order_id = $order->id;
            $bonus_history->qty = session('discount')['value'];
            $bonus_history->date_end = date('Y-m-d', strtotime('+1 month', strtotime(date("Y-m-d"))));
            $bonus_history->status = StatusEnum::USED;
            $bonus_history->save();
        }


        $bonus_qty = 0;
        foreach (Cart::instance('cart')->content() as $item) {
            $order_item = OrderProduct::where('order_id', $order->id)
                ->where('product_id', isset($item->options['product_id']) ? $item->options['product_id'] : $item->id)
                ->where('store_id', Store::store_id())->first();
            if (!$order_item) {
                $order_item = new OrderProduct();
//           если есть опции то product_id берется из options..
                $name = isset($item->options['option_name']) ? $item->name . ' ' . $item->options['option_name'] : $item->name;
                $order_item->product_id = isset($item->options['product_id']) ? $item->options['product_id'] : $item->id;
                $order_item->store_id = Store::store_id();
                $order_item->order_id = $order->id;
                $order_item->partner_id = $item->options->partner_id;
                $order_item->product_store_id = $item->options->product_to_store_id;
                $order_item->price = $item->price;
                $order_item->name = $name;
                $order_item->model = $item->name;
                $order_item->image = $item->options['image'];
                $order_item->quantity = $item->qty;
                $order_item->total = $item->subtotal;

                $order_item->save();

                $setBonusToUser = Bonus::firstWhere('product_id', $order_item->product_id);
                if ($setBonusToUser) {
                    $bonus_qty += $setBonusToUser->qty * $item->qty;
                }
            }
        }
        if ($bonus_qty > 0) {
            $user = User::find($user_id);
            if ($user) {
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
//        Тест отправки информации по заказу в локальной среде.

        if (App::environment('local') or session('checkout')['total']==0) {

            (new MailController())->sendOrderMail($order);
            GiftCertificate::useCertificate($this->gift_certificate);
            return redirect()->route('success');
        }


        $new_notification = new Notifications();
        $new_notification->user_id = $order->user_id;
        $new_notification->url = 'ordered';
        $new_notification->title = 'Новый заказ';
        $new_notification->date = Carbon::parse(Carbon::now())->format('d.m.Y');
        $new_notification->save();
        return $order;
    }

    #Функция фиксации покупки с использованием Qr кода партнера по продажам.
    public function QrCodeOrderAdd()
    {
        if (session()->has('qr')) {
            $qr_sale_partner = QrCodeSalePartner::firstWhere('qr_slug', session()->get('qr'));
            if ($qr_sale_partner) {
                return $qr_sale_partner->id;
            } else return false;
        }
    }

//    Указываем Город в Менделеево и стоимость доставки
    public function setCity($value) {
        $value_arr = explode('-',$value);
        $this->delivery_city = $value_arr[0];
        $this->delivery_price = $value_arr[1];
        if($this->delivery_city != 'Менделеево') {
            $this->delivery_city_sochi = 2;
        }
    }
    public function render()
    {
//        $this->totalAfterDiscount = 0;
        return view('livewire.cart-component')->layout("layouts.base");
    }


}
