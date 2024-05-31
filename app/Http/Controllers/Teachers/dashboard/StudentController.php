<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids= DB::table('teachers_sections')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id',$ids)->get();
        return view('pages.teachers.students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function section()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->with('grade')->get();
        return view('pages.teachers.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {

        try {

            $attenddate = date('Y-m-d');
            $classid = $request->section_id;
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateOrCreate(['student_id' => $studentid,'attendence_date' => $attenddate],[ // يعني مشام يعدلي الطلاب ازا هن نفسن الي انضافو مسبقا ازا طلعو نفس الطلاب اعمل update والا اعمل create, يعني متل شرط
                    'student_id' => $studentid,                      // ولما يكون التاريخ المسجل في الداتابيز بيساوي تاريخ اليوم اعمل update ولما لا اعمل create
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => $attenddate,
                    'attendence_status' => $attendence_status
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editAttendance(Request $request)// هاد الكود عوضت عنو بالكود لفوق بالنسبة للاضافة والتعديل بنفس الوقت
    {

        try{
        $date = date('Y-m-d');
        $student_id = Attendance::where('attendence_date', $date)->where('student_id', $request->id)->first();
        if ($request->attendences == 'presence') {
            $attendence_status = true;
        } else if ($request->attendences == 'absent') {
            $attendence_status = false;
        }
        $student_id->update([
            'attendence_status' => $attendence_status
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function attendanceReport(){

        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.teachers.students.attendance_report', compact('students'));
    }

    public function attendanceSearch(Request $request){

        $this->validate($request,[
            'from'  =>'required|date|date_format:Y-m-d',
            'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'// يعني عم قلو التاريخ تبع النهاية لاوم يكون بعد تاريخ البداية ابو بساويه
        ],[
            'to.after_or_equal' => 'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {
            $Students = Attendance::whereBetween('attendence_date',[$request->from,$request->to])->get();// منستخدم whereBetween دائما لا نقارن بين تاريخين
            return view('pages.teachers.students.attendance_report',compact('Students','students'));
        }
        else{
            $Students = Attendance::whereBetween('attendence_date',[$request->from,$request->to])
                            ->where('student_id',$request->student_id)->get();
            return view('pages.teachers.students.attendance_report',compact('Students','students'));
        }
    }

}
