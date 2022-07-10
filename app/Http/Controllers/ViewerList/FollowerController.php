<?php

namespace App\Http\Controllers\ViewerList;

use Illuminate\Http\Request;
use Redbeed\OpenOverlay\Models\Twitch\UserFollowers;
use Symfony\Component\HttpFoundation\Response;

class FollowerController extends ViewerListController
{
    protected string $listTemplate = 'Follower/List';

    public function listUsers(Request $request)
    {
        $connectionsData = $this->getConnections($request);
        $connection = $connectionsData['list']->get($connectionsData['selected']);

        if (empty($connection)) {
            return response()->json([], Response::HTTP_ACCEPTED);
        }

        $perPage = $request->get('per_page', 50);
        $query = $request->get('query');

        $sort = $request->get('sort_by', 'follower_username');
        $sortDirection = $request->get('sort_order', 'asc');

        $followersQuery = UserFollowers::where('twitch_user_id', $connection->service_user_id)
            ->orderBy($sort, $sortDirection);

        if ($query) {
            $followersQuery = $followersQuery->where('follower_username', 'LIKE', '%'.$query.'%');
        }

        return $followersQuery->paginate($perPage);
    }
}
