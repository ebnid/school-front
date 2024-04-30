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

    // Notice
    Route::view('notices/create', 'admin.pages.notices.create')->name('notices.create');

    // Caurosels
    Route::view('/caurosels', 'admin.pages.caurosels.create')->name('caurosels.create');

    // Menus
    Route::view('/menus', 'admin.pages.menus.create')->name('menus.create');

    // Guides
    Route::view('/guides', 'admin.pages.guides.create')->name('guides.create');

    // Custom Pages
    Route::view('/pages', 'admin.pages.custom-pages.create')->name('pages.create');

    // Footer
    Route::view('/footers', 'admin.pages.footers.create')->name('footers.create');

    // Admins
    Route::view('/admins', 'admin.pages.admins.list')->name('admins.list');

    // Social Links
    Route::view('/socials', 'admin.pages.socials.create')->name('socials.create');

    // Announcement
    Route::view('/announcement/create', 'admin.pages.announcement.create')->name('announcement.create');

    // Attendances
    Route::view('/attendances/import', 'admin.pages.attendances.import')->name('attendances.import');
    Route::view('/attendances/delete', 'admin.pages.attendances.delete-attendance')->name('attendances.delete');
    Route::view('/attendances/teachers', 'admin.pages.attendances.teachers')->name('attendances.teachers');
    Route::view('/attendances/summery', 'admin.pages.attendances.summary')->name('attendances.summary');
    Route::view('/attendances/summery/print/{year}/{month}', 'admin.pages.attendances.print-summary')->name('attendances.print-summary');
    Route::view('/attendances/summery/print/{name}/{year}/{month}', 'admin.pages.attendances.print-single-teacher-details')->name('attendances.print-single-teacher-details');

    // Teacher/Staff/Employee
    Route::view('/teacher-staffs/create', 'admin.pages.teachers-staffs.create')->name('teacher-staffs.create');
    Route::view('/teacher-staffs/list', 'admin.pages.teachers-staffs.list')->name('teacher-staffs.list');

    // Setting
    Route::view('/setting', 'admin.pages.setting.create')->name('setting');

});


Route::get('/', function(){
    return view('front.pages.home');
});

// Static Page

Route::view('/governing-body', 'front.pages.static.governing-body');
Route::view('/monitoring-board', 'front.pages.monitoring-board')->name('monitoring-baord');
Route::view('/teachers', 'front.pages.teachers')->name('teacher-list');
Route::view('/staffs', 'front.pages.staffs')->name('staff-list');
Route::get('/employee/details/{id}', \App\Http\Controllers\EmployeeDetailsController::class)->name('employee-details');

Route::view('/students', 'front.pages.student-list')->name('student-list');
Route::view('/notices/list', 'front.pages.notice')->name('notice-list');
Route::view('/information/list', 'front.pages.information-gallery')->name('information');
Route::view('/gallery', 'front.pages.gallery')->name('gallery');
Route::get('/{page_slug}', \App\Http\Controllers\CustomPageShowController::class)->name('page');
Route::get('/notice/{notice_slug}/{id}', \App\Http\Controllers\NoticeDetailsController::class)->name('notice');


Route::redirect('/register', '/');
