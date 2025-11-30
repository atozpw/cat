<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PsikogramController;
use App\Http\Controllers\ScoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Participant Route

Route::get('/participants', [ParticipantController::class, 'index'])
    ->middleware('auth')
    ->name('participants.index');

Route::post('/participants', [ParticipantController::class, 'store'])
    ->middleware('auth')
    ->name('participants.store');

Route::get('/participants/{id}', [ParticipantController::class, 'edit'])
    ->middleware('auth')
    ->name('participants.edit');

Route::put('/participants/{id}', [ParticipantController::class, 'update'])
    ->middleware('auth')
    ->name('participants.update');

Route::delete('/participants/{id}', [ParticipantController::class, 'destroy'])
    ->middleware('auth')
    ->name('participants.destroy');

// Exam Route

Route::get('/exams', [ExamController::class, 'index'])
    ->middleware('auth')
    ->name('exams.index');

Route::post('/exams', [ExamController::class, 'store'])
    ->middleware('auth')
    ->name('exams.store');

Route::get('/exams/{id}', [ExamController::class, 'show'])
    ->middleware('auth')
    ->name('exams.show');

Route::post('/exams/update', [ExamController::class, 'update'])
    ->middleware('auth')
    ->name('exams.update');

Route::get('/exams/{id}/result', [ExamController::class, 'result'])
    ->middleware('auth')
    ->name('exams.result');

// Question Category Route

Route::get('/questioncategories', [QuestionCategoryController::class, 'index'])
    ->middleware('auth')
    ->name('questioncategories.index');

Route::post('/questioncategories', [QuestionCategoryController::class, 'store'])
    ->middleware('auth')
    ->name('questioncategories.store');

Route::get('/questioncategories/{id}/show', [QuestionCategoryController::class, 'show'])
    ->middleware('auth')
    ->name('questioncategories.show');

Route::get('/questioncategories/{id}', [QuestionCategoryController::class, 'edit'])
    ->middleware('auth')
    ->name('questioncategories.edit');

Route::put('/questioncategories/{id}', [QuestionCategoryController::class, 'update'])
    ->middleware('auth')
    ->name('questioncategories.update');

Route::delete('/questioncategories/{id}', [QuestionCategoryController::class, 'destroy'])
    ->middleware('auth')
    ->name('questioncategories.destroy');

Route::post('/questioncategories/get_answer_previous_question', [QuestionCategoryController::class, 'get_answer_previous_question'])
    ->middleware('auth')
    ->name('questioncategories.get_answer_previous_question');

// Question Route

Route::post('/questions', [QuestionController::class, 'store'])
    ->middleware('auth')
    ->name('questions.store');

Route::get('/questions/{id}', [QuestionController::class, 'edit'])
    ->middleware('auth')
    ->name('questions.edit');

Route::put('/questions/{id}', [QuestionController::class, 'update'])
    ->middleware('auth')
    ->name('questions.update');

Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])
    ->middleware('auth')
    ->name('questions.destroy');

Route::post('/questions/image_upload', [QuestionController::class, 'image_upload'])
    ->middleware('auth')
    ->name('upload');

Route::post('/questions/generate', [QuestionController::class, 'generate'])
    ->middleware('auth')
    ->name('questions.generate');

// Schedule Route

Route::get('/schedules', [ScheduleController::class, 'index'])
    ->middleware('auth')
    ->name('schedules.index');

Route::post('/schedules', [ScheduleController::class, 'store'])
    ->middleware('auth')
    ->name('schedules.store');

Route::get('/schedules/{id}', [ScheduleController::class, 'edit'])
    ->middleware('auth')
    ->name('schedules.edit');

Route::put('/schedules/{id}', [ScheduleController::class, 'update'])
    ->middleware('auth')
    ->name('schedules.update');

Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])
    ->middleware('auth')
    ->name('schedules.destroy');

// Report Route

Route::get('/reports', [ReportController::class, 'index'])
    ->middleware('auth')
    ->name('reports.index');

// Psikogram Route

Route::get('/psikograms', [PsikogramController::class, 'index'])
->middleware('auth')
->name('psikograms.index');

// Master Table Route

Route::get('/masters', [MasterController::class, 'index'])
->middleware('auth')
->name('masters.index');

// Score Route

Route::get('/scores', [ScoreController::class, 'index'])
->middleware('auth')
->name('scores.index');

// Result Route

Route::get('/results', [ResultController::class, 'index'])
    ->middleware('auth')
    ->name('results.index');
