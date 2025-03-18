<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolYear;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolYears = [
            ['name' => '2020-2021'],
            ['name' => '2021-2022'],
            ['name' => '2022-2023'],
            ['name' => '2023-2024'],
            ['name' => '2024-2025'],
            ['name' => '2025-2026']
        ];

        foreach ($schoolYears as $year) {
            SchoolYear::updateOrCreate(
                ['name' => $year['name']],
                $year
            );
        }
    }
}
