<?php

use App\Http\Controllers\Automations\Action\CreateActionController as AutomationsCreateActionController;
use App\Http\Controllers\Automations\Action\EditActionController as AutomationsEditActionController;
use App\Http\Controllers\Automations\CreateController as AutomationsCreateController;
use App\Http\Controllers\Automations\EditController as AutomationsEditController;
use App\Http\Controllers\Automations\Filter\CreateFilterController as AutomationsCreateFilterController;
use App\Http\Controllers\Automations\Filter\EditFilterController as AutomationsEditFilterController;
use App\Http\Controllers\Automations\ListController as AutomationsListController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OverlayExampleController;
use App\Http\Controllers\ViewerList\FollowerController;
use App\Http\Controllers\ViewerList\SubscriberController;
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

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', DashboardController::class)
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('automations')->group(function () {
        Route::get('/')
            ->uses(AutomationsListController::class)
            ->name('automations');

        Route::post('/store')
            ->uses([AutomationsCreateController::class, 'store'])
            ->name('automations.store');

        Route::get('/{automation}')
            ->uses(AutomationsEditController::class)
            ->name('automations.edit');

        Route::post('/{automation}')
            ->uses([AutomationsEditController::class, 'update'])
            ->name('automations.update');

        Route::prefix('/{automation}/filter')->group(function () {
            Route::post('/create')
                ->uses(AutomationsCreateFilterController::class)
                ->name('automations.filters.create');

            Route::get('/{filter}')
                ->uses(AutomationsEditFilterController::class)
                ->name('automations.filters.edit');

            Route::post('/{filter}')
                ->uses([AutomationsEditFilterController::class, 'update'])
                ->name('automations.filters.update');
        });

        Route::prefix('/{automation}/action')->group(function () {
            Route::post('/create')
                ->uses(AutomationsCreateActionController::class)
                ->name('automations.actions.create');

            Route::get('/{action}')
                ->uses(AutomationsEditActionController::class)
                ->name('automations.actions.edit');

            Route::post('/{action}')
                ->uses([AutomationsEditActionController::class, 'update'])
                ->name('automations.actions.update');
        });
    });

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
