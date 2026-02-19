<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginRepository
{
	/**
	 * Receives the model for interacting with the database.
	 */
    public function __construct(private User $user)
    {
        //
    }

	/**
	 * Handles authentication process by validating provided credentials.
	 */
	public function attemptLogin(array $data)
	{
		if (!Auth::attempt($data)) {
			throw new AuthenticationException('Неверные учётные данные');
		}
	}
}
