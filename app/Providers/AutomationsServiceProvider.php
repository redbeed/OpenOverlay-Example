<?php

namespace App\Providers;

use App\OpenOverlay\Automations\HelloOpenOverlayCommandAutomation;
use Redbeed\OpenOverlay\Automations\AutomationsServiceProvider as OOAutomationsServiceProvider;
use Redbeed\OpenOverlay\Automations\Triggers\ScheduleTrigger;
use Redbeed\OpenOverlay\Automations\Triggers\TwitchChatMessageTrigger;

class AutomationsServiceProvider extends OOAutomationsServiceProvider
{
    protected array $automations = [
        TwitchChatMessageTrigger::class => [
            HelloOpenOverlayCommandAutomation::class,
        ],

        ScheduleTrigger::class => []
    ];
}
