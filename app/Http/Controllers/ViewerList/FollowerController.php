<?php

namespace App\Http\Controllers\ViewerList;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Symfony\Component\HttpFoundation\Response;

class FollowerController extends ViewerListController
{
    public function __invoke(Request $request)
    {
        $connectionsData = $this->getConnections($request);

        return Inertia::render('Follower/List', [
            'user' => Auth::user(),
            'connections' => $connectionsData,
        ]);
    }

    public function listAction(Request $request): JsonResponse
    {
        $connectionsData = $this->getConnections($request);
        $connection = $connectionsData['list']->get($connectionsData['selected']);

        if (empty($connection)) {
            return response()->json([], Response::HTTP_ACCEPTED);
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
