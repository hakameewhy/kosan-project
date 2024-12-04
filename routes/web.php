<?php

use App\Http\Controllers\RoomsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;


//Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Login Routes
Route::post('owner/login', [LoginController::class, 'ownerLogin'])->name('owner.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

// // Logout Route
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Register Member
Route::get('/register/member', [RegisterController::class, 'showMemberRegisterForm'])->name('register.member');
Route::post('/register/member', [RegisterController::class, 'registerMember'])->name('register.store');

// Rute untuk Admin (menggunakan middleware 'checkrole:admin')
Route::get('/home/admin', function () {
    return view('home-admin.index');  // Menampilkan home-admin/index.blade.php
})->name('home.admin')->middleware('auth');

// Rute untuk Member (menggunakan middleware 'checkrole:member')
Route::get('/home/member', function () {
    return view('home-member.index');  // Menampilkan home-member/index.blade.php
})->name('home.member')->middleware('auth');


Route::post('/profile/save', [UserProfileController::class, 'store'])->name('profile.save');
Route::middleware(['auth'])->group(function () {
    // Route untuk menyimpan profil (termasuk update dan insert)
    Route::post('/profile/save', [UserProfileController::class, 'store'])->name('profile.save');
});
Route::delete('/profile/delete-picture', [UserProfileController::class, 'deletePicture'])->name('profile.deletePicture');

//tombol-tombol pada rooms
Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms.store');

Route::get('/home/admin', [HomeController::class, 'index']);
