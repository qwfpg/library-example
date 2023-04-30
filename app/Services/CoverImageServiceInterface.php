<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

interface CoverImageServiceInterface
{
    public function handleImageStore(FormRequest $request, string $imageFieldName, string $folder): ?string;

    public function handleImageUpdate(FormRequest $request, ?string $oldImagePath, string $imageFieldName, string $folder): ?string;

    public function handleImageDelete(?string $imagePath);
}
