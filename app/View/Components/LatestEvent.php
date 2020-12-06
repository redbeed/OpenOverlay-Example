<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class LatestEvent extends Component
{

    /** @var string */
    private $defaultUser = 'moVRsss';

    /** @var array */
    private $recentList;

    public function __construct(array $recentList = [])
    {
        $this->recentList = $recentList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $recentUsername = $this->defaultUser;
        $recentFollower = Arr::first($this->recentList);

        if ($recentFollower !== null) {
            $recentUsername = $recentFollower['follower_username'];
        }

        return view('components.latest-event', [
            'recentUsername' => $recentUsername,
        ]);
    }
}
