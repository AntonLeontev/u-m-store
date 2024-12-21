<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class EmailSendCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'emailsend';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands2'];

    /**
     * @var string Command Description
     */
    protected $description = 'Help command, Get a list of all commands';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {
        $response = $this->getUpdate();


        $text = 'Ваш id Tel '. $response['message']['from']['id'];
        $this->replyWithMessage(compact('text'));

    }
}
