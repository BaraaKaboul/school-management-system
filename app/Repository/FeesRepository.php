<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();
        return view('pages.fees.index',compact('fees'));
    }

    public function create(){

        $Grades = Grade::all();
        return view('pages.fees.add',compact('Grades'));
    }

    public function store($request){

        try {
            $fee = new Fee();
            $fee->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fee->amount = $request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->year = $request->year;
            $fee->description = $request->description;
            $fee->fees_type = $request->fees_type;
            $fee->save();

            toastr()->success(trans('fee_trans.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function edit($id){

        $fee = Fee::findOrFail($id);
        $Grades = Grade::all();
        return view('pages.fees.edit',compact('fee','Grades'));
    }

    public function update($request){

        try {
            $fee = Fee::findOrFail($request->id);
            $fee->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fee->amount = $request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->year = $request->year;
            $fee->description = $request->description;
            $fee->fees_type = $request->fees_type;
            $fee->save();

            toastr()->info(trans('fee_trans.edit'));
            return redirect()->back();
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function destroy($request){

        try {
            Fee::findOrFail($request->id)->destroy($request->id); // حلاوتها للdestroy انو كمان بتمسح مجموعة منids

            toastr()->error(trans('fee_trans.delete'));
            return redirect()->back();
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
}
