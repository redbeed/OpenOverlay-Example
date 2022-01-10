<?php

namespace App\Http\Controllers\Bot\ChatCommand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bot\ChatCommand\EditRequest;
use App\Models\Bot\ChatCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Inertia\Response;
use Inertia\ResponseFactory;
use Redbeed\OpenOverlay\Console\Commands\ChatBot\RestartServerCommand;

class EditController extends Controller
{
    public function __invoke(int $commandId): Response|ResponseFactory
    {
        $command = ChatCommand::find($commandId);

        if (empty($command)) {
            abort(404);
        }

        return inertia('Bot/ChatCommand/Edit', [
            'command' => $command,
        ]);
    }

    public function saveAction(EditRequest $request, int $commandId): RedirectResponse
    {
        $request->validated();

        $command = ChatCommand::find($commandId);

        if (empty($command)) {
            abort(404);
        }

        $command->command = $request->get('command');
        $command->response = $request->get('response');
        $command->save();
        
        // Restart Bot
        Artisan::call(RestartServerCommand::class);

        return redirect()->route('bot.chat-command');
    }
}
