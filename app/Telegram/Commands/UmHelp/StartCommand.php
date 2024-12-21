<?php

namespace App\Telegram\Commands\UmHelp;

use App\Models\Partners;
use App\Models\User;
use Illuminate\Support\Str;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = [];

    /**
     * @var string Command Description
     */
    protected $description = 'Команда запуска бота';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {

        $response = $this->getUpdate();

        //Получаем hesh из сообщения
        $hash_id = Str::after($response['message']['text'], '/start ');
        //Если hesh строка то ищем данного пользователя в базе иначе говорим что он уже подписан на рассылку.
        if ($hash_id == '/start') {
            $text = 'Нужно подписаться через личный кабинет. Ошибка №1.';
            $this->replyWithMessage(compact('text'));
            return;
        } elseif (is_numeric($hash_id)) {
            $text = 'Здравствуйте.' . PHP_EOL . 'Вы уже подписаны на рассылку уведомлений.' . PHP_EOL;
            $this->replyWithMessage(compact('text'));
            return;
        } elseif (Str::length($hash_id) != 25) {
            $text = Str::length($hash_id);
            $text = 'Нужно подписаться через личный кабинет. Ошибка подписки №2';
            $this->replyWithMessage(compact('text'));
            return;
        }


        $telegram_id = $response['message']['from']['id'];
        $user = User::firstWhere('telegram_id', $hash_id);
        if ($user) {
            $user->telegram_id = $telegram_id;
            $user->save();
            if ($user->name) $text = 'Здравствуйте ' . $user->name . '!';
            else $text = 'Здравствуйте.';
            $text .= PHP_EOL . 'Вы успешно подписаны на рассылку уведомлений.';
            $text .= PHP_EOL . 'Сюда вам будет приходить подробная информация о заказах.';
            $text .= PHP_EOL . '';

            $this->replyWithMessage(compact('text'));

            return;
        } else $text = 'Нужно подписаться через личный кабинет. Ошибка подписки №2.';
        $this->replyWithMessage(compact('text'));

    }
}
