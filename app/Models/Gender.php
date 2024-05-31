<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['Name'];
    protected $fillable = ['Name'];

    public function teacher(){

        return $this->hasOne(Teacher::class);
    }
}
