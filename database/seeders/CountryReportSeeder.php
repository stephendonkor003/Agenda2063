<?php

namespace Database\Seeders;

use App\Models\CountryReport;
use Illuminate\Database\Seeder;

class CountryReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [
                'country_code' => 'GHA',
                'country_name' => 'Ghana',
                'region' => 'West Africa',
                'year' => 2025,
                'status' => 'published',
                'overall_score' => 68.5,
                'summary' => 'Solid progress on education and digital trade.',
            ],
            [
                'country_code' => 'KEN',
                'country_name' => 'Kenya',
                'region' => 'East Africa',
                'year' => 2025,
                'status' => 'submitted',
                'overall_score' => 72.3,
                'summary' => 'Advances in infrastructure and blue economy.',
            ],
        ];

        foreach ($reports as $rep) {
            CountryReport::updateOrCreate(
                ['country_code' => $rep['country_code'], 'year' => $rep['year']],
                $rep
            );
        }
    }
}
