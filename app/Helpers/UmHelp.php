<?php

namespace App\Helpers;

use App\Jobs\ChainApi\MarketplaceBuyProduct;
use App\Jobs\ChainApi\UMTApproveBuyerToMarketplace;
use App\Jobs\ChainApi\UMTIssue;
use App\Models\Checkout\OrderProduct;
use App\Models\Partner\DeliveryAddresses;
use App\Models\QrCodeSalePartner;
use App\Models\RequestSotrudnichestvo;
use App\Models\SEO\SeoTitleForPages;
use App\Models\Store;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;



class UmHelp
{
    /**Custom function
     * Функция добавления partner_id  и изменение прав пользователя
     * в таблице "users" при изменении привязки по номеру телефона в Partners
     */

    public static function updatePartnerIdInUsers($user_id, $partner_id)
    {
        $user = User::find($user_id);
        if ($user->role_id == 2 or $user->role_id == 3) {

            $user->partner_id = $partner_id;
            $user->utype = 'ADM';
            $user->save();

        }
    }

    /**Custom метод
     * Преобразование шаблона текста в SEO фразу.
     * Вместо шаблона подставляются значения для конкретного товара.
     */
    public static function SeoTransformationTemplates($page_name, $direction_id = null)
    {
        //$page_name - название blaid без component
        //Массив для хранения данных Seo
        $seo = array();
        //Данные для преобразования шаблона
        $category_name = session()->get('category_name');
        if (session()->has('city')) {
            $city_name = session()->get('city')['name'];
        } else $city_name = 'Москва';
        $product_name = session()->get('product_name');
        $price = session()->get('price');
        //Шаблоны для замены в тексте
        $templates = array('[категория]', '[название товара]', '[цена]', '[город]');
        //Меняем шаблоны на эти переменные
        $replacements = array($category_name, $product_name, $price, $city_name);
        if ($direction_id) {
            $seo_text = SeoTitleForPages::where('page_name', $page_name)
                ->where('direction_id', $direction_id)
                ->where('status', 'on')
                ->first();
        } else {
            $seo_text = SeoTitleForPages::where('page_name', $page_name)
                ->where('status', 'on')
                ->first();
        }
        if ($seo_text) {
            $seo = [
                'title' => str_replace($templates, $replacements, $seo_text->title),
                'meta_description' => str_replace($templates, $replacements, $seo_text->meta_description),
                'meta_keywords' => str_replace($templates, $replacements, $seo_text->meta_keywords),
                'seo_description' => str_replace($templates, $replacements, $seo_text->seo_description)
            ];
        } else {
            //Если в базе нет записи для данной страницы, то заглушка и запись в лог.
            if (App::environment('production')) {
                // Log::warning('Title and meta default on ' . url()->current());
            }

            $seo = [
                'title' => 'Интернет-магазин Onion Market',
                'meta_description' => 'Интернет-магазин Onion Market',
                'meta_keywords' => 'Интернет-магазин Onion Market',
                'seo_description' => 'Интернет-магазин Onion Market'
            ];
        }

        return $seo;
    }

    public static function sendTelegram($type = 'OnionMarket', $chat_id = '464744447', $view = 'livewire.telegram.ipaid-token-component')
    {


        $response = Telegram::sendMessage([
            'chat_id' => '464744447',
            'parse_mode' => 'HTML',
            'text' => view($view, compact('type'))->render()

        ]);
        return (isset($response) ? $response : false);
    }

    public static function sendTelegramToManager($request, $title = 'Уведомление для менеджера', $chat_id = '-1001679721539')
    {

        $view = 'livewire.telegram.partner-register-component';
        $response = Telegram::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => view($view, compact('request', 'title'))->render()

        ]);

        return (isset($response) ? $response : false);
    }

    /**
     * Функция фиксирует в базу количество и общую сумму покупок через QrCode
     */
    public static function QrCodeOrderWrite($order)
    {
        $qr_code_sale_partner = QrCodeSalePartner::find($order->qr_id);
        if ($qr_code_sale_partner) {
            $qr_code_sale_partner->sale_count += 1;//+ Одна покупка.
            $qr_code_sale_partner->total_sales += $order->total;//+ Общая сумма в заказе.
            $qr_code_sale_partner->save();
            return true;
        }
    }

    /**
     * Функция отправки сообщения о заказе на сайте в Телеграм
     */
    public static function sendOrderToTelegram($order, $partner, $chat_id = '-1001741300676', $title = 'НОВЫЙ ЗАКАЗ НА САЙТЕ UM.ORG')
    {
        $user_wallet = UserWallet::returnWalletByUserId($order->user_id);

        if($user_wallet)
        {
            //Формируем массив цепочки очередей.
            $array_chain = [];
            //Подтверждаем снятие средств с кошелька покупателя в размере общей суммы в корзине.
            $array_chain[]=new UMTApproveBuyerToMarketplace($order->total,$user_wallet->wallet_address);
            //Зачисляем на кошелек покупателя сумму в размере общей суммы в корзине.
            $array_chain[]=new UMTIssue($order->total,$user_wallet->wallet_address);
            //Перебераем все товары в корзине и добавляем в очередь.
            foreach (OrderProduct::where('order_id',$order->id)->get() as $order_item) {
                $array_chain[] = new MarketplaceBuyProduct($order_item->product_store_id, $order_item->quantity, $user_wallet->wallet_address);
            }

            //Запуск цепочки очередей.
            Bus::chain($array_chain)->dispatch();
//            Bus::chain([
//                //Подтверждаем снятие средств с кошелька покупателя в размере общей суммы в корзине.
//                new UMTApproveBuyerToMarketplace($order->total,$user_wallet->wallet_address),
//                //Зачисляем на кошелек покупателя сумму в размере общей суммы в корзине.
//                new UMTIssue($order->total,$user_wallet->wallet_address),
//                 new MarketplaceBuyProduct($order->product_store_id, $order->quantity,
//                     $user_wallet->wallet_address)
//            ])->dispatch();

            $array_chain = [];
            //Перебираем все товары в корзине и запускаем очереди на фиксацию покупки товара в блокчейне.
//            foreach (OrderProduct::where('order_id',$order->id)->get() as $order_item)
//            {
//                MarketplaceBuyProduct::dispatch($order_item->product_store_id, $order_item->quantity, $user_wallet->wallet_address);
//            }
        }



//        https://api.telegram.org/bot<YourBOTToken>/getUpdates


        if ($store = Store::find($partner->store_id)) $city_name = $store->real_name;
        $partner_telephone = preg_replace('/[^0-9]/', '', $partner->telephone);

        #Информация о партнере
        $partner_info = [
            'ID партнера' => $partner->id,
            'Город партнера' => $city_name,
            'Тип партнера' => $partner->partner_type,
            'Название на сайте' => $partner->organisation_name,
            'Короткое название организации' => PHP_EOL . $partner->partner_name,
            'Телефон владельца' => $partner->mobile_tel_owner,
            'email' => $partner->email,
            'Цена доставки партнера' => $partner->delivery_price,
            'Актуальный адрес партнера' => PHP_EOL . $partner->actual_address,
            ':::::::::::::::::' => '::::::::::::::::::::::::::::::::::::::',
            'ТEЛЕФОН МАГАЗИНА' => $partner->telephone,
//                'TELEGRAM' => $partner->telegram,
        ];
        if ($delivery_address = DeliveryAddresses::firstWhere('partner_id', $partner->id)) {

            $partner_info['АДРЕСС ТОЧКИ САМОВЫВОЗА'] = PHP_EOL . $delivery_address->address;
            unset($partner_info['Актуальный адрес партнера']);
        }

        if ($partner->type == 'Самозанятый') {
            $partner_info['ФИО ПАРТНЕРА'] = $partner->fio;
        }
        #ИНФОРМАЦИЯ О ЗАКАЗЕ
        $order_info = [
            'ID заказа' => $order->id,
//            'Сумма заказа' => $order->total,
            'Скидка' => $order->discount,
//            'Фамилия' => $order->lastname,
            'E-mail' => $order->email,
            'Статус' => $order->status == 'payed' ? 'ОПЛАЧЕН' : 'НЕ ОПЛАЧЕН (Сертификат)',
            'Заказ ОБНОВЛЕН' => date("H:i:s d-m-Y", strtotime($order->updated_at)),
            '============================' => '',
            'СПОСОБ ДОСТАВКИ' => $order->is_shipping_different == 'DELIVERY' ? 'ДОСТАВКА ПО АДРЕСУ' : 'САМОВЫВОЗ',
            'АДРЕС ДОСТАВКИ' => $order->is_shipping_different == 'DELIVERY' ? PHP_EOL . $order->city . ', ' . $order->address : 'САМОВЫВОЗ!',
            '==========================' => '',
            'МОБ. ТЕЛЕФОН.' => $order->mobile,
            'ИМЯ ПОКУПАТЕЛЯ' => $order->firstname,
            'КОМЕНТАРИЙ' => $order->comment,
            'ВРЕМЯ ДОСТАВКИ' => is_object($order->delivery_date) ? $order->delivery_date->format('h:i:s d-m-Y') : 'Не выбрано.',
            'ЦЕНА ДОСТАВКИ ДЛЯ КЛИЕНТА' => $order->delivery_price_for_recipient,
            'ЗАКАЗ НА СУММУ' => $order->total . ' РУБ',


        ];
        #ИНФОРМАЦИЯ О ЗАКАЗЕ ЧЕРЕЗ СОЦ. СЕТЬ
        if ($order->order_type == 'social_delivery') {
            $order_info = [
                'ID заказа' => $order->id,
                'Скидка' => $order->discount,
                'E-mail' => $order->email,
                'Статус' => $order->status == 'payed' ? 'ОПЛАЧЕН' : 'НЕ ОПЛАЧЕН',
                'Заказ ОБНОВЛЕН' => date("H:i:s d-m-Y", strtotime($order->updated_at)),
                '============================' => '',
                '' => '============================',
                'ССЫЛКА ПОЛУЧАТЕЛЯ' => '<a href="' . $order->url_recipient . '">' . $order->url_recipient . '</a>',
                'ССЫЛКА ОТПРАВИТЕЛЯ' => '<a href="' . $order->url_sender . '">' . $order->url_sender . '</a>',
                'МОБ. ТЕЛЕФОН.' => $order->mobile,
                'ИМЯ ПОКУПАТЕЛЯ' => $order->firstname,
                'КОМЕНТАРИЙ' => $order->comment,
                'ВРЕМЯ ДОСТАВКИ' => is_object($order->delivery_date) ? $order->delivery_date->format('h:i:s d-m-Y') : 'Не выбрано.',
                'ЦЕНА ДОСТАВКИ ДЛЯ КЛИЕНТА' => $order->delivery_price_for_recipient,
                'ЗАКАЗ НА СУММУ' => $order->total . ' РУБ',

            ];

            if(session()->has('certificate')){
                $order_info['ЗАКАЗ С ИСПОЛЬЗОВАНИЕ СЕРТИФИКАТА.'] = 'НЕОБХОДИМО ПОДТВЕРДИТЬ.';
            }

        }


        $order_product_array = [];
        $order_products = OrderProduct::where('order_id', $order->id)->where('store_id', $partner->store_id)->get();

        #Формирование массива информации о товарах
        foreach ($order_products as $key => $order_product) {
            $order_product_array [$key] = [
                ':::::::::::::::::::::::::::::::::::::::::::::::::::' => '',
                'Инфо о товаре на сайте' =>
                    '<a href="https://unitedmarket.org/'
                    . $store->slug
                    . '/product/'
                    . $order_product->product_id
                    . '">'
                    . $order_product->name . '</a>',
                'Название' => $order_product->name,
                'Количество' => $order_product->quantity,
                'Цена' => $order_product->price,
                'Итого' => $order_product->total,
            ];
        }

        #Выбор блейда для сообщения и отправка сообщения в группу менеджеров
        $view = 'livewire.telegram.manedger-order-info';
//        if (App::environment('production')) {
        $response1 = Telegram::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => view($view, compact('order_info', 'partner_info', 'order_product_array', 'title'))->render()

        ]);
//        }
        #Отправка информации о заказе партнеру.

        if ($chat_id_partner = User::find($partner->user_id)) $chat_id_partner->telegram_id;
        if (is_numeric($chat_id_partner)) {
            $partner_info = false;
            $response2 = Telegram::sendMessage([
                'chat_id' => $chat_id_partner,
                'parse_mode' => 'HTML',
                'text' => view($view, compact('order_info', 'partner_info', 'order_product_array', 'title'))->render()
            ]);
            if (isset($response2)) {
                $response = Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'parse_mode' => 'HTML',
                    'text' => 'Информация по заказу №'.$order->id.' была отправлена партнеру!'

                ]);
            }
        }


        return (isset($response1) ? $response1 : false);
    }

    public static function salePrice($price)
    {
        if ($price == 0) {
            return 0;
        }
        $price_big = (int)($price / 100);
        $price_small = ($price - $price_big * 100);
        if ($price_small > 0) {
            $price_small = 99;
            $newprice = $price_big * 100 + $price_small;
        } else $newprice = $price_big * 100 - 1;
        return $newprice;
    }

    public static function RequestСooperationToBase($title, $arr_request)
    {

        $RequestSotrudnichestvo = RequestSotrudnichestvo::create([
            'title' => $title,
            'source' => $arr_request['Источник'],
            'subject' => $arr_request['Тема'],
            'name' => $arr_request['Имя'],
            'city' => $arr_request['Город'],
            'direction' => $arr_request['Выберите_категорию'],
            'phone_number' => $arr_request['Телефон'],
            'email' => $arr_request['E-mail'],
            'operator_name' => $arr_request['Оператор'],
        ]);
        return $RequestSotrudnichestvo;
    }

    public static function getDomain()
    {
        if (session()->has('domain')) {
            $domain = session()->get('domain');

        } else
            $domain = request()->getHost();
            session()->forget('domain');

        return $domain;
    }

    public static function checkOurDomain()
    {
        $domain = self::getDomain();
        $ourDomain = ['unitedmarket.org', 'unitedmarket.loc', 'u-m.loc', '127.0.0.1', 'onionmarket.ru', 'u-m.store'];
        if ($out = in_array($domain, $ourDomain) or str_contains($domain,'umflowers.ru')) {
            return false;
        } else {

            return $domain;
        }

    }

}
