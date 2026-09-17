<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
// first page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard and Teacher Routes (log we aethinam pene)
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/send-alert/{id}', [App\Http\Controllers\DashboardController::class, 'sendAlert'])->name('dashboard.sendAlert');

    // Teacher Routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    
    // Edit, Update, Destroy 
    Route::get('/teachers/{teacher_id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher_id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher_id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

});


// Students Index Route
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');


// Parent routes
Route::resource('parents', ParentController::class);
// Route for downloading the parent report as a PDF
Route::get('parents/{id}/report', [App\Http\Controllers\ParentController::class, 'downloadReport'])->name('parents.report');
// Route to send low attendance email alert
Route::post('parents/{id}/alert-email', [App\Http\Controllers\ParentController::class, 'sendAttendanceAlert'])->name('parents.alert-email');



//classes
Route::get('/classes', [App\Http\Controllers\SchoolClassController::class, 'index'])->name('classes.index');
Route::get('/classes/create', [App\Http\Controllers\SchoolClassController::class, 'create'])->name('classes.create');
Route::post('/classes', [App\Http\Controllers\SchoolClassController::class, 'store'])->name('classes.store');
Route::get('/classes/{id}/edit', [App\Http\Controllers\SchoolClassController::class, 'edit'])->name('classes.edit');
Route::put('/classes/{id}', [App\Http\Controllers\SchoolClassController::class, 'update'])->name('classes.update');
Route::delete('/classes/{id}', [App\Http\Controllers\SchoolClassController::class, 'destroy'])->name('classes.destroy');
    

// Subjects Routes
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [App\Http\Controllers\SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [App\Http\Controllers\SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{id}/edit', [App\Http\Controllers\SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'destroy'])->name('subjects.destroy');


//attendance
Route::get('/attendances/create', [App\Http\Controllers\AttendanceController::class, 'create'])->name('attendances.create');
Route::post('/attendances', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendances.store');
Route::get('/attendances', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendances.index');
Route::get('/attendances/{id}/edit', [App\Http\Controllers\AttendanceController::class, 'edit'])->name('attendances.edit');
Route::put('/attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'update'])->name('attendances.update');
Route::delete('/attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'destroy'])->name('attendances.destroy');


// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


// Marks Routes
Route::get('/marks', [App\Http\Controllers\MarkController::class, 'index'])->name('marks.index');
Route::get('/marks/create', [App\Http\Controllers\MarkController::class, 'create'])->name('marks.create');
Route::post('/marks', [App\Http\Controllers\MarkController::class, 'store'])->name('marks.store');
Route::get('/marks/{id}/edit', [App\Http\Controllers\MarkController::class, 'edit'])->name('marks.edit');
Route::put('/marks/{id}', [App\Http\Controllers\MarkController::class, 'update'])->name('marks.update');
Route::delete('/marks/{id}', [App\Http\Controllers\MarkController::class, 'destroy'])->name('marks.destroy');

});

// Authentication Routes
require __DIR__.'/auth.php';