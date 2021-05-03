<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Redbeed\OpenOverlay\Models\BotConnection;

class DashboardController extends Controller
{

    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'twitchAvailable' => $this->twitchApiCheck(),
            'appTokenAvailable' => $this->appTokenSet(),
            'twitchUserConnected' => $this->twitchUserConnected(),
            'botConnected' => $this->botConnected(),
            'botUserLinked' => $this->botUserLinked(),
        ]);
    }

    private function botUserLinked(): bool
    {
        return Auth::user()->bots()->where('service', 'twitch')->count() > 0;
    }

    private function botConnected(): bool
    {
        return BotConnection::where('service', 'twitch')->count() > 0;
    }

    private function twitchUserConnected(): ?string
    {
        /** @var Collection $connection */
        $connection = Auth::user()->connections()->where('service', 'twitch')->get();

        return count($connection) ? $connection->first()->service_user_id : null;
    }

    private function appTokenSet(): bool
    {
        return !empty(config('openoverlay.webhook.twitch.app_token.token'));
    }

    private function twitchApiCheck(): bool
    {
        $token = config('services.twitch.client_id');
        $secret = config('services.twitch.client_secret');

        return (empty($token) || empty($secret)) ? false : true;
    }
}
