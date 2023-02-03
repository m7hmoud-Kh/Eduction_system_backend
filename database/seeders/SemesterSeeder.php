<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $ids = AcademicYear::pluck('id');

        for ($i = 0; $i < 3; $i++) {
            Semester::create([
                // 'name' => rand(1, 2),
                // 'status' => rand(0,1),
                'academic_year_id' => $ids[rand(0, count($ids) - 1)]
            ]);
        }
    }
}
