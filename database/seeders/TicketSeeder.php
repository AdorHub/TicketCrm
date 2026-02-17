<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
	use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory(60)->create();
    }
}
