<?php

//--------------------- Teacher Route -----------------------


use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\ReceiptStudentController;
//use App\Http\Controllers\Teachers\dashboard\StudentController;
use App\Http\Controllers\Teachers\dashboard\ProfileController;
use App\Http\Controllers\Teachers\dashboard\QuestionController;
use App\Http\Controllers\Teachers\dashboard\QuizController;
use App\Http\Controllers\Teachers\dashboard\StudentController;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher' ]
    ], function() { //...

    Route::get('/teacher/dashboard', function (){

        $ids = \App\Models\Teacher::findOrFail(auth()->user()->id)->section()->pluck('section_id');
        $count_sections = $ids->count();
        $count_students = \App\Models\Student::whereIn('section_id',$ids)->get()->count();

        return view('pages.teachers.dashboard',compact('count_sections','count_students'));
    });



    Route::resource('students',StudentController::class);
    Route::get('sections',[StudentController::class,'section'])->name('sections');


    Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
    Route::put('update_attendance-student',[StudentController::class,'editAttendance'])->name('attendance-student.update');


    Route::get('attendance_report',[StudentController::class,'attendanceReport'])->name('attendance.report');
    Route::post('attendance_report',[StudentController::class,'attendanceSearch'])->name('attendance.search');


    Route::resource('quiz',QuizController::class);
//    Route::get('/Get_classrooms/{id}', [QuizController::class,'Get_Classrooms']);
//    Route::get('/Get_Sections/{id}', [QuizController::class,'Get_Sections']);     // هدول الراوتين لما يكونو شغالين في نفسن كمان راوتين بيشبهوهن بالweb.php فمعد يشتغلو عند الادمن,
                                                                                    // مشان هيك لازم نعمل route جديد نسميه ajax ونحط فيو راوتات الي الها علاقة بالajax


    Route::resource('questions',QuestionController::class);



    Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
    Route::put('profile/{id}',[ProfileController::class,'update'])->name('profile.update');



    Route::get('student_quizze/{id}',[QuizController::class,'student_quizze'])->name('student.quizze');
    Route::post('repeat_quizze', [QuizController::class,'repeat_quizze'])->name('repeat.quizze');


});
