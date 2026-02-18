<?php

namespace App\Repositories\Auth;

use App\Models\User;

class RegisterRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(private User $model)
	{
		//
	}

	public function create(array $data): User
	{
		return $this->model->create($data);
	}
}
