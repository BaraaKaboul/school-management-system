<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $grades = Grade::all();
        $classes = Classroom::all();
        return view('pages.classes.classes',compact('classes','grades'));
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
    public function store(ClassroomRequest $request)
    {
//        return $request->List_Classes;

        //نفسا الي حكيت عنها بالview مشان تحبلي كل السطور المدخلة بنفس الوقت
        $List_Classes = $request->List_Classes;
        try {

//وعملنا لوب مشان نعرف كم حقل رح ينضاف
            //مافي داعي نعمل $request جوات الحقول كالعادة لانو جايبينا جوات حلقة اللوب ومنكتفي باسم الانبوت
            foreach ($List_Classes as $row){
                Classroom::create([
                    'class_name' => [
                                        'ar'=>$row  ['class_name'],
                                        'en'=>$row  ['class_name_en'],
                                    ],
                    'grade_id'=>$row['grade_id'],
                ]);
// او هاي الطريقة
//                $class_name = new Classroom();
//                $class_name->calss_name = ['ar'=>$row[$request->class_name],
//                                           'en'=>$row[$request->class_name_en]];
//                $class_name->grade_id = $row[$grade_id];
//                $class_name->save();


            }
            toastr()->success(trans('classes_trans.sucsess'));
            return redirect()->back();
        }

        catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request)
    {
        try {
            $id = $request->id;
            Classroom::findOrFail($id)->update([
                'class_name'=>[
                    'ar'=>$request->class_name,
                    'en'=>$request->class_name_en,
                ],
                'grade_id'=>$request->grade_id,
            ]);
            toastr()->info(trans('classes_trans.edit_sucsess'));
            return redirect()->back();
        }

        catch(\Exception $e){
                return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
//        try {
//            $id = $request->class_id;
//            Classroom::findOrFail($id)->delete();
//            toastr()->error('classes_trans.delete_sucsess');
//            return redirect()->back();
//        }
//        catch(\Exception $e){
//            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
//        }
    }

    public function delete(Request $request){
//////////////// ملاحظة جدا مهمة: ماكان يشتغل الdestroy تبع الresource حتى عملت route منفصل للحذف مابعرف ليش
        $id = $request->class_id;
        try {
            Classroom::findOrFail($id)->delete();
            toastr()->error('classes_trans.delete_sucsess');
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function deleteAll(Request $request){

//        الexplode وظيفتا تحطلي الريكويست ضمن array
        $delete_all_id = explode(",", $request->delete_all_id);

//وعملنا الريكوست ضمن array مشان whereIn مابتاخد الا array
//        وعملنا هاي الحركة لانو نحنا في عنا مجموعة id جاي بالريكويست
        Classroom::whereIn('id', $delete_all_id)->delete();
        toastr()->error(trans('classes_trans.delete_sucsess'));
        return redirect()->back();
    }

    public function filtiredClasses(Request $request){

        $grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
        return view('pages.classes.classes',compact('grades'))->withDetails($Search);
    }
}
