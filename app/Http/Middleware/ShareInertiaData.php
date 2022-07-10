<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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

                if (empty($twitch)) {
                    return;
                }

                return $twitch->toArray();
            },
            'message' => Session::pull('message', null),
        ]));

        return $next($request);
    }
}
