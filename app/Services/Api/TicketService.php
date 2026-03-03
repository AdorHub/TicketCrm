<?php

namespace App\Services\Api;

use App\Repositories\Api\TicketRepository;



class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TicketRepository $repo)
    {
        //
    }

	public function store(array $data)
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
