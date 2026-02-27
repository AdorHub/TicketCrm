<?php

namespace App\Repositories\Admin;

use App\Models\Ticket;

class TicketRepository
{
	public function getFiltered(array $filters)
	{
		return Ticket::with('customer')
			->ticketFilter($filters)
			->latest()
			->paginate(20)
			->withQueryString();
	}

	public function updateStatus(Ticket $ticket, string $status)
	{
		$ticket->status = $status;
		$ticket->save();
	}
}
