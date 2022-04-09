<?php

namespace App\OpenOverlay\Cards\Metrics;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Redbeed\OpenOverlay\Models\User\Connection;

class FollowerTrend implements JsonSerializable
{

    private Connection $connection;
    private Carbon $startDate;

    public function __construct(Connection $connection, ?Carbon $startDate = null)
    {
        $this->connection = $connection;
        $this->startDate = $startDate ?? today()->subMonth();
    }


    private function follows(): Collection
    {
        // follows between startDate and today
        return UserFollowers::where('twitch_user_id', $this->connection->service_user_id)
            ->where('followed_at', '>', $this->startDate)->get()
            ->groupBy(fn($item) => $item->followed_at->format('Y-m-d'))
            ->map(fn($item) => $item->count());
    }

    private function unfollows(): Collection
    {
        // unfollows between startDate and today
        return UserFollowers::where('twitch_user_id', $this->connection->service_user_id)
            ->onlyTrashed()
            ->where('deleted_at', '>', $this->startDate)->get()
            ->groupBy(fn($item) => $item->deleted_at->format('Y-m-d'))
            ->map(fn($item) => -($item->count()));
    }

    private function followSum(): int
    {
        // follows sum till startDate
        return UserFollowers::where('twitch_user_id', $this->connection->service_user_id)
            ->where('followed_at', '<=', $this->startDate)
            ->orWhere('deleted_at', '>', $this->startDate)
            ->count();
    }

    #[ArrayShape(['labels' => "array", 'series' => "array"])]
    public function result(): array
    {
        $followsPerDay = $this->follows();
        $unfollowsPerDay = $this->unfollows();

        $days = [];
        $startDate = $this->startDate->clone();
        $days[$startDate->clone()->subDay()->format('Y-m-d')] = [
            'date'  => $startDate->clone()->subDay()->format('Y-m-d'),
            'count' => $this->followSum(),
        ];

        while ($startDate < now()->startOfDay()) {
            // sum of follows and unfollows for each day
            $count = array_sum([
                $followsPerDay->get($startDate->format('Y-m-d'), 0),
                $unfollowsPerDay->get($startDate->format('Y-m-d'), 0),
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
