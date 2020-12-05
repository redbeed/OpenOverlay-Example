<?php

namespace App\Http\Controllers;

class OverlayExampleController extends Controller
{
    public function __invoke(int $twitchUserId)
    {
        return view('overlay.example', [
            'twitchUserId' => $twitchUserId
        ]);
    }
}
