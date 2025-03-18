<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            ['name' => 'First Semester'],
            ['name' => 'Second Semester'],
            ['name' => 'Summer']
        ];

        foreach ($semesters as $sem) {
            Semester::updateOrCreate(
                ['name' => $sem['name']],
                $sem
            );
        }
    }
}
