<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ClassRoom;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $classRoomsIds = ClassRoom::pluck('id');

        for ($i = 0; $i < 5; $i++) {
            Appointment::create([
                'day' => $faker->date('Y-m-d'),
                'from' => $faker->dateTime(),
                'to' => $faker->dateTime(),
                'class_room_id' => $classRoomsIds->random()
            ]);
        }
    }
}
