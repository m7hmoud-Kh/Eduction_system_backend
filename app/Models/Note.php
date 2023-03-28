<?php

namespace App\Models;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'class_room_id'];

    public function classRooms()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
