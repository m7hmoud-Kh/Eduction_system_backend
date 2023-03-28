<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Student;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'prerequisite_exam',
        'status',
        'registration_deadline',
        'start_date',
        'max_capacity',
        'min_grade',
        'min_selected',
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class, 'classroom_student');
    }

    public function note()
    {
        return $this->hasMany(Note::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
