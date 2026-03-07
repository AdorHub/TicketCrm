<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\TicketStatsService;
use Illuminate\Http\JsonResponse;

class TicketStatsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param TicketStatsService $service Service for ticket statistics management
	 */
	public function __construct(private TicketStatsService $service)
	{
		//
	}

	/**
	 * Handle the request to retrieve statistics.
	 *
	 * @return JsonResponse Statistics data with success message
	 */
    public function __invoke(): JsonResponse
    {
        $stats = $this->service->getStatistics();
		return response()->json([
			'message' => 'Статистика получена успешно',
			'stats' => $stats
		]);
    }
}
