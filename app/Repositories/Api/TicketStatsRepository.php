<?php

namespace App\Repositories\Api;

use App\Models\Ticket;

class TicketStatsRepository
{
	/**
	 * Get the number of tickets created within a specific date period.
	 *
	 * @param \DateTimeInterface|string $from_date Start date of the period
	 * @param \DateTimeInterface|string $to_date End date of the period
	 * 
	 * @return int Number of tickets created between the specified dates
	 */
	public function getCountInPeriod($from_data, $to_date): int
	{
		return Ticket::createdBetween($from_data, $to_date)->count();
	}

	/**
	 * Get the total number of tickets in the system.
	 *
	 * @return int Total number of tickets stored in the database
	 */
	public function getTotalCount(): int
	{
		return Ticket::count();
	}
}
