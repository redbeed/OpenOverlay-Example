<?php

namespace App\Http\Controllers\Bot\ChatCommand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bot\ChatCommand\AddRequest;
use App\Models\Bot\ChatCommand;
use Illuminate\Support\Facades\Artisan;
use Inertia\Inertia;
use Redbeed\OpenOverlay\Console\Commands\ChatBot\RestartServerCommand;

class AddController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Bot/ChatCommand/Add');
    }

    public function postAction(AddRequest $request)
    {
        $request->validated();

        ChatCommand::create([
            'command'  => $request->get('command'),
            'response' => $request->get('response'),
        ]);

        // Restart Bot
        Artisan::call(RestartServerCommand::class);

        return redirect()->route('bot.chat-command');
    }
}
