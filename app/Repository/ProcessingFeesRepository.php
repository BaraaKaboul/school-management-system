<?php

namespace App\Repository;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface
{
    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.processingFees.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.processingFees.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findOrFail($id);
        return view('pages.processingFees.edit',compact('ProcessingFee'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
//            if ($request->Debit > $request->final_balance){
//                return redirect()->back()->with('error','الرقم المدخل اكبر من قيمة مجموع المبلغ للطالب');
//            }
            // حفظ البيانات في جدول processing_fees
            $ProcessingFee = new ProcessingFee();
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();


            // حفظ البيانات في جدول student_accounts
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'Processing Fee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('processing-fees.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProcessingFee::findOrFail($request->id);;
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'Processing Fee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();

            toastr()->info(trans('messages.Update'));
            return redirect()->route('processing-fees.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ProcessingFee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
