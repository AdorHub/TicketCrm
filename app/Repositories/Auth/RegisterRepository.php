<?php

namespace App\Repositories\Auth;

use App\Models\User;

class RegisterRepository
{
    /**
     * Create a new repository instance.
	 * @param User $model User model instance for database operations
     */
    public function __construct(private User $model)
	{
		//
	}

	/**
	 * Create a new user in the database.
	 *
	 * @param array $data User data for creation (name, email, password)
	 * 
	 * @return User The newly created user model instance
	 */
	public function create(array $data): User
	{
		return $this->model->create($data);
	}
}
