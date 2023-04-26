<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

interface ImageServiceInterface
{
    public function saveImage(UploadedFile $file, string $folder): string;

    public function deleteImage(string $path);
}
