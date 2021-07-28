<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;

class FollowerController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $connections = collect($user->connections)
            ->keyBy('id');

        $connectionId = $request->get('connection') ?? $connections->keys()->first();

        if ($connections->count() > 0 && !$connections->get($connectionId)) {
            abort(404);
        }

        return Inertia::render('Follower/List', [
            'user' => $user,
            'connections' => [
                'list' => $connections->toArray(),
                'selected' => $connectionId
            ],
        ]);
    }

    public function listAction(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $connectionId = $request->get('connection');
        $connection = $user->connections()->where('id', $connectionId)->first();

        if (empty($connection)) {
            abort(404);
        }

        $perPage = $request->get('per_page', 50);
        $query = $request->get('query');

        $sortSting = $request->get('sort');
        [$sort, $sortDirection] = explode('|', $sortSting ?? 'follower_username|asc');

        $followersQuery = UserFollowers::where('twitch_user_id', $connection->service_user_id)
            ->orderBy($sort, $sortDirection);

        if($query) {
            $followersQuery = $followersQuery->where('follower_username', 'LIKE', '%'.$query.'%');
        }

        return response()->json($followersQuery->paginate($perPage));
    }
}
