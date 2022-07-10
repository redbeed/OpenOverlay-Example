<?php

namespace App\OpenOverlay\Automations\Settings\Actions;

use App\OpenOverlay\Automations\Settings\SettingsHandler;
use App\OpenOverlay\From\Input;
use Redbeed\OpenOverlay\Automations\Actions\TwitchChatBotMessage;

class TwitchChatBotMessageForm extends SettingsHandler
{
    public static string $referenceObject = TwitchChatBotMessage::class;

    public function form(): array
    {
        return [
            Input::make('message')
                ->setPlaceholder('The answer is 42.')
                ->required(),
        ];
    }
}
