<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\ClassRoom;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 15; $i++) {
            ClassRoom::create([
                'name' => $faker->name(),
                'price' => $faker->numberBetween(10, 200),
                'prerequisite_exam' => 1,
                'status' => 1,
                'registration_deadline' => $faker->dateTime(),
                'start_date' => $faker->dateTime(),
                'max_capacity' => $faker->numberBetween(20, 150),
                'min_grade' => $faker->numberBetween(50, 70),
                'min_selected' => $faker->numberBetween(70, 150),
            ]);
        }
    }
}
