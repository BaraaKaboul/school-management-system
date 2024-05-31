<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;



    protected $guarded = [];

    //هاد الموديل لبدي اربط فيو مع اي موديل رح احط مثلا فيو صور بحالتي مثلا رح اربط مع موديل Student روح شوف كيف انربط
    public function imageable(){

        return $this->morphTo();
    }
}
