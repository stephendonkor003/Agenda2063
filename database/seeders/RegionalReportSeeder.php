<?php

namespace Database\Seeders;

use App\Models\RegionalReport;
use Illuminate\Database\Seeder;

class RegionalReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [
                'region_code' => 'ECOWAS',
                'region_name' => 'Economic Community of West African States',
                'year' => 2025,
                'status' => 'published',
                'overall_score' => 64.2,
                'summary' => 'ECOWAS shows momentum on trade integration and peace initiatives.',
            ],
            [
                'region_code' => 'SADC',
                'region_name' => 'Southern African Development Community',
                'year' => 2025,
                'status' => 'draft',
                'overall_score' => 58.7,
                'summary' => 'SADC improving infrastructure; governance reforms in progress.',
            ],
        ];

        foreach ($reports as $rep) {
            RegionalReport::updateOrCreate(
                ['region_code' => $rep['region_code'], 'year' => $rep['year']],
                $rep
            );
        }
    }
}
