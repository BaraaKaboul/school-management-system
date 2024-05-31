<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;
    protected $table = 'grades';
    public $timestamps = true;

    protected $fillable = ['name','note'];

    //هون يعني انو الكولمن الي اسمو name بتستخدم الترجمة
    //طبعا من بكج spatie translatable
    public $translatable = ['name'];

    public function classroom(){

        return $this->hasMany(Classroom::class);
    }

    //حطينا هاي العلاقة مشان نوصل من grades ل section لأنو مافي علاقة مباشرة بيناتن
    public function section()
    {
        return $this->hasManyThrough(Section::class, Classroom::class);
    }
}
