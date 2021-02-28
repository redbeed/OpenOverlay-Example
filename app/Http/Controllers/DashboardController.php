<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{

    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'twitchAvailable' => $this->twitchApiCheck(),
            'appTokenAvailable' => $this->appTokenSet(),
        ]);
    }

    private function twitchLinked(): bool {
        $
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
