<?php

use App\Code\V1\Messages\Controllers\MessagesController;
use App\Routes\ApiRoute;

Route::middleware('auth:sanctum')->prefix('v1')->group( function () {
    Route::prefix('messages')->group( function () {
        Route::post('send', [MessagesController::class, 'send'])->name(ApiRoute::name('messages.send', 1));
        Route::post('search', [MessagesController::class, 'search'])->name(ApiRoute::name('messages.search', 1));
        Route::delete('delete/all-by-user', [MessagesController::class, 'deleteByUser'])->name(ApiRoute::name('messages.delete.all-by-user', 1));
    });
});
