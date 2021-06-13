<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class ShareInertiaData
{
    public function handle($request, $next)
    {
        Inertia::share(array_filter([
            'twitchUser' => function () use ($request) {
                if (!$request->user()) {
                    return;
                }

                $twitch = $request->user()->connections()->where('service', 'twitch')->first();

                if (empty($twitch)) {
                    return null;
                }

                return $twitch->toArray();
            },
            'message' => Session::pull('message', null)
        ]));

        return $next($request);
    }
}
