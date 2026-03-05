<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/login');

Route::middleware('web')->group(function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::middleware('guest')->group(function () {
			Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
			Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
			Route::get('/login', [LoginController::class, 'index'])->name('login.index');
			Route::post('/login', [LoginController::class, 'store'])->name('login.store');
		});

		Route::middleware('auth')->group(function () {
			Route::delete('/logout', LogoutController::class)->name('logout');
		});		

		Route::middleware('manager')->group(function () {
			Route::get('/panel', [DashboardController::class, 'index'])->name('panel.dashboard.index');

			Route::controller(TicketController::class)->group(function () {
				Route::get('/panel/tickets', 'index')->name('panel.tickets.index');
				Route::get('/panel/tickets/{ticket}', 'show')->name('panel.tickets.show');
				Route::patch('/panel/ticket/{ticket}', 'updateStatus')->name('panel.tickets.updateStatus');
			});

			Route::controller(MediaController::class)->group(function () {
				Route::get('/view-media/{media}', 'show')->name('media.show');
				Route::get('/download-media/{media}', 'download')->name('media.download');
			});
		});
	});

	Route::view('/widget', 'widget.create-ticket');
	Route::view('/demo-widget', 'widget.demo-widget');

	Route::fallback(function () {
		abort(404);
	});
});

