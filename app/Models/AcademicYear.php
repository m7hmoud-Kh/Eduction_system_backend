<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'year', 'branch_id'];

    public function yearNameFormat($yearName)
    {
        switch ($yearName) {
            case 1:
                return "الصف الاول الثانوى";
            case 2:
                return "الصف الثانى الثانوى";
            case 3:
                return "الصف الثالث الثانوى";
            default:
                break;
        }
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class);
    }
}
