<?php

namespace App\Models;

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
        'branch_id',
        'subject_id',
        'teacher_id'
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class, 'classroom_student');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
