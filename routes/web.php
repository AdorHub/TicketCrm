<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/admin/register', 'admin/auth/register')->name('register.index');
Route::post('/admin/register', RegisterController::class)->name('register.store');