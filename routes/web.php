<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/register');

Route::group(['prefix' => 'admin'], function () {

	Route::middleware('guest')->group(function () {
		Route::view('/register', 'admin/auth/register')->name('register.index');
		Route::post('/register', RegisterController::class)->name('register.store');
		Route::view('/login', 'admin/auth/login')->name('login.index');
		Route::post('/login', LoginController::class)->name('login.store');
	});
	
});
