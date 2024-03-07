<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SponsorController;

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

//InsurersController
Route::get('/insurers', [InsurerController::class, 'index'])->name('admin.insurers');
Route::get('/insurers/{id}', [InsurerController::class, 'show'])->name('admin.insurerShow');
Route::post('/insurers/{id}', [InsurerController::class, 'update'])->name('admin.insurerUpdate');
Route::get('/insurerAdd', [InsurerController::class, 'showAdd'])->name('admin.insurerShowAdd');
Route::post('/insurerAdd', [InsurerController::class, 'add'])->name('admin.insurerAdd');
Route::get('/insurers/{id}/change', [InsurerController::class, 'change'])->name('admin.insurerChange');

//CoursesController
Route::get('/adminHome', [CourseController::class, 'index'])->name('admin.home');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('admin.courseShow');
Route::post('/courses/{id}', [CourseController::class, 'update'])->name('admin.courseUpdate');
Route::get('/courseAdd', [CourseController::class, 'showAdd'])->name('admin.courseShowAdd');
Route::post('/courseAdd', [CourseController::class, 'add'])->name('admin.courseAdd');
Route::get('/courses/{id}/change', [CourseController::class, 'change'])->name('admin.courseChange');

//SponsorController
Route::get('/sponsors', [SponsorController::class, 'index'])->name('admin.sponsors');
Route::get('/sponsors/{id}', [SponsorController::class, 'show'])->name('admin.sponsorShow');
Route::post('/sponsors/{id}', [SponsorController::class, 'update'])->name('admin.sponsorUpdate');
Route::get('/sponsorAdd', [SponsorController::class, 'showAdd'])->name('admin.sponsorShowAdd');
Route::post('/sponsorAdd', [SponsorController::class, 'add'])->name('admin.sponsorAdd');
Route::get('/sponsor/{id}/change', [SponsorController::class, 'change'])->name('admin.sponsorChange');