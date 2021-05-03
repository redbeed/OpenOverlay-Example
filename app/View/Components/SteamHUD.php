<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;

class SteamHUD extends Component
{

    /** @var array */
    private $twitchUserId;

    /** @var string[] */
    private $socials = [];

    /** @var string */
    private $mainColor;

    public function __construct(string $twitchUserId, array $socialIcons = [], string $mainColor = 'flamingo')
    {
        $this->twitchUserId = $twitchUserId;
        $this->socials = $socialIcons;
        $this->mainColor = $mainColor;
    }

    protected function latestEvent(): array
    {
        $follower = UserFollowers::where('twitch_user_id', $this->twitchUserId)
            ->orderBy('followed_at', 'DESC')
            ->first();

        $subscriber = UserSubscriber::where('twitch_user_id', $this->twitchUserId)
            ->orderBy('created_at', 'DESC')
            ->first();

        $recent = [
            'title' => 'Latest Follower',
            'name' => $follower['follower_username'] || 'OpenOverlay',
        ];

        if ($follower && $subscriber && $follower['created_at'] > $subscriber['created_at']) {
            $recent = [
                'title' => 'Latest Subscriber',
                'name' => $subscriber['subscriber_username'],
            ];
        }

        return $recent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.steam-hud', [
            'recent' => $this->latestEvent(),
            'socials' => $this->socials,
            'mainColor' => $this->mainColor,
        ]);
    }
}
