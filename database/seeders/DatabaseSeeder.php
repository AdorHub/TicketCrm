<?php

namespace Database\Seeders;

use Database\Seeders\CustomerSeeder;
use Database\Seeders\TicketSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		$this->call([
			UserSeeder::class,
			CustomerSeeder::class,
			TicketSeeder::class
		]);
    }
}
