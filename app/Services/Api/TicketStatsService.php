<?php

namespace App\Services\Api;

use App\Repositories\Api\TicketStatsRepository;
use Carbon\Carbon;

class TicketStatsService
{
	/**
	 * Create a new service instance.
	 *
	 * @param TicketStatsRepository $repo Repository for ticket statistics data
	 */
    public function __construct(private TicketStatsRepository $repo)
    {
        //
    }

	/**
	 * Retrieve ticket statistics for various time periods (today, yesterday, current week, current month, total count).
	 *
	 * @return array Associative array with statistics
	 *
	 */
	public function getStatistics(): array
	{
		$now = Carbon::now();
		return [
			'today' => $this->repo->getCountInPeriod($now, $now),
			'yesterday' => $this->repo->getCountInPeriod($now->copy()->subDay(), $now->copy()->subDay()),
			'this_week' => $this->repo->getCountInPeriod($now->copy()->startOfWeek(), $now->copy()->endOfWeek()),
			'this_month' => $this->repo->getCountInPeriod($now->copy()->startOfMonth(), $now->copy()->endOfMonth()),
			'total' => $this->repo->getTotalCount()
		];
	}
}
