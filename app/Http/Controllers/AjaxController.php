<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function Get_Classrooms($id)
    {
        return Classroom::where("grade_id", $id)->pluck("class_name", "id");
    }

    public function Get_Sections($id){

        return Section::where("classroom_id", $id)->pluck("section_name", "id");
    }
}
