<?php

namespace App\Services\Admin;

use App\Models\Ticket;
use App\Repositories\Admin\TicketRepository;

class TicketService
{
	/**
	 * Create a new service instance.
	 *
	 * @param TicketRepository $repo Repository for accessing ticket data
	 */
    public function __construct(private TicketRepository $repo)
    {
        //
    }

	/**
	 * Retrieve all media files associated with a ticket, grouped by type.
	 *
	 * Fetches media from the ticket for the following collections:
	 * - images
	 * - videos
	 * - audios
	 * - documents
	 *
	 * @param Ticket $ticket The ticket model instance
	 * @return array Associative array with keys: 'images', 'videos', 'audios', 'documents'
	 */
	public function getFiles(Ticket $ticket): array
	{
		$images = $ticket->getMedia('images');
		$videos = $ticket->getMedia('videos');
		$audios = $ticket->getMedia('audios');
		$documents = $ticket->getMedia('documents');
		return compact('images', 'videos', 'audios', 'documents');
	}

	/**
	 * Get filtered ticket data with applied filters.
	 *
	 * Cleans the input filters (removes null and empty values) and retrieves
	 * filtered tickets from the repository. Returns both the data and the cleaned filters.
	 *
	 * @param array $filters Input filters (may contain null/empty values)
	 * @return array Associative array with:
	 *              - 'data': filtered ticket collection from repository
	 *              - 'filters': cleaned filter array (without null/empty values)
	 */
	public function getFilteredData(array $filters): array
	{
		$cleanFilters = array_filter($filters, fn($value) => $value !== null && $value !== '');
		$data = $this->repo->getFiltered($cleanFilters);
		return [
			'data' => $data,
			'filters' => $cleanFilters
		];
	}

	/**
	 * Update the status of a ticket.
	 *
	 * @param Ticket $ticket The ticket model instance to update
	 * @param string $status New status value ('new'/'processing'/'processed')
	 * @return void
	 */
	public function updateStatus(Ticket $ticket, string $status): void
	{
		$this->repo->updateStatus($ticket, $status);
	}
}
