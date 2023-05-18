<?php

namespace Database\Seeders;

use App\Models\Governorate;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids=Governorate::pluck('id');

        for ($i=0; $i < 3 ; $i++) {
           
            Student::create([
               
                'f_name'=>Str::random(7),
                'm_name'=>Str::random(7),
                'l_name'=>Str::random(7),
                'phone_number'=>Str::random(11),
                'email'=>Str::random(11),
                'status' => 1,
                'governorate_id'=>$ids[rand(0,count($ids)-1)]
                
            ]);
    }
}
}