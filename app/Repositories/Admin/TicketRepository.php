<?php

namespace App\Repositories\Admin;

use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketRepository
{
	/**
	 * Retrieve filtered tickets with pagination.
	 *
	 * @param array $filters Filter criteria for the query (from_date, to_date, status, email, phone)
	 * 
	 * @return \Illuminate\Pagination\LengthAwarePaginator Paginated collection of tickets with customer data, 20 items per page, preserving query string
	 */
	public function getFiltered(array $filters): LengthAwarePaginator
	{
		return Ticket::with('customer')
			->ticketFilter($filters)
			->latest()
			->paginate(20)
			->withQueryString($filters);
	}

	/**
	 * Update the status of a specific ticket.
	 *
	 * @param Ticket $ticket The ticket model instance to update
	 * @param string $status New status value ('new'/'processing'/'processed')
	 * 
	 * @return void
	 */
	public function updateStatus(Ticket $ticket, string $status): void
	{
		$ticket->status = $status;
		$ticket->save();
	}
}
