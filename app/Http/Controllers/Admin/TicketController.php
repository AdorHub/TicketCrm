<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FiltersRequest;
use App\Models\Ticket;
use App\Services\Admin\TicketService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TicketController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param TicketService $service Service for ticket management in admin panel
	 */
	public function __construct(private TicketService $service)
	{
		//
	}

	/**
	 * Display a filtered list of tickets.
	 *
	 * Applies filters from the request (date range, status, contact info)
	 * and returns the admin view with filtered tickets and applied filters.
	 *
	 * @param FiltersRequest $request Validated request with filter parameters
	 * @return View View with filtered tickets and filter data
	 */
    public function index(FiltersRequest $request): View
	{
		$request->validated();
		$filters = $request->only(['from_date', 'to_date', 'status', 'email', 'phone']);
		$result = $this->service->getFilteredData($filters);
		return view('admin.panel.tickets.index', [
			'tickets' => $result['data'],
			'filters' => $result['filters']
		]);
	}

	/**
	 * Show details of a specific ticket.
	 *
	 * @param Ticket $ticket The ticket model instance to display
	 * @return \Illuminate\Contracts\View\View View with ticket details and attached files
	 */
	public function show(Ticket $ticket): View
	{
		$files = $this->service->getFiles($ticket);
		return view('admin.panel.tickets.show', [
			'ticket' => $ticket,
			'files' => $files
		]);
	}

	/**
	 * Update the status of a ticket.
	 *
	 * @param FiltersRequest $request Validated request containing the new status
	 * @param Ticket $ticket The ticket model instance to update
	 * @return \Illuminate\Http\RedirectResponse Redirect back with success message
	 */
	public function updateStatus(FiltersRequest $request, Ticket $ticket): RedirectResponse
	{
		$request->validated();
		$this->service->updateStatus($ticket, $request->input('status'));
		return back()->with('success', 'Статус обновлён успешно');
	}
}
