<?php

use App\Http\Controllers\Bot\ChatCommand\AddController as BotChatCommandAddController;
use App\Http\Controllers\Bot\ChatCommand\ListController as BotChatCommandListController;
use App\Http\Controllers\Bot\ChatCommand\DeleteController as BotChatCommandDeleteController;
use App\Http\Controllers\Bot\ChatCommand\EditController as BotChatCommandEditController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewerList\FollowerController;
use App\Http\Controllers\ViewerList\SubscriberController;
use App\Http\Controllers\OverlayExampleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', DashboardController::class)
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('bot')->group(function () {
        Route::get('/')
            ->uses(BotController::class)
            ->name('bots');

        Route::get('add-to-chat/{botId}')
            ->uses([BotController::class, 'addBotToChat'])
            ->name('bots.add-to-chat');

        Route::get('remove-from-chat/{botId}')
            ->uses([BotController::class, 'removeBotFromChat'])
            ->name('bots.remove-from-chat');


        Route::prefix('chat-command')->group(function () {
            Route::get('/')
                ->uses(BotChatCommandListController::class)
                ->name('bot.chat-command');

            Route::get('/add')
                ->uses(BotChatCommandAddController::class)
                ->name('bot.chat-command.add');

            Route::post('/add')
                ->uses([BotChatCommandAddController::class, 'postAction'])
                ->name('bot.chat-command.add.post');

            Route::get('/edit/{commandId}')
                ->uses(BotChatCommandEditController::class)
                ->name('bot.chat-command.edit');

            Route::post('/edit/{commandId}')
                ->uses([BotChatCommandEditController::class, 'saveAction'])
                ->name('bot.chat-command.edit.post');

            Route::get('/delete/{commandId}')
                ->uses(BotChatCommandDeleteController::class)
                ->name('bot.chat-command.delete');
        });
    });

    Route::prefix('followers')->group(function () {
        Route::get('/')
            ->uses(FollowerController::class)
            ->name('followers');

        Route::get('/list')
            ->uses([FollowerController::class, 'listAction'])
            ->name('followers.list');
    });

    Route::prefix('subscribers')->group(function () {
        Route::get('/')
            ->uses(SubscriberController::class)
            ->name('subscribers');

        Route::get('/list')
            ->uses([SubscriberController::class, 'listAction'])
            ->name('subscribers.list');
    });

});

Route::get('overlay/{twitchUserId}')->uses(OverlayExampleController::class)
    ->name('overlay.example');
