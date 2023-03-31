<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\AcademicYear;
use App\Models\Semester;



class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicYearIds = AcademicYear::pluck('id');

        for ($i = 0; $i < 3; $i++) {
            Semester::create([
                'name' => 1,
                'academic_year_id' => $academicYearIds[rand(0, count($academicYearIds) - 1)]
            ]);
        }
    }
}
