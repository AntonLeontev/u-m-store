<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use mysql_xdevapi\Table;

class GiftCertificate extends Model
{
    use HasFactory;

    protected $table = 'gift_certificates';
    public static function boot()
    {
        parent::boot();

        static::creating(function($gift_certificates) {
            $slug = Str::random(40);
            $gift_certificates->slug = (string) $slug;
            $gift_certificates->full_url = 'https://unitedmarket.org?certificate=' . $slug;
            $gift_certificates->user_id = Auth::user()->id;

        });
    }

    #Функция использования сертификата
    public static function useCertificate($certificate)
    {
        $certificate->used_at = Carbon::now();
        $certificate->user_id_used = Auth::user()->id;
        $certificate->save();
    }

    #Функция валидации сертификата
    public static function validateCertificate($partner)
    {
        $certificate = GiftCertificate::firstWhere('slug', session()->get('certificate'));
        $text = false;
        if ($certificate) {
            #Проверка использован сертификат или нет.
            if ($certificate->used_at) {
                $text[] = 'Сертификат уже использован.';

            }
            #Проверка ограничения действия сертификата по городу
            if ($certificate->store_id and $certificate->store_id != Store::store_id()) {
                $text[] = 'Сертификат не может использоваться в данном городе.';

            }

            #Проверка ограничения срока действия сертификата
            if (Carbon::now() < Carbon::parse($certificate->start_action_at) or (Carbon::now() > Carbon::parse
            ($certificate->end_action_at) and
                    $certificate->end_action_at != null)) {
                $text[] = 'Срок действия сертификата недействителен.';

            }
            if ($partner) {
                #Проверка ограничения действия сертификата виду деятельности
                if (($certificate->direction_id) and ($certificate->direction_id != $partner->direction_id)) {
                    $text[] = 'Сертификат не может быть использован для данного типа товара или услуги.';

                }
                #Проверка ограничения действия сертификата партнеру
                if ($certificate->partner_id and $certificate->partner_id != $partner->id) {
                    $text[] = 'Сертификат не может использоваться у данного поставщика товара или услуги.';

                }
            }
//            dd($text,$certificate->direction_id, $partner->direction_id, $partner);
//            dd($partner);
//            dd($certificate);
//            dd($text, Carbon::now()> Carbon::parse($certificate->start_action_at));
//            dd($text);
//            (Carbon::now() > Carbon::parse
//                ($certificate->end_action_at));
            #Если не прошел проверки, то пишем лог.
            if ($text) {
                $send_text = '';
                foreach ($text as $key=>$item)
                {
                    $send_text .= $key+1 . ' '.$item. PHP_EOL.PHP_EOL;
                }
                $send_text .='ip пользователя '.Request::ip();
                $send_text .='Сертификат= '. $certificate->full_url;
                Log::warning($send_text);
                return false;
            #Вернуть сертификат если он прошел все проверки.
            } else {
                return $certificate;
            }

        #Если сертификат не найден сообщить о попытке подбора кода сертификата.
        } else {
            Log::warning('ПОПЫТКА ПОДБОРА ПОДАРОЧНОГО СЕРТИФИКАТА IP=' . Request::ip());
            return false;
        }
    }
}
