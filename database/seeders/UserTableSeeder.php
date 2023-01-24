<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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

        $mananger = User::create([
            'name' => 'mahmoud',
            'email' => 'mahmoud@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $mananger->assignRole('manager');

        User::create([
            'name' => 'khairy',
            'email' => 'khairy@gmail.com',
            'password' => Hash::make('123456')
        ]);

    }
}
