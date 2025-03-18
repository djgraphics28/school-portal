<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\SchoolYear;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolYears = SchoolYear::all();
        $semesters = Semester::all();

        foreach ($schoolYears as $schoolYear) {
            // Sync school year and semester with pivot data
            $schoolYear->semesters()->sync(
                $semesters->pluck('id')->mapWithKeys(function ($id) {
                    return [$id => ['is_active' => false]];
                })->toArray()
            );
        }
    }
}
