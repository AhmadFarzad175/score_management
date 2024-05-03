<?php

use App\Models\Attendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NewStudentController;

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

Route::resource('/scores', ScoreController::class);
Route::resource('/subjects', SubjectController::class);
Route::resource('/attendances', AttendanceController::class);
Route::resource('/classes', ClasssController::class);
Route::resource('/students', StudentController::class);
Route::get('/classsProvince', [StudentController::class, 'classsProvince']);
// Route::resource('/newStudents', NewStudentController::class);


Route::get('/test', function () {
    return view('authentications.login');
});

// addEventListener in each button
// upddate method
// 