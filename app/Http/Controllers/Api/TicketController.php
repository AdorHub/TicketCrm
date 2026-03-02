<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketRequest;
use App\Services\Api\TicketService;

class TicketController extends Controller
{
	public function __construct(private TicketService $service)
	{
		//
	}
	
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreTicketRequest $request)
    {
		$data = $request->validated();
        $this->service->store($data);
		return response()->json([
			'message' => 'Заявка создана успешно'
		]);
    }
}
