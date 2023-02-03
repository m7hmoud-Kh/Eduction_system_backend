<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Governorate;
use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            GovernorateSeeder::class,
            BranchSeeder::class,
            UserTableSeeder::class,
            AcademicYearSeeder::class,
            SemesterSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
