<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{

    public function __invoke()
    {

        return Inertia::render('Dashboard', [
            'twitchAvailable' => $this->twitchApiCheck(),
        ]);
    }

    private function twitchApiCheck(): bool
    {
        $token = config('services.twitch.client_id');
        $secret = config('services.twitch.client_secret');

        return (empty($token) || empty($secret)) ? false : true;
    }
}
