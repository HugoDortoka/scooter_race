<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\CourseController;
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

Route::get('/', function () {
    return view('welcome');
});

//AdministradorController
Route::get('/adminLogin', [AdministratorController::class, 'login'])->name('admin.login');

Route::post('/adminLogin', [AdministratorController::class, 'checkLogin'])->name('admin.checkLogin');

Route::get('/adminLogout', [AdministratorController::class, 'logout'])->name('admin.logout');

Route::get('/adminHome', [AdministratorController::class, 'home'])->name('admin.home');

//InsurersController
Route::get('/insurers', [InsurerController::class, 'index'])->name('admin.insurers');
Route::get('/insurers/{id}', [InsurerController::class, 'show'])->name('admin.insurerShow');
Route::post('/insurers/{id}', [InsurerController::class, 'update'])->name('admin.insurerUpdate');
Route::get('/insurerAdd', [InsurerController::class, 'showAdd'])->name('admin.insurerShowAdd');
Route::post('/insurerAdd', [InsurerController::class, 'add'])->name('admin.insurerAdd');
Route::get('/insurers/{id}/change', [InsurerController::class, 'change'])->name('admin.insurerChange');

//CoursesController
Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('admin.courseShow');
Route::post('/courses/{id}', [CourseController::class, 'update'])->name('admin.courseUpdate');
Route::get('/courseAdd', [CourseController::class, 'showAdd'])->name('admin.courseShowAdd');
Route::post('/courseAdd', [CourseController::class, 'add'])->name('admin.courseAdd');
Route::get('/courses/{id}/change', [CourseController::class, 'change'])->name('admin.courseChange');