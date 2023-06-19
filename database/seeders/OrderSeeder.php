<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids=Student::pluck('id');

        for ($i=0; $i < 3 ; $i++) {
           
            Order::create([
               
                'sub_total'=>rand(1,400),
                'discount'=>rand(1,50),
                'shipping'=>rand(1,50),
                'tax'=>rand(1,50),
                'total'=>rand(1,1000),
                'expire_month'=>Str::random(10),
                'expire_year'=>Str::random(10),
                'cvc'=> rand(1234,9999),
                'status' => 1,
                'student_id'=>$ids[rand(0,count($ids)-1)]
                
            ]);
    }
}
}