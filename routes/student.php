<?php

//--------------------- Student Route -----------------------


use App\Http\Controllers\Students\dashboard\ExamController;
use App\Http\Controllers\Students\dashboard\ProfileController;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student' ]
    ], function() { //...

        Route::get('student/dashboard', function (){

            return view('pages.students.dashboard');
        });

        Route::resource('student-exam',ExamController::class);
    Livewire::setUpdateRoute(function ($handle) {
        $localePrefix = \Config::get('app.locale_prefix');
        return Route::post("/{$localePrefix}/livewire/update", $handle);
    });


    Route::get('user-profile',[ProfileController::class,'index'])->name('profile.user');
    Route::put('user-profile/{id}',[ProfileController::class,'update'])->name('profile.user.update');

    });
