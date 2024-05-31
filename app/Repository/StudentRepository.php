<?php

 namespace App\Repository;

use App\Models\BloodType;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{

    public function viewAddStudent(){

        $parents = MyParent::all();
        $my_classes = Grade::all();
        $bloods = BloodType::all();
        $nationals = Nationality::all();
        $Genders = Gender::all();
        return view('pages.students.add-student',compact('Genders','nationals','bloods','my_classes','parents'));
    }

    public function get_classroom($id){

        return Classroom::where('grade_id',$id)->pluck('class_name','id');
    }

    public function get_section($id){

        return Section::where('classroom_id',$id)->pluck('section_name','id');
    }

    public function storeStudent($request){

        // يعني انا عم قلو انتبه في عندي كود اضافة بجدولين (بحالتي طبعا)
        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();


            if ($request->hasFile('photos'))
            {
                foreach ($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name, $name, 'upload-attachments');

                    $image = new Image();
                    $image->filename = $name;
                    $image->imageable_id = $students->id;
                    $image->imageable_type = 'App\Models\Student';
                    $image->save();
                }
            }

            // واذا انتفذو الكودين, يعني انضاف بالجدول الاول والجدول الثاني (بحالتي), يعمني الكود كلو تمام, خزن بقاعدة البيانات
            DB::commit();

            toastr()->success(trans('student_trans.store'));
            return redirect()->route('students.index');


        }

        catch (\Exception $e){
            // واذا كان في مشكلة بالكود ارجعلي خطوة بالداتابيز, بعدين طلعلي المشكلة بالcatch
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getStudents(){

        $students = Student::all();
        return view('pages.students.students-list',compact('students'));
    }

    public function editStudent($id){

        $data['parents'] = MyParent::all();
        $data['Grades'] = Grade::all();
        $data['bloods'] = BloodType::all();
        $data['nationals'] = Nationality::all();
        $data['Genders'] = Gender::all();
        $Students = Student::findOrFail($id);
        return view('pages.students.edit',$data, compact( 'Students'));
    }

    public function updateStudent($request){

        try {
            $students = Student::findOrFail($request->id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->info(trans('student_trans.update_info'));
            return redirect()->route('students.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteStudent($request){

        try {
//            Student::findOrFail($request->id)->delete();
            //وكمان فائدتها انو بتخليني احذف array يعني مجموعة id's
            Student::destroy($request->id);
            toastr()->error(trans('student_trans.delete'));
            return redirect()->route('students.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }


    public function showStudent($id){

        $Student = Student::findOrFail($id);
        return view('pages.students.show',compact('Student'));
    }

    public function uploadAttachment($request){

        try {
            foreach ($request->file('photos') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(), 'upload-attachments');

                $store = new Image();
                $store->filename = $name;
                $store->imageable_id = $request->student_id;;
                $store->imageable_type = 'App\Models\Student';
                $store->save();
            }
            toastr()->success(trans('student_trans.store'));
            return to_route('Upload_attachment');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function downloadAttachment($studentsname, $filename){

        return response()->download(public_path('attachments/students/'.$studentsname.'/'.$filename));
    }

    public function deleteAttachment($request){

        // يعني انا عم قلو انتبه في عندي كود حذف من ملفات المشروع وحذف من قاعدة البيانات
        DB::beginTransaction();
        try {
            Storage::disk('upload-attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

            // هاد الكود بيسمحلي احذف المرفق من قاعدة البيانات
            Image::where('id',$request->id)->where('filename',$request->filename)->delete();

            // واذا انتفذو الكودين, يعمني الكود كلو تمام, احذف من المكانين
            DB::commit();
            toastr()->error(trans('student_trans.delete'));
            return redirect()->back();
        }
        catch (\Exception $e){
            // واذا كان في مشكلة بالكود ارجعلي خطوة بالداتابيز, بعدين طلعلي المشكلة بالcatch
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
        //يعني عم قلو تحديدا يحذفلي الصورة جوات الملفات عندي, طبعا هاي الريكويستات جبتا من الview

    }
}












