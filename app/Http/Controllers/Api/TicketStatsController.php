<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\TicketStatsService;
use Illuminate\Http\JsonResponse;

class TicketStatsController extends Controller
{
	/**
	 * Create a new class instance.
	 */
	public function __construct(private TicketStatsService $service)
	{
		//
	}

    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        $stats = $this->service->getStatistics();
		return response()->json([
			'message' => 'Success on getting statistics',
			'stats' => $stats
		]);
    }
}
