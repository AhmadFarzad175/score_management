<?php

use App\Models\Attendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PdfController;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('/scores', ScoreController::class);
    Route::resource('/subjects', SubjectController::class);
    Route::resource('/attendances', AttendanceController::class);
    Route::resource('/classes', ClasssController::class);
    Route::resource('/students', StudentController::class);
    Route::get('/results', [ResultController::class, 'index']);
    Route::get('/classsProvince', [StudentController::class, 'classsProvince']);
    Route::get('/allSubjects', [SubjectController::class, 'subjects']);

    Route::post('/promote', [ResultController::class, 'promote']);
    Route::get('/export', [TeacherController::class, 'export']);
    Route::get('/parcha', [PdfController::class, 'generateParchaPdf']);
});


Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
