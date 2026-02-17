<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'customer_id' => Customer::all()->random()->id,
            'subject' => $this->faker->sentence,
			'text' => $this->faker->text,
			'status' => $this->faker->randomElement(['new', 'processing', 'processed']),
			'response_date' => $this->faker->boolean
				? now()
					->subDays(rand(1, 31))
					->subHours(rand(0, 23))
					->subMinutes(rand(0, 59))
					->subSeconds(rand(0, 59))			
				: null
        ];
    }
}
