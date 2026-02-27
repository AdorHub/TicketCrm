<?php

namespace App\Services\Admin;

use App\Models\Ticket;
use App\Repositories\Admin\TicketRepository;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TicketRepository $repo)
    {
        //
    }

	public function getFiles(Ticket $ticket): array
	{
		$images = $ticket->getMedia('images');
		$videos = $ticket->getMedia('videos');
		$audios = $ticket->getMedia('audios');
		$documents = $ticket->getMedia('documents');
		return compact('images', 'videos', 'audios', 'documents');
	}

	public function getFilteredData(array $filters)
	{
		return $this->repo->getFiltered($filters);
	}

	public function updateStatus(Ticket $ticket, string $status)
	{
		$this->repo->updateStatus($ticket, $status);
	}
}
