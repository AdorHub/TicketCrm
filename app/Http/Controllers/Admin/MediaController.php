<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
	/**
	 * Display the specified media file.
	 *
	 * @param Media $media The media model instance
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\Response HTTP response with the file or 404
	 */
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

	/**
	 * Download the specified media file.
	 *
	 * @param Media $media The media model instance
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse HTTP response forcing file download
	 */
	public function download(Media $media)
	{
		return response()->download($media->getPath(), $media->file_name);
	}
}
