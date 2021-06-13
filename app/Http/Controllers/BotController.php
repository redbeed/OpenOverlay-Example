<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Redbeed\OpenOverlay\Models\BotConnection;

class BotController extends Controller
{
    public function __invoke()
    {
        /** @var User $user */
        $user = Auth::user();

        $userConnectedBots = $user->bots->pluck('id');
        $availableBots = BotConnection::all();

        return Inertia::render('Bots/List', [
            'availableBots' => $availableBots,
            'userConnectedBots' => $userConnectedBots
        ]);
    }

    private function checkBot(int $botId): BotConnection
    {
        $bot = BotConnection::find($botId);

        if (!$bot) {
            abort(404, 'Bot not found');
        }

        return $bot;
    }

    public function addBotToChat(int $botId): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $bot = $this->checkBot($botId);

        if ($user->bots->contains($bot)) {
            return redirect()->route('bots')
                ->with('message', 'Bot is already in your chat');
        }

        $user->bots()->attach($bot);

        return redirect()->route('bots')
            ->with('message', 'Please restart your Bot Sail Container');
    }

    public function removeBotFromChat(int $botId): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $bot = $this->checkBot($botId);

        if (!$user->bots->contains($bot)) {
            return redirect()->route('bots')
                ->with('message', 'Bot is not in your chat');
        }

        $user->bots()->wherePivot('bot_id', $bot->id)->detach();

        return redirect()->route('bots')
            ->with('message', 'Please restart your Bot Sail Container');
    }
}
