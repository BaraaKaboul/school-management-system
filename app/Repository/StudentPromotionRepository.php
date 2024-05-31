<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.students.promotions.index',compact('Grades'));
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
            $student = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            if ($student->count() < 1){
                return redirect()->back()->with('error','لا يوجد طلاب في هذه الشعبة');
            }

            // update students table
            foreach ($student as $st)
            {
                $ids = explode(',',$st->id);
                Student::whereIn('id',$ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new
                    ]);

                // insert into promotions table
                //يعني خزنلي البيانات اذا ماكانو موجودين, او اذا كانو موجودين حدثلي البيانات تبعن,,,, يعني مشان مايعملي dounlecate للبيانات
                Promotion::updateOrCreate([
                    'student_id'=>$st->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('student_trans.update_info'));
            return redirect()->back();
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function create(){

        $promotions = Promotion::all();
        return view('pages.students.promotions.management',compact('promotions'));
    }

    public function destroy($request){

        DB::beginTransaction();

        try {

            // التراجع عن الكل
            // مشان يعرف انو هاد زر تراجع عن الكل, فحطينا قيمة 1 للانبوت
            if($request->page_id == 1){

                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion){

                    //التحديث في جدول الطلاب
                    $ids = explode(',',$Promotion->student_id);
                    student::whereIn('id', $ids)
                        ->update([
                            // يعني عم قلو انو القيمة تبع الكولومن الي جوات pormotion حزنلي ياها بجدول الstudent
                            'Grade_id'=>$Promotion->from_grade,
                            'Classroom_id'=>$Promotion->from_Classroom,
                            'section_id'=> $Promotion->from_section,
                            'academic_year'=>$Promotion->academic_year,
                        ]);

                    //حذف جدول الترقيات
                    Promotion::truncate();

                }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();


            }
            else {
                $promotion = Promotion::findOrFail($request->id);
                Student::where('id', $promotion->student_id)
                    ->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_Classroom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);

                $promotion->delete();

                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
