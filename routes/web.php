<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\Access\UserController;
use App\Http\Controllers\Dashboard\Access\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

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
Route::get('/register', [ViewController::class, 'register'])->name('register');
Route::get('/office-of-rector', [ViewController::class, 'officeofrector'])->name('officeofrector');
Route::get('/research-innovation', [ViewController::class, 'researchinnovation'])->name('researchinnovation');
Route::get('/sign-in', [ViewController::class, 'signin'])->name('signin');
Route::get('/student', [ViewController::class, 'student'])->name('student');
Route::get('/profile', [ViewController::class, 'profile'])->name('profile');
Route::post('/student/profile/update', [ViewController::class, 'updateProfile'])->name('student.profile.update');
Route::post('/student/register', [ViewController::class, 'saveStudent']);
Route::post('/student/login', [ViewController::class, 'doLogin']);
Route::get('/student/logout', [ViewController::class, 'logout'])->name('student.logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// Guest-only admin login routes
Route::middleware('guest')->group(function () {
    Route::get('/admin', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// Admin logout (needs auth)
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth');

Route::get('/student/inquiry', [ViewController::class, 'studentInquiry'])->name('student.inquiry');
Route::post('/student/inquiry/store', [ViewController::class, 'studentInquiryStore'])->name('studentInquiry.store');
Route::get('/get-courses/{id}', [ViewController::class, 'getCourses'])
    ->name('courses.by.department');

Route::post('student/inquiryform', [ViewController::class, 'inquiresformStore'])->name('inquiryform.student.store');



/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES (ADMIN PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // ── Inquiries (inquiry.view required) ──
    Route::middleware('can:inquiry.view')->group(function () {
        Route::get('/inquiries', [DashboardController::class, 'inquires'])->name('inquires');
        Route::get('/inquiry/{inquiry}/show', [DashboardController::class, 'showInquiry'])->name('inquiry.show');
        Route::put('/inquiry/status/{id}', [DashboardController::class, 'updateStatus'])->name('inquiry.status.update');
        Route::get('/inquiry/{inquiry}/comments', [DashboardController::class, 'showComments'])->name('inquiry.comments');
        Route::post('/inquiry/{inquiry}/comments', [DashboardController::class, 'storeComment'])->name('inquiry.comments.store');
    });
    Route::middleware('can:inquiry.create')->group(function () {
        Route::get('/inquiry/create', [DashboardController::class, 'inquiresform'])->name('inquiryform');
        Route::post('/inquiry/create', [DashboardController::class, 'inquiresformStore'])->name('inquiryform.store');
    });
    Route::middleware('can:inquiry.edit')->group(function () {
        Route::get('/inquiry/{id}/edit', [DashboardController::class, 'edit'])->name('inquiry.edit');
        Route::put('/inquiry/{id}/update', [DashboardController::class, 'inquiresformUpdate'])->name('inquiry.update');
    });
    Route::delete('/inquiry/{id}/delete', [DashboardController::class, 'destroy'])->middleware('can:inquiry.delete')->name('inquiry.delete');

    // ── Faculty (faculty.view required) ──
    Route::middleware('can:faculty.view')->group(function () {
        Route::get('/faculty', [DashboardController::class, 'faculty'])->name('faculty');
        Route::get('/faculty/{faculty}/show', [DashboardController::class, 'showFacultyView'])->name('faculty.show');
        Route::get('/faculty/create', [DashboardController::class, 'facultyform'])->name('facultyform');
        Route::post('/faculty/create', [DashboardController::class, 'storeFaculty'])->name('facultyform.store');
        Route::get('/faculty/{faculty}/edit', [DashboardController::class, 'editFaculty'])->name('faculty.edit');
        Route::post('/faculty/{faculty}/update', [DashboardController::class, 'updateFaculty'])->name('faculty.update');
        Route::delete('/faculty/{faculty}/delete', [DashboardController::class, 'destroyFaculty'])->name('faculty.delete');
        Route::post('/faculty/{faculty}/assign-department', [DashboardController::class, 'assignDepartment'])->name('faculty.assign.department');
    });

    // ── Students (student.view required) ──
    Route::middleware('can:student.view')->group(function () {
        Route::get('/students', [DashboardController::class, 'student'])->name('admin.students');
        Route::get('/students/{student}/show', [DashboardController::class, 'showStudent'])->name('student.show');
        Route::get('/students/{student}/edit', [DashboardController::class, 'editStudent'])->name('student.edit');
        Route::post('/students/{student}/update', [DashboardController::class, 'updateStudent'])->name('student.update');
        Route::delete('/students/{student}/delete', [DashboardController::class, 'destroyStudent'])->name('student.delete');
    });

    // ── Departments & Courses (department.view required) ──
    Route::middleware('can:department.view')->group(function () {
        Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
        Route::post('/departments/{department}/courses', [DepartmentController::class, 'storeCourse'])->name('courses.store');
        Route::put('/courses/{course}', [DepartmentController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [DepartmentController::class, 'destroyCourse'])->name('courses.destroy');
    });

    // ── Access Control ──
    Route::middleware('can:user.view')->group(function () {
        Route::get('/access/users', [UserController::class, 'index'])->name('access.users.index');
        Route::get('/access/users/{user}/show', [UserController::class, 'show'])->name('access.users.show');
        Route::post('/access/users', [UserController::class, 'store'])->name('access.users.store');
        Route::get('/access/users/{user}/edit', [UserController::class, 'edit'])->name('access.users.edit');
        Route::put('/access/users/{user}', [UserController::class, 'update'])->name('access.users.update');
        Route::delete('/access/users/{user}', [UserController::class, 'destroy'])->name('access.users.destroy');
    });
    Route::middleware('can:role.view')->group(function () {
        Route::get('/access/roles', [RoleController::class, 'index'])->name('access.roles.index');
        Route::post('/access/roles', [RoleController::class, 'store'])->name('access.roles.store');
        Route::put('/access/roles/{role}', [RoleController::class, 'update'])->name('access.roles.update');
        Route::delete('/access/roles/{role}', [RoleController::class, 'destroy'])->name('access.roles.destroy');
    });

});
