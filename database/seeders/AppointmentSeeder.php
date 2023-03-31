<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ClassRoom;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        $faker = Factory::create();
        $classRoomsIds = ClassRoom::pluck('id');

        for ($i = 0; $i < 5; $i++) {
            $day = $weekdays[$faker->numberBetween(0, 6)];
            $appointment = Appointment::create([
                'day' => $day,
                'from' => $faker->time('H:i'),
                'to' => $faker->time('H:i'),
                'class_room_id' => $classRoomsIds[rand(0, count($classRoomsIds) - 1)]
            ]);
            $appointment->save();
        }
    }
}
