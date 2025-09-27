<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait ImageTrait
{
    /**
     * Upload an image.
     *
     * @param UploadedFile $image
     * @param string $folder
     * @return string|null
     */
    public function uploadImage(UploadedFile $image, string $folder): ?string
    {
        try {
            // Use storage path instead of public path for better security
            $directory = storage_path("app/public/{$folder}");

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $fileName);
            
            // Return relative path for database storage
            return "{$folder}/{$fileName}";

        } catch (\Exception $e) {
            report($e);
            return null; // Return null instead of empty array
        }
    }

    /**
     * Upload multiple images.
     */
    public function uploadImages(array $images, string $folder): array
    {
        $uploadedImages = [];
        foreach ($images as $image) {
            $result = $this->uploadImage($image, $folder);
            if ($result) {
                $uploadedImages[] = $result;
            }
        }
        return $uploadedImages;
    }

    /**
     * Delete an image.
     */
    public function deleteImage(array|string|null $paths): bool
    {
        if (empty($paths)) {
            return false;
        }

        if (!is_array($paths)) {
            $paths = [$paths];
        }

        $deleted = true;

        foreach ($paths as $path) {
            if (empty($path) || str_contains($path, 'default.png')) {
                continue;
            }

            // Use storage path
            $fullPath = storage_path("app/public/{$path}");
            if (file_exists($fullPath) && is_file($fullPath)) {
                $deleted = unlink($fullPath) && $deleted;
            }
        }

        return $deleted;
    }

    /**
     * Delete multiple images.
     */
    public function deleteImages(array $paths): bool
    {
        $deleted = true;
        foreach ($paths as $path) {
            $deleted = $this->deleteImage($path) && $deleted;
        }
        return $deleted;
    }
}