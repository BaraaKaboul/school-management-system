<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['section_name','status','classroom_id'];
    public $translatable = ['section_name'];

    public function classroom(){

        return $this->belongsTo(Classroom::class);
    }

    public function grade(){

        return $this->belongsTo(Grade::class);
    }

    public function teacher(){

        return $this->belongsToMany(Teacher::class, 'teachers_sections');
    }
}
