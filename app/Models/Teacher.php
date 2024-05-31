<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable // حطينا هاي هيك مشان يقبل انو يعمل بهاد الجدول authentication
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['Name'];
    protected $guarded = [];


    public function gender(){
        //يفضل دائما حط الforeignkey بالعلاقة
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    public function specialization(){

        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    public function section(){

        return $this->belongsToMany(Section::class, 'teachers_sections');
    }
}
