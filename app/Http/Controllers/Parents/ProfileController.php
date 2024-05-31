<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile()
    {
       $information = MyParent::findOrFail(auth()->user()->id);
        return view('pages.parents.profile',compact('information'));
    }

    function update(Request $request, $id)
    {
        $information = MyParent::findOrFail($id);

        if (!empty($request->password)){
            $information -> Name_Father = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $information -> password = Hash::make($request->password);
            $information->save();
        }
        else{
            $information -> Name_Father = ['ar'=>$request->Name_ar, 'en'=>$request->Name_en];
            $information->save();
        }
        toastr()->info(trans('success.update'));
        return to_route('profile.show.parent');
    }
}
