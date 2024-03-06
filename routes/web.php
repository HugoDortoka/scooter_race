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

Route::get('/adminHome', [AdministratorController::class, 'home'])->name('admin.home');

//InsurersController
Route::get('/insurers', [InsurerController::class, 'index'])->name('admin.insurers');
