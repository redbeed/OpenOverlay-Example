<?php

namespace App\Http\Controllers;

use App\OpenOverlay\Cards\EventHistory;
use App\OpenOverlay\Cards\Metrics\FollowerTrend;
use App\OpenOverlay\Cards\Metrics\SubscriberTrend;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use JetBrains\PhpStorm\ArrayShape;
use Redbeed\OpenOverlay\Models\BotConnection;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Redbeed\OpenOverlay\Models\User\Connection;

class DashboardController extends Controller
{

    private Connection $connection;

    public function __invoke()
    {
        $this->connection = Auth::user()->connections->first();

        return Inertia::render('Dashboard/View', [
            'followChartData'     => Inertia::lazy(fn() => new FollowerTrend($this->connection)),
            'subscriberChartData' => Inertia::lazy(fn() => new SubscriberTrend($this->connection)),
            'eventHistory' => Inertia::lazy(fn() => new EventHistory($this->connection)),

            'twitchAvailable'     => $this->twitchApiCheck(),
            'appTokenAvailable'   => $this->appTokenSet(),
            'twitchUserConnected' => $this->twitchUserConnected(),
            'botConnected'        => $this->botConnected(),
            'botUserLinked'       => $this->botUserLinked(),
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
