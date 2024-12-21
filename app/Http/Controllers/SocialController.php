<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    private const DRIVERS = [
        'ya' => 'yandex',
        'google' => 'google',
        'vk' => 'vkontakte',
        'ok' => 'odnoklassniki',
        'tg' => 'telegram'
    ];


    /**
     * метод, сробатывающий при переходе по ссылке
     */
    public function index() {

        // название используемого драйвера
        return Socialite::driver($this->getDriverName())->redirect();
    }

    /**
     *  возращает данные для аутентификации
     */
    public function callback() {

        // данные пользователя
        $authUser = Socialite::driver($this->getDriverName())->user();

        // в зависимости от залогинен или нет, присваем соц сеть
        if(Auth::check()) {

            // привязываем соц. сеть
            $this->linkSocial($authUser->getId());

            return redirect('/user/settings')
                ->with('message', 'Социальная сеть: ' . $this->getDriverName() . ' успешно привязана к Вашему аккаунту');

        } else {

            // находим пользователя по email где оно не равно null
            $user = User::whereNotNull('email')->where('email', $authUser->getEmail())
                // если нет такого пользователя, то по id соц сети
                ->orWhereHas('socials', function($query) use ($authUser) {
                    $query->where('socType', $this->getDriverName())
                        ->where('soc_id', $authUser->getId());
                })->first();

            if($user) {

                Auth::login($user);

                return redirect()->route('home');
            }

            return redirect('/login')
                ->with('message', 'Привяжите ' . $this->getDriverName() . ' к своему аккаунту, прежде чем его использовать');
        }

    }

    /**
     * Возращает имя драйвера
     */
    private function getDriverName() {

        return static::DRIVERS[Route::current()->parameter('service')];
    }

    /**
     * Возращает cокращенное имя драйвера
     */
    public static function getShortByDriverName($driverName) {
        foreach(static::DRIVERS as $short => $name) {
            if($name == $driverName) return $short;
        }
        return false;
    }

    /**
     * Возращает все сокращенные имена подключенных соц.сетей пользователя
     * @param $user_id
     * @return mixed
     */
    public static function getUserSocials($user_id) {

        $drivers = DB::table('socials')
            ->where('user_id', $user_id)
            ->pluck('socType');

        if($drivers) return $drivers->map(function($driver) {
               return self::getShortByDriverName($driver);
        })->toArray();

        return [];
    }

    /**
     * Создать привязку/отвязку с соц.сети
     */
    private function linkSocial($soc_id) {

        $social = Social::where('socType', $this->getDriverName())->where('user_id', Auth::id());

        // создаем привязку только если ее нет изначально
        if(!$social->exists()) {
            // присваевам соц сет
            Social::create([
                'socType' => $this->getDriverName(),
                'soc_id' => $soc_id,
                'user_id' => Auth::id(),
                'created_at' => now()
            ]);
        // в противном случае удаляем ее
        } else {
            $social->delete();
        }
    }
}
