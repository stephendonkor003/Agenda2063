<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('navigation_links', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('id')
                ->constrained('navigation_links')
                ->cascadeOnDelete();
        });

        $timestamp = now();
        $menus = [
            'en' => [
                'parent' => 'Programmes',
                'children' => [
                    ['label' => 'AU Media Fellowship', 'url' => 'https://au.int/en/aumf'],
                    ['label' => 'AU Tech Fellowship', 'url' => 'https://auinnovationfellowship.com/'],
                    ['label' => 'AU Internship Programme', 'url' => 'https://au.int/en/internship/apply'],
                    ['label' => 'AU Youth Volunteer Corps', 'url' => 'https://go.au.int/en/youth-volunteer-corps'],
                ],
            ],
            'fr' => [
                'parent' => 'Programmes',
                'children' => [
                    ['label' => 'AU Media Fellowship', 'url' => 'https://au.int/en/aumf'],
                    ['label' => 'AU Tech Fellowship', 'url' => 'https://auinnovationfellowship.com/'],
                    ['label' => 'AU Internship Programme', 'url' => 'https://au.int/en/internship/apply'],
                    ['label' => 'AU Youth Volunteer Corps', 'url' => 'https://go.au.int/en/youth-volunteer-corps'],
                ],
            ],
            'pt' => [
                'parent' => 'Programas',
                'children' => [
                    ['label' => 'AU Media Fellowship', 'url' => 'https://au.int/en/aumf'],
                    ['label' => 'AU Tech Fellowship', 'url' => 'https://auinnovationfellowship.com/'],
                    ['label' => 'AU Internship Programme', 'url' => 'https://au.int/en/internship/apply'],
                    ['label' => 'AU Youth Volunteer Corps', 'url' => 'https://go.au.int/en/youth-volunteer-corps'],
                ],
            ],
            'ar' => [
                'parent' => 'البرامج',
                'children' => [
                    ['label' => 'AU Media Fellowship', 'url' => 'https://au.int/en/aumf'],
                    ['label' => 'AU Tech Fellowship', 'url' => 'https://auinnovationfellowship.com/'],
                    ['label' => 'AU Internship Programme', 'url' => 'https://au.int/en/internship/apply'],
                    ['label' => 'AU Youth Volunteer Corps', 'url' => 'https://go.au.int/en/youth-volunteer-corps'],
                ],
            ],
        ];

        foreach ($menus as $locale => $menu) {
            $existingRoot = DB::table('navigation_links')
                ->where('location', 'header')
                ->where('locale', $locale)
                ->where('label', $menu['parent'])
                ->first();

            if ($existingRoot) {
                continue;
            }

            $nextPosition = ((int) DB::table('navigation_links')
                ->where('location', 'header')
                ->where('locale', $locale)
                ->whereNull('parent_id')
                ->max('position')) + 1;

            $rootId = DB::table('navigation_links')->insertGetId([
                'label' => $menu['parent'],
                'url' => '#',
                'location' => 'header',
                'locale' => $locale,
                'position' => $nextPosition,
                'parent_id' => null,
                'open_in_new_tab' => false,
                'is_active' => true,
                'clicks' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);

            foreach ($menu['children'] as $index => $child) {
                DB::table('navigation_links')->insert([
                    'label' => $child['label'],
                    'url' => $child['url'],
                    'location' => 'header',
                    'locale' => $locale,
                    'position' => $index,
                    'parent_id' => $rootId,
                    'open_in_new_tab' => true,
                    'is_active' => true,
                    'clicks' => 0,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }
        }
    }

    public function down(): void
    {
        $menus = [
            'en' => 'Programmes',
            'fr' => 'Programmes',
            'pt' => 'Programas',
            'ar' => 'البرامج',
        ];

        foreach ($menus as $locale => $label) {
            $rootIds = DB::table('navigation_links')
                ->where('location', 'header')
                ->where('locale', $locale)
                ->where('label', $label)
                ->pluck('id');

            if ($rootIds->isNotEmpty()) {
                DB::table('navigation_links')->whereIn('parent_id', $rootIds)->delete();
                DB::table('navigation_links')->whereIn('id', $rootIds)->delete();
            }
        }

        Schema::table('navigation_links', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
        });
    }
};
