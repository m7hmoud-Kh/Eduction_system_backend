<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Note;
use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoteSeeder extends Seeder
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

        for ($i = 0; $i < 10; $i++) {
            Note::create([
                'description' => $faker->unique()->sentence(),
                'class_room_id' => $classRoomsIds->random()
            ]);
        }
    }
}
