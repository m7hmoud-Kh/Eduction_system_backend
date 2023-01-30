<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'head_of_branch']);
        Role::create(['name' => 'assistant']);


        $faker = Factory::create();

        $mananger = User::create([
            'name' => 'mahmoud',
            'email' => 'mahmoud@gmail.com',
            'password' => Hash::make('123456')
        ]);
        $mananger->assignRole('manager');
        

        for ($i=0; $i < 8; $i++) {
            User::create([
                'name' => $faker->unique()->name(),
                'email' => $faker->safeEmail(),
                'password' => Hash::make('123456')
            ]);
        }



    }
}
