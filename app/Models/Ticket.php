<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

	public function scopeTicketFilter(Builder $query, array $filters): Builder
	{
		if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
			$query->createdBetween($filters['from_date'], $filters['to_date']);
		} else if (!empty($filters['from_date'])) {
			$query->whereDate('created_at', '>=', Carbon::parse($filters['from_date'])->startOfDay());
		} else if (!empty($filters['to_date'])) {
			$query->whereDate('created_at', '<=', Carbon::parse($filters['to_date'])->endOfDay());
		}

		if (!empty($filters['status']) && $filters['status'] !== 'all') {
			$query->status($filters['status']);
		}

		if (!empty($filters['email']) || !empty($filters['phone'])) {
			$query->whereHas('customer', function ($q) use ($filters) {
				if (!empty($filters['email'])) {
					$q->where('email', 'like', '%' . $filters['email'] . '%');
				}
				if (!empty($filters['phone'])) {
					$q->where('phone', 'like', '%' . $filters['phone'] . '%');
				}				
			});
		}
		
		return $query;
	}

	public function scopeCreatedBetween(Builder $query, string|Carbon $from, string|Carbon $to): Builder
	{
		return $query->whereBetween('created_at', [
			Carbon::parse($from)->startOfDay(),
			Carbon::parse($to)->endOfDay()
		]);
	}

	public function scopeStatus(Builder $query, string $status)
	{
		return $query->where('status', $status);
	}
}
