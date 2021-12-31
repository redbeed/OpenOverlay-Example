<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewerList\FollowerController;
use App\Http\Controllers\ViewerList\SubscriberController;
use App\Http\Controllers\OverlayExampleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', DashboardController::class)
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('bots')->group(function () {
        Route::get('/')
            ->uses(BotController::class)
            ->name('bots');

        Route::get('add-to-chat/{botId}')
            ->uses([BotController::class, 'addBotToChat'])
            ->name('bots.add-to-chat');

        Route::get('remove-from-chat/{botId}')
            ->uses([BotController::class, 'removeBotFromChat'])
            ->name('bots.remove-from-chat');
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
