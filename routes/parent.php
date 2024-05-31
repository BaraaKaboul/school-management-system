<?php

//--------------------- Parent Route -----------------------


use App\Http\Controllers\Parents\ChildrenController;
use App\Http\Controllers\Parents\ProfileController;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent' ]
    ], function() { //...

    Route::get('parent/dashboard', function (){

        $sons = \App\Models\Student::where('parent_id','=',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    });

    Route::get('children',[ChildrenController::class,'index'])->name('sons.index');
    Route::get('results/{id}', [ChildrenController::class,'results'])->name('sons.results');

    Route::get('attendances', [ChildrenController::class,'attendance'])->name('sons.attendance');
    Route::post('attendances',[ChildrenController::class,'attendanceSearch'])->name('sons.attendance.search');

    Route::get('fees', [ChildrenController::class,'fees'])->name('sons.fees');
    Route::get('receipt/{id}', [ChildrenController::class,'receiptStudent'])->name('sons.receipt');

    Route::get('profile/parent', [ProfileController::class,'profile'])->name('profile.show.parent');
    Route::post('profile/parent/{id}', [ProfileController::class,'update'])->name('profile.update.parent');



});
