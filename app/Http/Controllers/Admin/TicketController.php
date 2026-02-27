<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FiltersRequest;
use App\Models\Ticket;
use App\Services\Admin\TicketService;

class TicketController extends Controller
{
	public function __construct(private TicketService $service)
	{
		//
	}

    public function index(FiltersRequest $request)
	{
		$request->validated();
		$filters = $request->only(['from_date', 'to_date', 'status', 'email', 'phone']);
		$data = $this->service->getFilteredData($filters);
		return view('admin.panel.tickets.index', [
			'tickets' => $data,
			'filters' => $filters
		]);
	}

	public function show(Ticket $ticket)
	{
		$files = $this->service->getFiles($ticket);
		return view('admin.panel.tickets.show', [
			'ticket' => $ticket,
			'files' => $files
		]);
	}

	public function updateStatus(FiltersRequest $request, Ticket $ticket)
	{
		$request->validated();
		$this->service->updateStatus($ticket, $request->input('status'));
		return back()->with('success', 'Статус обновлён успешно');
	}
}
