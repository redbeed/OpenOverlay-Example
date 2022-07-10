<?php

namespace App\OpenOverlay\Automations;

use App\Models\User;
use Redbeed\OpenOverlay\Automations\Actions\TwitchChatBotMessage;
use Redbeed\OpenOverlay\Automations\AutomationHandler;
use Redbeed\OpenOverlay\Automations\Filters\ChatMessage\ChatMessageContainsFilter;
use Redbeed\OpenOverlay\Automations\Filters\Filter;
use Redbeed\OpenOverlay\Automations\Filters\Twitch\ChannelStatus;

class HelloOpenOverlayCommandAutomation extends AutomationHandler
{
    public static string $name = 'Hello OpenOverlay';

    public static string $description = 'Says hello to the user';

    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        $twitch = User::where('name', 'moVRs')->first()
            ->connections()->where('service', 'twitch')->first();

        return [
            new ChatMessageContainsFilter('!hello'),
            (new ChannelStatus($twitch))->isOnline(),
        ];
    }

    public function actions(): array
    {
        return [
            new TwitchChatBotMessage('Hello :username, I am alive and made with https://openoverlay.dev'),
        ];
    }
}
