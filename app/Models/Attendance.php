<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    public function student(){

        return $this->belongsTo(Student::class,'student_id');
    }

    public function grade(){

        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function section(){

        return $this->belongsTo(Section::class,'section_id');
    }

    public function teacher(){

        return $this->belongsTo(Teacher::class,'teacher_id');
    }


    protected $guarded = [];
}
