<?php

namespace App\Bot\Commands;

use App\Models\Bot\ChatCommand;
use Redbeed\OpenOverlay\ChatBot\Commands\SimpleBotCommands;
use Redbeed\OpenOverlay\ChatBot\Twitch\ConnectionHandler;

class DatabaseCommands extends SimpleBotCommands
{
    public function __construct(ConnectionHandler $connectionHandler)
    {
        parent::__construct($connectionHandler);

        $this->simpleCommands = $this->getCommands();
    }

    protected function getCommands(): array
    {
        return ChatCommand::all()->pluck('response', 'command')->toArray();
    }
}
