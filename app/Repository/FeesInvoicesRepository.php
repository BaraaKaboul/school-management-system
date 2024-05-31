<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{
    public function index()
    {
        $Fee_invoices = FeeInvoice::all();
        $Grades = Grade::all();
        return view('pages.fees_invoices.index',compact('Fee_invoices','Grades'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::all();
        return view('pages.fees_invoices.add',compact('student','fees'));
    }

    public function store($request){

        $List_Fees = $request->List_Fees;
        DB::beginTransaction();
        try {
            foreach ($List_Fees as $lf)
            {
                $fee_inv = new FeeInvoice();
                $fee_inv->invoice_date = date('Y-m-d');
                $fee_inv->student_id = $lf['student_id'];
                $fee_inv->Grade_id = $request->Grade_id;
                $fee_inv->Classroom_id = $request->Classroom_id;
                $fee_inv->fee_id = $lf['fee_id'];
                $fee_inv->amount = $lf['amount'];
                $fee_inv->description = $lf['description'];
                $fee_inv->save();


                $stu_acc = new StudentAccount();
                $stu_acc->date = date('Y-m-d');
                $stu_acc->type = 'invoice';
                $stu_acc->fee_invoice_id = $fee_inv->id;
                $stu_acc->student_id = $lf['student_id'];
                $stu_acc->Debit = $lf['amount'];
                $stu_acc->credit = 0.00;
                $stu_acc->description = $lf['description'];
                $stu_acc->save();
            }
            DB::commit();
            toastr()->success(trans('fee_trans.success'));
            return to_route('fees-invoices.index');
        }

        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function edit($id){

        $fee_invoices = FeeInvoice::findOrFail($id);
        $fees = Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }

    public function update($request){

        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = FeeInvoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();

            DB::commit();

            toastr()->success(trans('fee_trans.edit'));
            return redirect()->route('fees-invoices.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request){

        try {
            FeeInvoice::where('id',$request->id)->delete();

            toastr()->success(trans('fee_trans.delete'));
            return redirect()->route('fees-invoices.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
