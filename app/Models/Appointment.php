<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'from',
        'to',
        'class_room_id'
    ];


    function formatHoursAndMinutes($dateString)
    {
        $date = new DateTime($dateString);
        return $date->format('H:i');
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
