<?php

namespace App\OpenOverlay\Automations\Settings\Filters;

use App\OpenOverlay\Automations\Settings\SettingsHandler;
use App\OpenOverlay\From\Boolean;
use App\OpenOverlay\From\Input;
use Redbeed\OpenOverlay\Automations\Filters\ChatMessage\ChatMessageContainsFilter;

class ChatMessageContainsFilterForm extends SettingsHandler
{
    public static string $referenceObject = ChatMessageContainsFilter::class;

    public function form(): array
    {
        return [
            Input::make('needle')
                ->setPlaceholder('!command, word, phrase...')
                ->required(),

            Boolean::make('caseSensitive')
                ->setLabel('Case sensitive'),
        ];
    }
}
