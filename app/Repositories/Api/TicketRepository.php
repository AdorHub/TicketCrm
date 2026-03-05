<?php

namespace App\Repositories\Api;

use App\Models\Customer;
use App\Models\Ticket;

class TicketRepository
{
	/**
	 * Create a new ticket with associated customer.
	 *
	 * Finds or creates a customer by email (ensures customer exists in the system)
	 * Creates a new ticket linked to the customer
	 *
	 * @param array $data Ticket and customer data (name, email, phone, subject, text):
	 * 
	 * @return Ticket The newly created ticket instance with assigned customer_id
	 */
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
