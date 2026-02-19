<?php

namespace App\Services\Auth;

use App\Repositories\Auth\LoginRepository;

class LoginService
{
	/**
	 * Assigns the repository for data operations.
	 */
    public function __construct(private LoginRepository $repo)
    {
        //
    }

	/**
	 * Passing request to the repository layer
	 */
	public function login(array $data)
	{
		$this->repo->attemptLogin($data);
	}
}
