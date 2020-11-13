<?php

use App\Code\V1\Messages\Controllers\MessagesController;

Route::middleware('auth:sanctum')->prefix('v1')->group( function () {
    Route::prefix('messages')->group( function () {
        Route::post('send', [MessagesController::class, 'send'])->name('v1.messages.send');
        Route::post('search', [MessagesController::class, 'search'])->name('v1.messages.search');
    });
});
