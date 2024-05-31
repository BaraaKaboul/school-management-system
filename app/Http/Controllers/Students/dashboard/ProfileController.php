<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Student::findOrFail(auth()->user()->id);
        return view('pages.students.profile',compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Student::findOrFail($id);

        if (!empty($request->password)){
            $information -> name = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $information -> password = Hash::make($request->password);
            $information->save();
        }
        else{
            $information -> name = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $information->save();
        }
        toastr()->info(trans('success.update'));
        return to_route('profile.user');
    }
}
