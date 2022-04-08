<?php

namespace App\Http\Controllers\ViewerList;

use Illuminate\Http\Request;
use Redbeed\OpenOverlay\Models\Twitch\UserSubscriber;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends ViewerListController
{
   protected string $listTemplate = 'Subscriber/List';

    public function listUsers(Request $request)
    {
        $connectionsData = $this->getConnections($request);
        $connection = $connectionsData['list']->get($connectionsData['selected']);

        if (empty($connection)) {
            return response()->json([], Response::HTTP_ACCEPTED);
        }

        $perPage = $request->get('per_page', 50);
        $query = $request->get('query');

        $sort = $request->get('sort_by', 'subscriber_username');
        $sortDirection = $request->get('sort_order', 'asc');

        $followersQuery = UserSubscriber::where('twitch_user_id', $connection->service_user_id)
            ->orderBy($sort, $sortDirection);

        if($query) {
            $followersQuery = $followersQuery->where('subscriber_username', 'LIKE', '%'.$query.'%');
        }

        return response()->json($followersQuery->paginate($perPage));
    }
}
