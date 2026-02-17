<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory, InteractsWithMedia;

	protected $fillable = [
		'subject',
		'text',
		'status',
		'response_data'
	];

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('images')
				->acceptsMimeTypes(['image/*'])
				->useDisk('public');

		$this->addMediaCollection('audios')
			->acceptsMimeTypes(['audio/*'])
			->useDisk('public');

		$this->addMediaCollection('videos')
			->acceptsMimeTypes(['video/*'])
			->useDisk('public');

		$this->addMediaCollection('documents')
			->acceptsMimeTypes([
				'application/pdf',
				'application/msword',
				'application/vnd.ms-excel',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'text/plain'
			])
			->useDisk('public');
	}

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class);
	}
}
