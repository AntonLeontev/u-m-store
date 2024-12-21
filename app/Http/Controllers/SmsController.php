<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;
use stdClass;

class SmsController extends Controller
{

    public static function sendSms($phone, $text)
    {

        {
            $smsru = new SmsService('B0C4B1BB-CF6C-9D8E-408F-753E14ECE28D'); // Ваш уникальный программный ключ, который можно получить на главной странице

            $data = new stdClass();
            $data->to = $phone;
            $data->text = $text; // Текст сообщения
            $data->from = 'UnitedM'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
            // $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
            // $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
//        $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
            // $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
            $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную
            if ($sms->status == "OK") { // Запрос выполнен успешно
                //        echo "Сообщение отправлено успешно. ";
                //        echo "ID сообщения: $sms->sms_id. ";
                //        echo "Ваш новый баланс: $sms->balance";

                return true;
            } else {
                //        echo "Сообщение не отправлено. ";
                //        echo "Код ошибки: $sms->status_code. ";
                //        echo "Текст ошибки: $sms->status_text.";
                return false;
            }
        }
    }
}
