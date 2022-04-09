<?php

namespace App\OpenOverlay\Cards\Metrics;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;
use Redbeed\OpenOverlay\Models\User\Connection;

class SubscriberTrend implements JsonSerializable
{

    private Connection $connection;
    private Carbon $startDate;

    public function __construct(Connection $connection, ?Carbon $startDate = null)
    {
        $this->connection = $connection;
        $this->startDate = $startDate ?? today()->subMonth();
    }


    private function subscriber(): Collection
    {
        // subscription between startDate and today
        return UserSubscriber::where('twitch_user_id', $this->connection->service_user_id)
            ->whereNot('subscriber_user_id', $this->connection->service_user_id)
            ->where('created_at', '>', $this->startDate)->get()
            ->groupBy(fn($item) => $item->created_at->format('Y-m-d'))
            ->map(fn($item) => $item->count());
    }

    private function subscriptionEnded(): Collection
    {
        // subscription ended between startDate and today
        return UserSubscriber::where('twitch_user_id', $this->connection->service_user_id)
            ->onlyTrashed()
            ->where('deleted_at', '>', $this->startDate)
            ->where('created_at', '>', $this->startDate)->get()
            ->groupBy(fn($item) => $item->deleted_at->format('Y-m-d'))
            ->map(fn($item) => -($item->count()));
    }

    private function subscriptionBase(): int
    {
        // subscription sum till startDate
        return UserSubscriber::where('twitch_user_id', $this->connection->service_user_id)
            ->whereNot('subscriber_user_id', $this->connection->service_user_id)
            ->where('created_at', '<=', $this->startDate)
            ->count();
    }

    #[ArrayShape(['labels' => "array", 'series' => "array"])]
    public function result(): array
    {
        $subscriber = $this->subscriber();
        $subscriptionEnded = $this->subscriptionEnded();

        $days = [];
        $startDate = $this->startDate->clone();
        $days[$startDate->clone()->subDay()->format('Y-m-d')] = [
            'date'  => $startDate->clone()->subDay()->format('Y-m-d'),
            'count' => $this->subscriptionBase(),
        ];

        while ($startDate < now()->startOfDay()) {
            // sum of subscription and ended subscription for each day
            $count = array_sum([
                $subscriber->get($startDate->format('Y-m-d'), 0),
                $subscriptionEnded->get($startDate->format('Y-m-d'), 0),
                $days[$startDate->clone()->subDay()->format('Y-m-d')]['count'] ?? 0,
            ]);

            $days[$startDate->format('Y-m-d')] = [
                'day'   => $startDate->format('Y-m-d'),
                'count' => $count,
            ];

            $startDate->addDay();
        }

        return [
            'labels' => Arr::pluck($days, 'day'),
            'series' => [
                Arr::pluck($days, 'count')
            ],
        ];
    }

    #[ArrayShape(['labels' => "array", 'series' => "array"])]
    public function jsonSerialize()
    {
        return $this->result();
    }
}
