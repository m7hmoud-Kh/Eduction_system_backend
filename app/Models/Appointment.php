<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['day', 'from', 'to', 'class_room_id'];

    public function classRooms()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
