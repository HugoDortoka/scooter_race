<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\MembershipController;


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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [CourseController::class, 'home'])->name('user.home');
Route::get('/puzzle', [CourseController::class, 'puzzle'])->name('user.puzzle');

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
Route::get('/insurer/search', [InsurerController::class, 'search'])->name('admin.insurersSearch'); //Da error si tiene el mismo nombre que el primero (/insurers/search)

//CoursesController
//ADMIN
Route::get('/adminHome', [CourseController::class, 'index'])->name('admin.home');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('admin.courseShow');
Route::post('/courses/{id}', [CourseController::class, 'update'])->name('admin.courseUpdate');
Route::get('/courseAdd', [CourseController::class, 'showAdd'])->name('admin.courseShowAdd');
Route::post('/courseAdd', [CourseController::class, 'add'])->name('admin.courseAdd');
Route::get('/courses/{id}/change', [CourseController::class, 'change'])->name('admin.courseChange');
Route::get('/adminHome/search', [CourseController::class, 'search'])->name('admin.coursesSearch');
Route::get('/courses/{id}/uploadPhotos', [CourseController::class, 'uploadPhotos'])->name('admin.courseUploadPhotos');
Route::post('/courses/{id}/uploadPhotosTemporarily', [CourseController::class, 'saveUploadPhotosTemporarily'])->name('admin.courseSaveUploadPhotosTemporarily');
//USER
Route::get('/races', [CourseController::class, 'races'])->name('user.races');
Route::get('/allraces', [CourseController::class, 'allraces'])->name('user.allraces');
Route::get('/infoRace/{id}', [CourseController::class, 'infoRace'])->name('user.infoRace');
Route::post('/registered/{id}', [CourseController::class, 'register'])->name('user.register');
Route::get('/registered/{id}', [CourseController::class, 'register2'])->name('user.register2');
Route::post('/unregistered/{id}', [CourseController::class, 'register3'])->name('user.register3');


//SponsorController
//ADMIN
Route::get('/sponsors', [SponsorController::class, 'index'])->name('admin.sponsors');
Route::get('/sponsors/{id}', [SponsorController::class, 'show'])->name('admin.sponsorShow');
Route::get('/sponsors/printInvoice/{id}', [SponsorController::class, 'printInvoice'])->name('admin.printInvoice');
Route::post('/sponsors/{id}', [SponsorController::class, 'update'])->name('admin.sponsorUpdate');
Route::get('/sponsorAdd', [SponsorController::class, 'showAdd'])->name('admin.sponsorShowAdd');
Route::post('/sponsorAdd', [SponsorController::class, 'add'])->name('admin.sponsorAdd');
Route::get('/sponsor/{id}/change', [SponsorController::class, 'change'])->name('admin.sponsorChange');
Route::get('/sponsor/search', [SponsorController::class, 'search'])->name('admin.sponsorsSearch'); //Da error si tiene el mismo nombre que el primero (/sponsors/search)
//USER

//viewParticipants
Route::get('/participants/{courseId}', [RegistrationController::class, 'showParticipants'])->name('admin.showParticipants');
Route::get('/participants/{courseId}/pdf', [RegistrationController::class, 'pdf'])->name('admin.pdfParticipants');
Route::get('/participants/{courseId}/{competitorId}', [RegistrationController::class, 'pdfIndividual'])->name('admin.pdfParticipant');

//PhotoController
Route::post('/courses/{id}/addUploadPhotos', [PhotoController::class, 'addUploadPhotos'])->name('admin.courseSaveUploadPhotos');

//CompetitorController
//ADMIN
Route::get('/adminCompetitors', [CompetitorController::class, 'index'])->name('admin.competitors');
Route::get('/adminCompetitors/search', [CompetitorController::class, 'search'])->name('admin.competitorsSearch');
//USER
Route::get('/competitors', [CompetitorController::class, 'competitors'])->name('user.competitors');
Route::get('/profile', [CompetitorController::class, 'profile'])->name('user.profile');
Route::get('/login', [CompetitorController::class, 'login'])->name('user.login');
Route::post('/login', [CompetitorController::class, 'checkLogin'])->name('user.checkLogin');
Route::get('/registration', [CompetitorController::class, 'registration'])->name('user.registration');
Route::post('/registration', [CompetitorController::class, 'insertRegistration'])->name('user.insertRegistration');
Route::get('/logout', [CompetitorController::class, 'logout'])->name('user.logout');

//MembershipController
//USER
Route::get('/profile/membership/{id}', [MembershipController::class, 'new'])->name('user.newMembership');