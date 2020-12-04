<?php

namespace App\Http\Middleware;

use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class ShareInertiaData
{
    public function handle($request, $next)
    {
        Inertia::share(array_filter([
            'twitchUser' => function () use ($request) {
                if (! $request->user()) {
                    return;
                }

                $twitch = $request->user()->connections()->where('service', 'twitch')->first();

                return $twitch->toArray();
            }
        ]));

        return $next($request);
    }
}
