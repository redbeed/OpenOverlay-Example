<?php

namespace App\Http\Controllers\ViewerList;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

class ViewerListController
{
    #[ArrayShape(['list' => "\Illuminate\Support\Collection", 'selected' => "mixed|null"])]
    protected function getConnections(Request $request): array
    {

        /** @var User $user */
        $user = Auth::user();
        $connections = collect($user->connections)
            ->keyBy('id');

        $connectionId = $request->get('connection') ?? $connections->keys()->first();

        if ($connections->count() > 0 && !$connections->get($connectionId)) {
            $connectionId = null;
        }

        return [
            'list' => $connections,
            'selected' => $connectionId
        ];
    }
}
