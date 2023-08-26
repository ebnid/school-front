<?php

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    

    Route::view('/dashboard', 'admin.pages.dashboard')->name('dashboard');

    // Profile
    Route::view('/profile/profile', 'admin.pages.profile.profile')->name('profile.profile');
    Route::view('/profile/security', 'admin.pages.profile.security')->name('profile.security');
    Route::view('/profile/delete', 'admin.pages.profile.delete')->name('profile.delete');


    // Setting
    Route::view('/setting/organization', 'admin.pages.setting.organization')->name('setting.organization');
    Route::view('/setting/shift', 'admin.pages.setting.shift')->name('setting.shift');
    Route::view('/setting/designation', 'admin.pages.setting.designation')->name('setting.designation');
    Route::view('/setting/general', 'admin.pages.setting.general')->name('setting.general');

    // Employee
    Route::view('/employees/create', 'admin.pages.employee.create')->name('employee.create');
    Route::view('/employees/list', 'admin.pages.employee.list')->name('employee.list');

    // Attendace 
    Route::view('/attendences/give', 'admin.pages.attendence.give')->name('attendence.give');
    Route::view('/attendences/my-list', 'admin.pages.attendence.my-list')->name('attendence.my-list');
    Route::view('/attendences/all-list', 'admin.pages.attendence.all-list')->name('attendence.all-list');
    Route::view('/attendences/create', 'admin.pages.attendence.create')->name('attendence.create');
    Route::view('/attendences/leave/create', 'admin.pages.attendence.create-leave')->name('attendence.create-leave');
    Route::view('/attendences/leave/create-request-list', 'admin.pages.attendence.create-edit-leave-request-list')->name('attendence.create-edit-leave-request-list');
    Route::view('/attendences/leave/request-list', 'admin.pages.attendence.leave-request-list')->name('attendence.leave-request-list');
    Route::view('/attendences/overtimes/list', 'admin.pages.attendence.overtime-list')->name('attendence.overtime-list');


    // Salary
    Route::view('salaries/create', 'admin.pages.salary.create')->name('salary.create');
    Route::view('salaries/withdraw', 'admin.pages.salary.withdraw')->name('salary.withdraw');
    Route::view('salaries/history', 'admin.pages.salary.history')->name('salary.history');
    Route::view('salaries/withdraw-request-list', 'admin.pages.salary.withdraw-request-list')->name('salary.withdraw-request-list');
    Route::get('/salaries/details/{salary_id}', \App\Http\Controllers\SalaryDetail::class)->name('salary.single-details');
    
    


});


Route::get('/', function(){
    return redirect()->route('login');
});