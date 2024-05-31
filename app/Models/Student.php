<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable // حطينا هاي هيك مشان يقبل انو يعمل بهاد الجدول authentication
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;


    public $translatable = ['name'];

    protected $guarded = [];


    public function gender(){

        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function grade(){

        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function classroom(){

        return $this->belongsTo(Classroom::class,'Classroom_id');
    }

    public function section(){

        return $this->belongsTo(Section::class,'section_id');
    }

    public function nationality(){

        return $this->belongsTo(Nationality::class, 'nationalitie_id');
    }

    public function parent(){

        return $this->belongsTo(MyParent::class,'parent_id');
    }

    public function student_account(){

        return $this->hasMany(StudentAccount::class,'student_id');
    }

    public function attendance(){

        return $this->hasMany(Attendance::class,'student_id');
    }






    public function images(){

        //هون ربطنا بين موديل Image و موديل Student
        //و imageable هي الميثود الموجودة بموديل Image, وفينا نستخدم نفس العلاقة لربط مع اي موديل رح يكون فيو صور او ملفات
        return $this->morphMany(Image::class,'imageable');
    }
}
