<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradesController;
use App\Http\Controllers\Libraries\LibraryController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\FeeController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\GraduateController;
use App\Http\Controllers\Students\OnlineClassController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\ProcessingFeesController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Livewire\Calendar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('guest')->name('selection');

//Route::group(['namespace'=>'Auth'],function (){

    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');
    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::post('/logout/{type}',[LoginController::class,'logout'])->name('logout');
//});




//يعني ماحدا بيقدر يزور هاد الراوت غير ال guest يعني الزائر فقط, يلي مو عامل تسجيل دخول
//Route::middleware('guest')->group(function (){
//    Route::get('/', function()
//    {
//        return view('auth.login');
//    });
//});

//اي روابط جوات هاد الgroup رح يتم ترجمتو
//كمان رح يجيب اخر لغة حطا اليوزر بغض النظر عن اللغة اللي عندو
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function(){ //...

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
//    Route::view('/', 'livewire.calendar');
//    Livewire::component('calendar', Calendar::class);



    Route::resource('grade', GradesController::class);



    Route::resource('classroom', ClassroomController::class);
    Route::post('delete_class',[ClassroomController::class,'delete'])->name('class.delete');
    Route::post('delete-all-classes',[ClassroomController::class,'deleteAll'])->name('class.delete_all');
    Route::post('get-filtered-data',[ClassroomController::class,'filtiredClasses'])->name('class.filter');



    Route::resource('section', SectionController::class);
    //مربوطة بكود جافاسكربت مشان يجيب الصفوف بناءا على المراحل
    Route::get('classes/{id}', [SectionController::class,'getClasses']);



    //هاد مشان ال livewire
    Route::view('/add-parents','livewire.show_Form')->name('add-parents');

    //حطيت هاد الكود لأنو livewire 3 معد يدعم ميزة فهاد الكود بيمشي الحال فيها
        //وفائدة هاد الكود انو ينتقل ل form معلومات الأم, لأنو كان يطلعلي لما اكبس التالي من معلومات الاب بيطلع error 404
    Livewire::setUpdateRoute(function ($handle) {
        $localePrefix = \Config::get('app.locale_prefix');
        return Route::post("/{$localePrefix}/livewire/update", $handle);
    });



    Route::resource('teachers', TeacherController::class);



    Route::resource('students',StudentController::class);
    //هاد الراوت مربوط بكود ajax مشان يجيبل classroom بعد مايختار grade
                    // هدول الراوتين بيشتغلو باي view لانو مربوطين بشكل مباشر بالكود تبع جافاسكربت فمالازم ارجع اعيدن مشان اطبقن بمكان تاني
//    Route::get('Get_classrooms/{id}',[StudentController::class,'getClassroom']);
    //هاد الراوت مربوط بكود ajax مشان يجيبل section بعد مايختار classroom
//    Route::get('Get_Sections/{id}',[StudentController::class,'getSection']); // هدول الراوتين مشان مايصير تضارب مع الاستاذ او غير و حطيتن لحال وكل شي قدام الو علاقة بالajax رح يكون هناك يعني ارض محايدة
    Route::post('Upload_attachments', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');



    Route::resource('promotions',PromotionController::class);



    Route::resource('graduates',GraduateController::class);
    Route::post('graduate/student',[GraduateController::class,'graduateStudent'])->name('graduates.graduate_student');



    Route::resource('fees',FeeController::class);



    Route::resource('fees-invoices',FeeInvoiceController::class);



    Route::resource('receipt-student',ReceiptStudentController::class);



    Route::resource('processing-fees',ProcessingFeesController::class);



    Route::resource('payment-student',PaymentController::class);



    Route::resource('attendance',AttendanceController::class);



    Route::resource('subject',SubjectController::class);



    Route::resource('quiz',QuizzController::class);



    Route::resource('question',QuestionController::class);



    Route::resource('online-class',OnlineClassController::class);
    Route::get('/indirect',[OnlineClassController::class,'indirectCreate'])->name('indirect.create');
    Route::post('/indirect-store',[OnlineClassController::class,'indirectStore'])->name('indirect.store');



    Route::resource('library',LibraryController::class);
    Route::get('download/{filename}',[LibraryController::class,'download'])->name('library.download');



    Route::get('setting',[SettingController::class,'index']);
    Route::put('setting/update',[SettingController::class,'update'])->name('setting.update');

});






