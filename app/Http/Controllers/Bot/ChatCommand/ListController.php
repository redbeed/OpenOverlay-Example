<?php

namespace App\Http\Controllers\Bot\ChatCommand;

use App\Http\Controllers\Controller;
use App\Models\Bot\ChatCommand;

class ListController extends Controller
{
    public function __invoke()
    {
        $commands = ChatCommand::all();

        return inertia('Bot/ChatCommand/List', [
            'commands' => $commands,
        ]);
    }
}
