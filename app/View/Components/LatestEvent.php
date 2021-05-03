<?php

namespace App\View\Components;

class LatestEvent extends SteamHUD
{
    public function render()
    {
        return view('components.latest-event', [
            'recent' => $this->latestEvent(),
        ]);
    }
}
