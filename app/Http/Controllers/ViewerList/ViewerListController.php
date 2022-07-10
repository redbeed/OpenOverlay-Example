<?php

namespace App\Http\Controllers\ViewerList;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use JetBrains\PhpStorm\ArrayShape;

abstract class ViewerListController
{
    protected string $listTemplate;

    public function __invoke(Request $request)
    {
        $connectionsData = $this->getConnections($request);

        return Inertia::render($this->listTemplate, [
            'connections' => $connectionsData,
            'users'       => $this->listUsers($request),
        ]);
    }

    abstract public function listUsers(Request $request);

    #[ArrayShape(['list' => "\Illuminate\Support\Collection", 'selected' => 'mixed|null'])]
    protected function getConnections(Request $request): array
    {
        /** @var User $user */
        $user = Auth::user();
        $connections = collect($user->connections)
            ->keyBy('id');

        $connectionId = $request->get('connection') ?? $connections->keys()->first();

        if ($connections->count() > 0 && ! $connections->get($connectionId)) {
            $connectionId = null;
        }

        return [
            'list'     => $connections,
            'selected' => $connectionId,
        ];
    }
}
