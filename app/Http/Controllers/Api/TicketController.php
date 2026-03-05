<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketRequest;
use App\Services\Api\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param TicketService $service Service for ticket management
	 */
	public function __construct(private TicketService $service)
	{
		//
	}

	/**
	 * Create a new ticket based on validated data.
	 *
	 * @param StoreTicketRequest $request Validated request with ticket data
	 * @return JsonResponse Success response with confirmation message
	 */
	public function __invoke(StoreTicketRequest $request): JsonResponse
    {
		$data = $request->validated();
        $this->service->store($data);
		return response()->json([
			'message' => 'Заявка создана успешно'
		]);
    }
}
