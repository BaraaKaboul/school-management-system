<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return Section::find(3)->teacher;
//        return Teacher::find(3)->section;

        //مشان نوصل لهاي العلاقة لازم نعمل متل مو عامل بالmodel تبع grades
        //يعني جبلي كل الاقسام المتعلقة بكل مرحلة
        $grades = Grade::with(['section'])->get();
        $teachers = Teacher::all();
        return view('pages.sections.sections',compact('grades','teachers'));
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
        try {
            $section = Section::create([
                'section_name'=>[
                    'ar'=>$request->Name_Section_Ar,
                    'en'=>$request->Name_Section_En,
                ],
                'classroom_id'=>$request->Class_id,
                'status'=>1,
            ]);
            //منستخدما لما يكون في عنا علاقة many-to-many لربط او تخزين سجل بيانات جديد
            //يعني بتخزن ريكورد بجدول العلاقات الفرعية اي الطرف التالت
            $section->teacher()->attach($request->teacher_id);

            toastr()->success(trans('sections_trans.add_success'));
            return redirect()->back();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $sec = Section::findOrFail($id);
            $sec->section_name = ['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En,];
            $sec->classroom_id = $request->Class_id;

            //يعني التحقق من هاد الريكويست ازا موجود نفذ والا نفذ else
            if (isset($request->status)){
                $sec->status = 1;
            }
            else{
                $sec->status = 2;
            }

            // update pivot table teacher_section_table
            //فائدة isset بتشيك اذا تحقق هاد الريكوست او الفاريابل فنفذ المطلوب
            if (isset($request->teacher_id)) {
                //تستخدم sync في حالات العلاقات many-to-many
                //تستخدم لتحديث الحقول التي تكون array سواءا كحذف او اضافة array او واحد
                $sec->teacher()->sync($request->teacher_id);
                //الteacher() بتمثل العلاقة many-to-many بمودل الSection
            } else {
                $sec->teacher()->sync(array());
            }

            $sec->save();


//                'section_name'=>[
//                    'ar'=>$request->Name_Section_Ar,
//                    'en'=>$request->Name_Section_En,
//                ],
//                'classroom_id'=>$request->Class_id,
//
//                if (isset($request->status)){
//                    'status'=1;
//                }
//                else{
//                    'status'=2;
//                }
//
//
//            ]);
            toastr()->info(trans('sections_trans.edit_success'));
            return redirect()->back();
        }

            catch(\Exception $e){
                return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::findOrFail($id)->delete();
        toastr()->error(trans('sections_trans.delete.success'));
        return redirect()->back();
    }

    //هاي الميثود مربوطة بكود الجافاسكربت مشلن يجبلي الصفوف بناءا على المراحل
    public function getClasses($id){

        $classes = Classroom::where('grade_id',$id)->pluck('class_name','id');
        return $classes;
    }
}
