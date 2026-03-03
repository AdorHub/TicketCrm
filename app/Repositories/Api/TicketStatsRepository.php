<?php

namespace App\Repositories\Api;

use App\Models\Ticket;

class TicketStatsRepository
{
	public function getCountInPeriod($from_data, $to_date): int
	{
		return Ticket::createdBetween($from_data, $to_date)->count();
	}

	public function getTotalCount(): int
	{
		return Ticket::count();
	}
}
