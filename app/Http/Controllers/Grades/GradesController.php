<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //وظيفة orderBy بتجيب اخر انضاف بقاعدة البيانات وبتحطو اول شي طبعا لانو حاطين DESC
        $grades = Grade::orderBy('id','DESC')->get();
        return view('pages.grades.grades', compact('grades'));
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
    public function store(GradeRequest $request)
    {

        //عملنا هالكود قبل الاضافة مشان يشيك عليه اذا القيمة موجودة مايخزن بقاعدة البيانات ويطلع رسالة خطأ من withErrors
        //لانو مافينا نستخدم الفاليديشن العادية لانو مخزنة بالكولمن بصيغة array بسبب عملية الترجمة
        //او منستخدم بكج اسما codezero-be/laravel unique translation
        //منستعمل هاي الطريقة تحت او الي متل مو موجودة بGradesRequest


//        if (Grade::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){
//            return redirect()->back()->withErrors(trans('grades_trans.exist'));
//        }

        try {//وظيفتها انو تنفذ هاد الكلام ازا كان كلشي صحيح والا روح نفذ الcatch
            Grade::create([
                'name' => [
                    //هاي الطريقة مشان نخزن الحقلين الي هن اسم المرحلة بالانجليزية والعربية, لانو ماعنا غير حقل واحد, فاستخدمنا بكج spatie transaltable
                    //يعني بالمختصر لما اخزن بهاي الطريقة وجيب البيانات من الداتابيز وبعد ما اختار اللغة لبدي ياها بجيب العربي الكلام العربي والانجليزي بجيب الانجليزي
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'note' => $request->note,
            ]);

            toastr()->success(trans('grades_trans.add_sucsess'));
            return redirect()->route('grade.index');
        } catch (\Exception $e) {
            //يعني اذا ما اتنفذ try تعال نفذ هون وترجمة هاد الكلام انو ارجعلي للصفحة نفسا مع رسالة الخطأ, وكمان بجيب أخطاء الكويري
            //\Exception $e هاي معرفة داخل الريموورك للاخطاء
            //طبعا مشان تطلع الاخطاء لازم يكون في كود بيطلع الايرور بالview نفس تبع الvalidation
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

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
    public function update(GradeRequest $request)
    {

        //هون مازبطت الاهاي الطريقة ليش مابعرف مع انو شغالة بكود الاضافة طريقة الrequest
//        if (Grade::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){
//            return redirect()->back()->withErrors(trans('grades_trans.exist'));
//        }
        try {

            $id = $request->id;
            Grade::findOrFail($id)->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'note' => $request->note,
            ]);

            toastr()->info((trans('grades_trans.edit_sucsess')));
            return redirect()->route('grade.index');
        } catch (\Exception $e) {
            //يعني اذا ما اتنفذ try تعال نفذ هون وترجمة هاد الكلام انو ارجعلي للصفحة نفسا مع رسالة الخطأ, وكمان بجيب أخطاء الكويري
            //\Exception $e هاي معرفة داخل الريموورك للاخطاء
            //طبعا مشان تطلع الاخطاء لازم يكون في كود بيطلع الايرور بالview نفس تبع الvalidation
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;

            //بالمختصر وظيفة هاد الكود بيشيك على العلاقة بجدول classrooms
            //ازا كان في مراحل مربوطة مع الصفوف مابيحذفها
            //لاوم اولا يحذف الصفوف بعدين يحذف المرحلة
            //طبعا عملنا هيك مشان مايطير المرحلة اول شي ويطير كل الصفوف المرتبطة فيها و\بعا هالشي غلط
            $class = Classroom::where('grade_id', $id)->pluck('grade_id');
            if ($class->count() == 0) {
                Grade::where('id', $id)->delete();

                toastr()->error(trans('grades_trans.delete_sucsess'));
                return redirect()->back();

            } else {
                    toastr()->error(trans('grades_trans.delete_classes_first'));
                    return redirect()->back();
            }
        }


        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
