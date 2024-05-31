<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class StudentGraduateRepository implements StudentGraduateRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.students.graduates.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.students.graduates.create',compact('Grades'));
    }

    public function softDelete($request){
        $student = Student::where('Grade_id','=',$request->Grade_id)->where('Classroom_id','=',$request->Classroom_id)->where('section_id','=',$request->section_id)->get();

        if ($student->count() < 1 ){
            return redirect()->back()->with('error_Graduated','لا يوجد بيانات لعرضها');
        }
        foreach ($student as $st) {
            $ids = explode(',',$st->id);
            Student::whereIn('id',$ids)->delete();
        }
        toastr()->error(trans('student_trans.delete'));
        return to_route('graduates.index');
    }

    public function returnStudent($request){

        Student::onlyTrashed()->where('id',$request->id)->first()
        ->restore();

        toastr()->info(trans('student_trans.restore'));
        return to_route('graduates.index');
    }

    public function forceDelete($request){

        Student::onlyTrashed()->where('id',$request->id)->first()
        ->forceDelete();

        toastr()->error(trans('student_trans.delete'));
        return to_route('graduates.index');
    }

    public function graduateStudent($request){

        Student::where('id',$request->id)->first()->delete();
        toastr()->error(trans('student_trans.delete'));
        return redirect()->back();
    }
}
