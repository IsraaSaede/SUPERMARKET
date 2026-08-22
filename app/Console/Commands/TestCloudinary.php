<?php

namespace App\Console\Commands;

use Cloudinary\Cloudinary;
use Illuminate\Console\Command;

class TestCloudinary extends Command
{
    protected $signature = 'cloudinary:test';

    protected $description = 'Test Cloudinary connection';

    public function handle(): int
    {
        try {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('services.cloudinary.cloud_name'),
                    'api_key' => config('services.cloudinary.api_key'),
                    'api_secret' => config('services.cloudinary.api_secret'),
                ],
            ]);

            $result = $cloudinary->adminApi()->ping();

            $this->info('Cloudinary connection successful!');
            $this->line(json_encode($result));

            return self::SUCCESS;

        } catch (\Throwable $e) {
            $this->error('Cloudinary connection failed!');
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
