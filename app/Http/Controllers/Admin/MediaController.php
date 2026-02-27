<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function show(Media $media)
	{
		$path = $media->getPath();
		if (file_exists($path)) {
			return response()->file($path, [
				'Content-type' => $media->mime_type
			]);
		}
		abort(404);
	}

	public function download(Media $media)
	{
		return response()->download($media->getPath(), $media->file_name);
	}
}
