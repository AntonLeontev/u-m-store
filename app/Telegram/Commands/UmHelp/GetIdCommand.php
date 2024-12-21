<?php

namespace App\Telegram\Commands\UmHelp;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class GetIdCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'getid';

    /**
     * @var array Command Aliases
     */
    protected $aliases = [];

    /**
     * @var string Command Description
     */
    protected $description = 'Команда для получения своего id в Telegram';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {
        $response = $this->getUpdate();

        $text = 'Hey stranger, thanks for visiting me.'.chr(10).chr(10);
        $text .= 'I am a bot and working for'.chr(10);
        $text .= env('APP_URL').chr(10).chr(10);
        $text .= 'Please come and visit me there.'.chr(10);
        $text = 'Ваш id Telegram ';
//            . $response['message']['from']['id'];
        $this->replyWithMessage(compact('text'));

    }
}
