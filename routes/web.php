<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('bots')
    ->uses(BotController::class)
    ->name('bots');

Route::prefix('followers')->group(function(){
    Route::get('/')
        ->uses(FollowerController::class)
        ->name('followers');

    Route::get('/list')
        ->uses([FollowerController::class, 'listAction'])
        ->name('followers.list');
});

Route::get('bots/add-to-chat/{botId}')
    ->uses([BotController::class, 'addBotToChat'])
    ->name('bots.add-to-chat');

Route::get('bots/remove-from-chat/{botId}')
    ->uses([BotController::class, 'removeBotFromChat'])
    ->name('bots.remove-from-chat');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', DashboardController::class)
    ->name('dashboard');

Route::get('overlay/{twitchUserId}')->uses(OverlayExampleController::class)
    ->name('overlay.example');
