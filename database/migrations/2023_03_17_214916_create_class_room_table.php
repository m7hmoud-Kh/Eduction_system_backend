<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double('price',0.0);
            $table->enum('prerequisite_exam',[0,1]);
            $table->enum('status',[0,1]);
            $table->dateTime('registration_deadline');
            $table->dateTime('start_date');
            $table->integer('max_capacity');
            $table->integer('min_grade')->nullable();
            $table->integer('min_selected')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_rooms');
    }
};
