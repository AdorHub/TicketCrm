<?php

namespace App\Repositories\Api;

use App\Models\Customer;
use App\Models\Ticket;

class TicketRepository
{
	public function createTicket(array $data): Ticket
	{
		$customer = Customer::firstOrCreate([
			'email' => $data['email']
		], [
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone']
		]);

		return Ticket::create([
			'customer_id' => $customer->id,
			'subject' => $data['subject'],
			'text' => $data['text']
		]);
	}
}
