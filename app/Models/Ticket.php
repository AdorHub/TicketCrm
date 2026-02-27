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
		'response_data',
		'customer_id'
	];

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('images')
			->acceptsMimeTypes([
				'image/jpeg',
				'image/jpg',
				'image/png',
				'image/gif',
				'image/webp'
			])
			->useDisk('public');

		$this->addMediaCollection('audios')
			->acceptsMimeTypes([
				'audio/mpeg',
				'audio/wav',
				'audio/ogg',
				'audio/mp3'
			])
			->useDisk('public');

		$this->addMediaCollection('videos')
			->acceptsMimeTypes([
				'video/mp4',
				'video/quicktime',
				'video/x-msvideo'
			])
			->useDisk('public');

		$this->addMediaCollection('documents')
			->acceptsMimeTypes([
				'application/pdf',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'text/plain'
			])
			->useDisk('public');
	}

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class);
	}

	public function scopeTicketFilter($query, array $filters)
	{
		if (!empty($filters['from_date'])) {
			$query->whereDate('created_at', '>=', $filters['from_date']);
		}
		if (!empty($filters['to_date'])) {
			$query->whereDate('created_at', '<=', $filters['to_date']);
		}
		if (!empty($filters['status']) && $filters['status'] !== 'all') {
			$query->where('status', '=', $filters['status']);
		}
		if (!empty($filters['email'])) {
			$query->whereHas('customer', function ($q) use ($filters) {
				$q->where('email', 'like', '%' . $filters['email'] . '%');
			});
		}
		if (!empty($filters['phone'])) {
			$query->whereHas('customer', function ($q) use ($filters) {
				$q->where('phone', 'like', '%' . $filters['phone'] . '%');
			});
		}
	}
}
