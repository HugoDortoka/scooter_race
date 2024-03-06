<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\InsurerController;
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
