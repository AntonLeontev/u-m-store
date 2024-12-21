<?php

namespace App\Telegram\Commands\UmSend;

use App\Models\Partners;
use Illuminate\Support\Facades\Log;
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
    protected $description = '';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {
        Log::warning('Start');
        $response = $this->getUpdate();


//        $text = json_encode($response);
//        //idaadfaerrf343436545654
//        $hash_id = Str::after($response['message']['text'],'/start ');
//        $telegram_id = $response['message']['from']['id'];
//        $result = Partners::where('telegram_id',$hash_id)->update(['telegram_id'=>$telegram_id]);
//        $text = json_encode($result);
        $text = 'Я UmSend Bot. Теперь Вы будете получать сообщения от меня.';

        $this->replyWithMessage(compact('text'));

    }
}
