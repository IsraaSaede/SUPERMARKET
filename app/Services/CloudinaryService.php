<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
        ]);
    }

    public function upload(UploadedFile $file, string $folder = 'products'): string
    {
        $result = $this->cloudinary
            ->uploadApi()
            ->upload(
                $file->getRealPath(),
                [
                    'folder' => 'supermarket/' . $folder,
                    'resource_type' => 'image',
                ]
            );

        return $result['secure_url'];
    }

    public function delete(string $publicId): void
    {
        $this->cloudinary
            ->uploadApi()
            ->destroy($publicId);
    }
}
