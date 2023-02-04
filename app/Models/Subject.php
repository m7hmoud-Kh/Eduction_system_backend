<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'academic_year_id', 'semester_id'];
    protected $table = 'subjects';

    public function academicYears()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semesters()
    {
        return $this->belongsTo(Semester::class);
    }
}
