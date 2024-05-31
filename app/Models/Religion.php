<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Religion extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['rel_name'];
    protected $fillable = ['rel_name'];



}