<?php

namespace App\Repositories\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginRepository
{
	/**
	 * Attempt to authenticate a user with provided credentials.
	 *
	 * @param array $data User credentials for login (email, password) 
	 * @return void
	 */
	public function attemptLogin(array $data): void
	{
		if (!Auth::attempt($data)) {
			throw new AuthenticationException('Неверные учётные данные');
		}
	}
}
