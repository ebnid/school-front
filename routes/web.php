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

});


Route::get('/', function(){
    return view('front.pages.home');
});

// Static Page



Route::view('/notices/list', 'front.pages.notice')->name('notice-list');
Route::view('/information/list', 'front.pages.information-gallery')->name('information');
Route::view('/gallery', 'front.pages.gallery')->name('gallery');
Route::get('/{page_slug}', \App\Http\Controllers\CustomPageShowController::class)->name('page');
Route::get('/notice/{notice_slug}/{id}', \App\Http\Controllers\NoticeDetailsController::class)->name('notice');
