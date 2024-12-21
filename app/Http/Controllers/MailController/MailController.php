<?php

namespace App\Http\Controllers\MailController;

use App\Helpers\UmHelp;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Mail\OrderMail;
use App\Models\Partners;
use App\Models\RequestSotrudnichestvo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    #Отправка информации о покупке франшизы
    public static function sendOrderFranchiseSale($order)
    {
        $order = $order->only(['id','transaction_id','mobile','city','status','comment','total']);
        $order_arr = [
            'id Ордера оплаты' => $order['id'],
            'id Транзакции' => $order['transaction_id'],
            'Телефон для связи' => $order['mobile'],
            'Город' => $order['city'],
            'Статус оплаты' => $order['status']=='payed' ? 'Оплачена': $order['status'],
            'Тип покупки' => $order['comment'],
            'Оплачено' => $order['total']. ' RUB',
        ];
        UmHelp::sendTelegramToManager($order_arr ,'!!!ОПЛАЧЕННО Генеральное партнерство!!!');
        UmHelp::sendTelegramToManager($order_arr ,'!!!ОПЛАЧЕННО Генеральное партнерство!!',5023363551);
        return true;
    }

    // Отправка информации по заказу на сейте партнеру и менеджерам
    public static function sendOrderMail($order)
    {
        if($order->comment=='ПОКУПКА ФРАНШИЗЫ')
        {
            self::sendOrderFranchiseSale($order);
        }
        #Выполнение кода если не локальная разработка
        if (App::environment('production')) {
            if (!empty(setting('site.mail')) && setting('site.mail') != 'null') {
                Mail::to('gart.service@yandex.ru')->send(new OrderMail($order, 'mails.order_admin_mail'));
                Mail::to('firstrinat@gmail.com')->send(new OrderMail($order, 'mails.order_admin_mail'));
                Mail::to(setting('site.mail'))->send(new OrderMail($order, 'mails.order_admin_mail'));
            }
            if (!empty($order->email) && $order->email != 'null') {
//                Mail::to('gart.service@yandex.ru')->send(new OrderMail($order, 'mails.order_user_mail'));
                Mail::to('firstrinat@gmail.com')->send(new OrderMail($order, 'mails.order_user_mail'));
                Mail::to($order->email)->send(new OrderMail($order, 'mails.order_user_mail'));
            }
        }


        $partner = Partners::find($order->partner_id);
        if ($partner) {


//            $text_partner =  'Заказ No' . $order->id . ',' . $order->total . 'руб. ' . $order->firstname . ', тел. '. $order->mobile;

            #Выполнение кода если не локальная разработка
            if (App::environment('production')) {
                if (!empty($partner->email) && $partner->email != 'null') Mail::to($partner->email)->send(new OrderMail($order, 'mails.order_admin_mail'));

                if ($partner->telephone != 'null') SmsController::sendSms($partner->telephone, 'У Вас новый заказ No' . $order->id . ' на https://unitedmarket.org/admin/orders');

                $text = $order->city . ', Заказ No' . $order->id . ', цветы, ' . $order->total . 'руб., тел.' . $order->mobile;

            }
//
////             SmsController::sendSms('89269841469', $text);
////           SmsController::sendSms('89065996459', $text);
///
            #Выполнение кода если не локальная разработка
            if (App::environment('production')) {
                SmsController::sendSms('89680093940', $text); //Иван
                SmsController::sendSms('89207532711', $text); //Евгений
            }

            $response = UmHelp::sendOrderToTelegram($order, $partner);
            #Запись продажи через Qr код.
            UmHelp::QrCodeOrderWrite($order);
            //Запись в лог если ошибка отправки сообщения в телеграм
            if (!$response) {
                Log::error('Ошибка отправки сообщения о заказе в телеграм!');
            }
        }

    }

    public function sendApplication(Request $request)
    {
        $arr_request = $request->all();
		
        unset($arr_request['_token']);
        if (session()->has('operator')) {
            $arr_request['Оператор'] = session()->get('operator');
        } else {
            $arr_request['Оператор'] = 'Нет';
		}
		

        $title = 'Новая заявка партнерство';
//        dd($request_data, $title);
        //Отправка сообщения в телеграм.
        // UmHelp::sendTelegramToManager($arr_request, $title);
        // UmHelp::sendTelegramToManager($arr_request,$title, 464744447);
        // UmHelp::sendTelegramToManager($arr_request,$title, -1001679721539);


        // Отправка почты
//        Mail::to('gart.service@yandex.ru')->send(new OrderMail($request->request, 'mails.partner_application'));
        // Mail::to('firstrinat@gmail.com')->send(new OrderMail($request->request, 'mails.partner_application'));
        // Mail::to('danilzuev2144@gmail.com')->send(new OrderMail($request->request, 'mails.partner_application'));
        Mail::to(setting('site.mail'))->send(new OrderMail($request->request, 'mails.partner_application'));
        session()->flash('message', 'Спасибо за вашу заявку! В ближайшее время наш менеджер свяжется с вами');
        return redirect()->away(url()->previous());
    }

}
