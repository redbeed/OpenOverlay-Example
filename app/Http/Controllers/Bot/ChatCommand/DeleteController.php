<?php

namespace App\Http\Controllers\Bot\ChatCommand;

use App\Http\Controllers\Controller;
use App\Models\Bot\ChatCommand;
use Illuminate\Support\Facades\Artisan;
use Redbeed\OpenOverlay\Console\Commands\ChatBot\RestartServerCommand;

class DeleteController extends Controller
{
    public function __invoke(int $commandId)
    {
        $command = ChatCommand::find($commandId);

        if (empty($command)) {
            abort(404);
        }

        $command->delete();

        // Restart Bot
        Artisan::call(RestartServerCommand::class);

        return redirect()->route('bot.chat-command');
    }
}
