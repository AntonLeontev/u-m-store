<?php

namespace App\Telegram\Commands\UmHelp;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class EmailCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'email';

    /**
     * @var array Command Aliases
     */
    protected $aliases = [];

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
