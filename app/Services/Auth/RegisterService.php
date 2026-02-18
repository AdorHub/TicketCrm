<?php

namespace App\Services\Auth;

use App\Repositories\Auth\RegisterRepository;

class RegisterService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private RegisterRepository $repo)
    {
        //
    }

	public function register(array $data)
	{
		$this->repo->create($data);
	}
}
