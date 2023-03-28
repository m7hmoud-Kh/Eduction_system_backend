<?php

namespace Database\Seeders;

use App\Models\Attachment;
use Faker\Factory;
use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttachmentSeeder extends Seeder
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
            Attachment::create([
                'name' => $faker->name(),
                'description' => $faker->unique()->sentence(),
                'class_room_id' => $classRoomsIds->random()
            ]);
        }
    }
}
