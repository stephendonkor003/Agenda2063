<?php

namespace Database\Seeders;

use App\Models\FlagshipProject;
use App\Models\FlagshipUpdate;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FlagshipSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@agenda2063.africa')->first();
        $dept = Department::first();

        $projects = [
            [
                'title' => 'Integrated High-Speed Train Network',
                'progress' => 18.75,
                'status' => 'active',
                'summary' => 'Pan-African rail corridors to connect capitals and commercial hubs.',
            ],
            [
                'title' => 'Grand Inga Dam Hydropower Project',
                'progress' => 12.40,
                'status' => 'on-hold',
                'summary' => 'Hydropower generation to supply clean energy across the continent.',
            ],
            [
                'title' => 'African Commodity Strategy',
                'progress' => 36.55,
                'status' => 'active',
                'summary' => 'Value addition and beneficiation for Africa’s strategic commodities.',
            ],
            [
                'title' => 'African Passport & Free Movement',
                'progress' => 52.10,
                'status' => 'active',
                'summary' => 'Continental passport rollout and harmonised migration policies.',
            ],
            [
                'title' => 'Silencing the Guns',
                'progress' => 41.32,
                'status' => 'active',
                'summary' => 'Conflict prevention, mediation, and peace support operations.',
            ],
        ];

        foreach ($projects as $data) {
            $project = FlagshipProject::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'progress' => $data['progress'],
                    'status' => $data['status'],
                    'summary' => $data['summary'],
                    'department_id' => $dept?->id,
                    'created_by' => $admin?->id,
                    'updated_by' => $admin?->id,
                ]
            );

            // Seed two updates per project
            if ($project->updates()->count() === 0) {
                $updates = [
                    [
                        'title' => 'Quarterly progress briefing',
                        'type' => 'update',
                        'status' => 'published',
                        'body' => '<p>Latest field reports consolidated with engineering milestones.</p>',
                        'created_by' => $admin?->id,
                    ],
                    [
                        'title' => 'Press release on funding',
                        'type' => 'news',
                        'status' => 'published',
                        'body' => '<p>Partnership announcements and financing commitments.</p>',
                        'created_by' => $admin?->id,
                    ],
                ];
                foreach ($updates as $upd) {
                    $project->updates()->create($upd);
                }
            }
        }
    }
}
