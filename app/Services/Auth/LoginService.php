<?php

namespace App\Services\Auth;

use App\Repositories\Auth\LoginRepository;

class LoginService
{
	/**
	 * Create a new service instance.
	 *
	 * @param LoginRepository $repo Repository for handling login-related data operations
	 */
    public function __construct(private LoginRepository $repo)
    {
        //
    }

	/**
	 * Authenticate a user using provided credentials.
	 *
	 * @param array $data User credentials for login (email, password).
	 * @return void
	 */
	public function login(array $data): void
	{
		$this->repo->attemptLogin($data);
	}
}
