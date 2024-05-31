<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizz;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzRepository implements QuizzRepositoryInterface
{
    public function index()
    {
        $quizzes = Quizz::all();
        return view('pages.Quizes.index',compact('quizzes'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('pages.Quizes.create',compact('subjects','teachers','grades'));
    }

    public function store($request)
    {
        try {

            $quizzes = new Quizz();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quiz.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quizz = Quizz::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('pages.Quizes.edit',compact('quizz','subjects','teachers','grades'));
    }

    public function update($request)
    {
        try {

            $quizzes = Quizz::findOrFail($request->id);
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->info(trans('messages.success'));
            return redirect()->route('quiz.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Quizz::destroy($request->id);

        toastr()->error(trans('messages.success'));
        return redirect()->route('quiz.index');
    }
}
