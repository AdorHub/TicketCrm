<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
	use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managePermission = Permission::firstOrCreate(['name' => 'edit']);
		
		$managerRole = Role::firstOrCreate(['name' => 'Manager']);
		$adminRole = Role::firstOrCreate(['name' => 'Admin']);

		$managerRole->givePermissionTo($managePermission);

		$manager = User::factory()->create([
			'name' => 'Manager',
			'email' => 'manager@mail.ru',
			'password' => '123123123'
		]);
		$manager->assignRole($managerRole);

		$admin = User::factory()->create([
			'name' => 'Admin',
			'email' => 'admin@mail.ru',
			'password' => '123123123'
		]);
		$admin->assignRole($adminRole);
    }
}
