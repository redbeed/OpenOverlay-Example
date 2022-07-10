<?php

namespace App\OpenOverlay\Cards;

use Illuminate\Support\Arr;
use JsonSerializable;
use Redbeed\OpenOverlay\Models\Twitch\EventSubEvents;
use Redbeed\OpenOverlay\Models\User\Connection;

class EventHistory implements JsonSerializable
{
    private Connection $connection;

    private array $ignoreEvents;

    public function __construct(Connection $connection, ?array $ignoreEvents = ['channel.channel_points_custom_reward_redemption.add'])
    {
        $this->connection = $connection;
        $this->ignoreEvents = $ignoreEvents;
    }

    public function results()
    {
        return EventSubEvents::where('event_user_id', $this->connection->service_user_id)
            ->whereNotIn('event_type', $this->ignoreEvents)
            ->select('event_id', 'event_type', 'event_sent', 'event_data')
            ->orderBy('event_sent', 'desc')
            ->limit(100)
            ->get()
            ->map(function (EventSubEvents $event) {
                $eventData = Arr::dot($event->event_data);

                return [
                    'id'          => $event->event_id,
                    'description' => __('event_history.event_type.'.$event->event_type, (array) $eventData),
                    'data'        => $eventData,
                    'sent'        => $event->event_sent->diffForHumans(),
                ];
            });
    }

    public function jsonSerialize()
    {
        return $this->results();
    }
}
