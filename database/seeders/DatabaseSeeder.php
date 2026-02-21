<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\AuthSetupSeeder;
use Database\Seeders\NewsCategorySeeder;
use Database\Seeders\PublicationSeeder;
use Database\Seeders\FlagshipSeeder;
use Database\Seeders\KnowledgeDocumentSeeder;
use Database\Seeders\NewsSeeder;
use Database\Seeders\CountryReportSeeder;
use Database\Seeders\RegionalReportSeeder;
use Database\Seeders\ExternalDataSourceSeeder;
use Database\Seeders\AnalyticsDemoSeeder;
use Database\Seeders\PublicVisibilitySeeder;
use Database\Seeders\HomePageSeeder;
use Database\Seeders\AboutPageSeeder;
use Database\Seeders\FlagshipPageSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@agenda2063.africa'],
            [
                'name' => 'Admin Master',
                'password' => Hash::make('Admin@2063!'),
                'is_admin' => true,
                'email_verified_at' => now(),
                'department_id' => null,
            ]
        );

        $this->call([
            AuthSetupSeeder::class,
            NewsCategorySeeder::class,
            PublicationSeeder::class,
            FlagshipSeeder::class,
            KnowledgeDocumentSeeder::class,
            NewsSeeder::class,
            CountryReportSeeder::class,
            RegionalReportSeeder::class,
            ExternalDataSourceSeeder::class,
            AnalyticsDemoSeeder::class,
            PublicVisibilitySeeder::class,
            HomePageSeeder::class,
            AboutPageSeeder::class,
            FlagshipPageSeeder::class,
        ]);
    }
}
