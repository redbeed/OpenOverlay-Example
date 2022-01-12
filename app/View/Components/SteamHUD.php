<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;

class SteamHUD extends Component
{
    public string $twitchUserId;

    /** @var string[] */
    public array $socials = [];

    public string $mainColor;
    public array $recent;

    public function __construct(string $twitchUserId, array $socialIcons = [], string $mainColor = 'flamingo')
    {
        $this->twitchUserId = $twitchUserId;
        $this->socials = $socialIcons;
        $this->mainColor = $mainColor;
    }

    protected function latestEvent()
    {
        $follower = UserFollowers::where('twitch_user_id', $this->twitchUserId)
            ->orderBy('followed_at', 'DESC')
            ->first();

        $subscriber = UserSubscriber::where('twitch_user_id', $this->twitchUserId)
            ->orderBy('created_at', 'DESC')
            ->first();

        $this->recent = [
            'title' => 'Latest Follower',
            'name'  => $follower['follower_username'] ?: 'OpenOverlay',
        ];

        if ($follower && $subscriber && $follower['created_at'] > $subscriber['created_at']) {
            $this->recent = [
                'title' => 'Latest Subscriber',
                'name'  => $subscriber['subscriber_username'],
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $this->latestEvent();

        return view('components.overlay.steam-hud');
    }
}
