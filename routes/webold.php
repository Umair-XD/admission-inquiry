<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;



Route::get('/', [ViewController::class, 'home'])->name('home');
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/academics', [ViewController::class, 'academics'])->name('academics');
Route::get('/admission', [ViewController::class, 'admission'])->name('admission');
Route::get('/alumni', [ViewController::class, 'alumni'])->name('alumni');
Route::get('/campus-life', [ViewController::class, 'campuslife'])->name('campuslife');
Route::get('/download', [ViewController::class, 'download'])->name('download');
Route::get('/home', [ViewController::class, 'home2'])->name('home2');
Route::get('/institute', [ViewController::class, 'institute'])->name('institute');
Route::get('/job', [ViewController::class, 'job'])->name('job');
Route::get('/login', [ViewController::class, 'login'])->name('login');
Route::get('/office-of-rector', [ViewController::class, 'officeofrector'])->name('officeofrector');
Route::get('/research-innovation', [ViewController::class, 'researchinnovation'])->name('researchinnovation');
Route::get('/sign-in', [ViewController::class, 'signin'])->name('signin');
Route::get('/student', [ViewController::class, 'student'])->name('student');
Route::get('/profile', [ViewController::class, 'profile'])->name('profile');


// Route::get('/dashboard/home', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/home', [DashboardController::class, 'dashboard'])->middleware('admin.auth')->name('dashboard');

 Route::get('/faculty', [DashboardController::class, 'faculty'])->name('faculty');
 Route::get('/facultyform', [DashboardController::class, 'facultyform'])->name('facultyform');
 Route::post('/facultyform', [DashboardController::class, 'storeFaculty'])->name('facultyform.store');
 Route::get('/inquires', [DashboardController::class, 'inquires'])->name('inquires');
 Route::get('/inquiryform', [DashboardController::class, 'inquiresform'])->name('inquiryform');
 Route::get('/student', [DashboardController::class, 'student'])->name('student');

//  Admin Routes


Route::get('/admin', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin.auth')->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
