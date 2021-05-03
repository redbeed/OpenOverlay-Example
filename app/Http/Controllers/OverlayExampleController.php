<?php

namespace App\Http\Controllers;

use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;

class OverlayExampleController extends Controller
{
    public function __invoke(int $twitchUserId)
    {
        $followers = UserFollowers::where('twitch_user_id', $twitchUserId)->orderBy('followed_at', 'DESC')->get();
        $subscribers = UserSubscriber::where('twitch_user_id', $twitchUserId)->orderBy('created_at', 'DESC')->get();

        return view('overlay.example', [
            'twitchUserId' => $twitchUserId
        ]);
    }
}
