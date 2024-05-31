<?php
namespace App\Repository;


//يعني ضمنلي كل شي بTeacherRepositoryInterface هون مشان يحس بالفانكشنز ,, يعني شغل oop

//لازم نعمل provider مشان ينعملو build لهاد الكلام ولازم نضمنو مشان يشتغل
//هون بصير كل الشغل تبع الكومنترولر
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{


    public function getTeachers()
    {
        return Teacher::all();
    }

    public function getSpecialization(){

        return Specialization::all();
    }

    public function getGender(){

        return Gender::all();
    }


    public function storeTeacher($request){

        try {
            Teacher::create([
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'Name'=>[
                    'ar'=>$request->Name_ar,
                    'en'=>$request->Name_en,
                ],
                'Specialization_id'=>$request->Specialization_id,
                'Gender_id'=>$request->Gender_id,
                'Joining_Date'=>$request->Joining_Date,
                'Address'=>$request->Address,
            ]);

//            $Teachers = new Teacher();
//            $Teachers->Email = $request->email;
//            $Teachers->Password =  Hash::make($request->password);
//            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
//            $Teachers->Specialization_id = $request->Specialization_id;
//            $Teachers->Gender_id = $request->Gender_id;
//            $Teachers->Joining_Date = $request->Joining_Date;
//            $Teachers->Address = $request->Address;
//            $Teachers->save();

            toastr()->success(trans('teachers_trans.success'));
            return to_route('teachers.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function editTeacher($id){

        return Teacher::findOrFail($id);
    }

    public function updateTeacher($request){

        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email = $request->email;
            $Teachers->password =  Hash::make($request->password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function deleteTeacher($request){

        try {
            $id = $request->id;
            Teacher::findOrFail($id)->delete();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

}
