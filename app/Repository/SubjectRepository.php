<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::all();
        return view('pages.subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.create',compact('grades','teachers'));
    }

    public function store($request)
    {
        try {
            Subject::create([
                'name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en,
                ],
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Class_id,
                'teacher_id' => $request->teacher_id,
            ]);
            toastr()->success('message.success');
            return to_route('subject.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.edit',compact('subject','grades','teachers'));
    }

    public function update($request)
    {
        try {
            Subject::findOrFail($request->id)->update([
                'name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en,
                ],
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Class_id,
                'teacher_id' => $request->teacher_id,
            ]);
            toastr()->info('message.info');
            return to_route('subject.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function destroy($request)
    {
//        Subject::findOrFail($request->id)->delete();
        // او فينا نكتب هيك
        Subject::destroy($request->id); // فائدتها كمان بتمسح array من ال ids
        toastr()->error('message.delete');
        return to_route('subject.index');
    }
}


