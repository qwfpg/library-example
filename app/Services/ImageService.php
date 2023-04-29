<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService implements ImageServiceInterface
{
    public function saveImage(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, 'public');
    }

    public function deleteImage($path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
