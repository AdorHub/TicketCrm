<?php

use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\TicketStatsController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
	Route::post('/tickets', TicketController::class)->name('api.ticket.create')->middleware('throttle:once-per-day');
	Route::get('/tickets/statistics', TicketStatsController::class)->name('api.ticket.statistics');
});
