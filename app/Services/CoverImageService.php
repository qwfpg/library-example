<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class CoverImageService implements CoverImageServiceInterface
{
    public function handleImageStore(FormRequest $request, string $imageFieldName, string $folder): ?string
    {
        if ($request->hasFile($imageFieldName)) {
            $image = $request->file($imageFieldName);
            return $this->saveImage($image, $folder);
        }

        return null;
    }

    public function handleImageUpdate(
        FormRequest $request,
        ?string      $oldImagePath,
        string      $imageFieldName,
        string      $folder): ?string
    {
        if ($request->hasFile($imageFieldName)) {
            if ($oldImagePath) {
                $this->deleteImage($oldImagePath);
            }
            $image = $request->file($imageFieldName);
            return $this->saveImage($image, $folder);
        }

        return $oldImagePath;
    }

    public function handleImageDelete(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }
        $this->deleteImage($imagePath);
    }

    private function saveImage(UploadedFile $image, string $folder): string
    {
        $filename = time() . '-' . $image->getClientOriginalName();
        return Storage::disk('public')->putFileAs($folder, $image, $filename);
    }

    private function deleteImage(string $imagePath): void
    {
        Storage::disk('public')->delete($imagePath);
    }
}
