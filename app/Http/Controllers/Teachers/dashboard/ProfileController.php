<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findOrFail(auth()->user()->id);
        return view('pages.teachers.profile')->with(['information'=>$information]);
    }

    public function update(Request $request,$id)
    {
        $update_info = Teacher::findOrFail($id);

        if (!empty($request->password)){
            $update_info -> Name = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $update_info -> password = Hash::make($request->password);
            $update_info->save();
        }
        else{
            $update_info -> Name = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $update_info->save();
        }
        toastr()->info(trans('success.update'));
        return to_route('profile.index');
    }
}
