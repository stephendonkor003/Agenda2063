<?php

namespace Database\Seeders;

use App\Models\ExternalDataSource;
use Illuminate\Database\Seeder;

class ExternalDataSourceSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            [
                'name' => 'AfDB Open Data',
                'provider' => 'AfDB',
                'type' => 'rest',
                'base_url' => 'https://api.afdb.org/data',
                'auth_type' => 'api_key',
                'auth_header' => 'X-API-Key',
                'sync_frequency' => 'daily',
                'status' => 'active',
                'notes' => 'Pull macro indicators for goals.',
            ],
            [
                'name' => 'UNDP HDR',
                'provider' => 'UNDP',
                'type' => 'rest',
                'base_url' => 'https://hdr.undp.org/api',
                'auth_type' => 'none',
                'sync_frequency' => 'weekly',
                'status' => 'inactive',
                'notes' => 'Manual review before syncing.',
            ],
        ];

        foreach ($sources as $src) {
            ExternalDataSource::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($src['name'])],
                $src
            );
        }
    }
}
