<?php

namespace App\Services\Auth;

use App\Repositories\Auth\RegisterRepository;
use Spatie\Permission\Models\Role;

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
		$user = $this->repo->create($data);
		$role = Role::firstOrCreate(['name' => 'Manager']);
		$user->assignRole($role);
	}
}
