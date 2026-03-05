<?php

namespace App\Services\Auth;

use App\Repositories\Auth\RegisterRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterService
{
	/**
	 * Create a new service instance.
	 *
	 * @param RegisterRepository $repo Repository for handling user registration data operations
	 */
    public function __construct(private RegisterRepository $repo)
    {
        //
    }

	/**
	 * Register a new user and assign default role.
	 *
	 * @param array $data User registration data (name, email, password).
	 * 
	 * @return void
	 */
	public function register(array $data): void
	{
		$user = $this->repo->create($data);
		$role = Role::firstOrCreate(['name' => 'Manager']);
		$user->assignRole($role);
	}
}
