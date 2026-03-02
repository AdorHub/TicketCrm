<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

Route::middleware('api')->group(function () {
	Route::post('/tickets', TicketController::class)->name('api.ticket.create')->middleware('throttle:once-per-day');
});
