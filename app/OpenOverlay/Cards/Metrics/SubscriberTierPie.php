<?php

namespace App\OpenOverlay\Cards\Metrics;

use JsonSerializable;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;
use Redbeed\OpenOverlay\Models\User\Connection;

class SubscriberTierPie implements JsonSerializable
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function result()
    {
        return [
            'series' => UserSubscriber::where('twitch_user_id', $this->connection->service_user_id)
                ->whereNot('subscriber_user_id', $this->connection->service_user_id)->get()
                ->groupBy(fn ($item) => $item->tier)
                ->map(fn ($items)    => [
                    'value' => $items->count(),
                    'name'  => $items->first()->tier_name.' (tier '.$items->first()->tier.')',
                ])->values(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->result();
    }
}
