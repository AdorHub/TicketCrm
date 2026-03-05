<?php

namespace App\Services\Api;

use App\Repositories\Api\TicketRepository;



class TicketService
{
	/**
	 * Create a new service instance.
	 *
	 * @param TicketRepository $repo Repository for ticket data operations
	 */
    public function __construct(private TicketRepository $repo)
    {
        //
    }

	/**
	 * Store a new ticket with optional attachments.
	 *
	 * @param array $data Ticket data including possible 'attachments' key with file objects
	 * 
	 * @return void
	 */
	public function store(array $data): void
	{
		$ticket = $this->repo->createTicket($data);
		if ($data['attachments'] ?? false) {
			foreach ($data['attachments'] as $file) {
				$mimeType = $file->getMimeType();
				$collection = match (true) {
					str_starts_with($mimeType, 'image/') => 'images',
					str_starts_with($mimeType, 'audio/') => 'audios',
					str_starts_with($mimeType, 'video/') => 'videos',
					default => 'documents'
				};
				$ticket->addMedia($file)->toMediaCollection($collection);
			}
		}
	}
}
