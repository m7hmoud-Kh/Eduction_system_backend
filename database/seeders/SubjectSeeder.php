<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Semester;
use App\Models\AcademicYear;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $academicYearsIds = AcademicYear::pluck('id');
        $semestersIds = Semester::pluck('id');

        for ($i = 0; $i < 10; $i++) {
            Subject::create([
                'name' => $faker->name(),
                'status' => 1,
                'academic_year_id' => $academicYearsIds[rand(0, count($academicYearsIds) - 1)],
                'semester_id' => $semestersIds[rand(0, count($semestersIds) - 1)],
            ]);
        }
    }
}
