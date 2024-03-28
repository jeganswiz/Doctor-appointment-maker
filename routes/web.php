<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;

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

// Admin panel login routes
Route::get('/adminlogin', [AdminController::class, 'adminlogin'])->name('adminlogin')->middleware('AlreadyLoggedIn');
Route::post('/authenticate_admin', [AdminController::class, 'authenticate_admin'])->name('authenticate_admin')->middleware('AlreadyLoggedIn');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Admin panel landing routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('isLogged');
Route::get('/admin/confirmlist', [AdminController::class, 'confirmlist'])->name('confirmlist')->middleware('isLogged');
Route::get('/admin/approvelist', [AdminController::class, 'approvelist'])->name('approvelist')->middleware('isLogged');
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('isLogged');
Route::get('/admin/upcoming_appointment', [AdminController::class, 'upcoming_appointment'])->name('upcoming_appointment')->middleware('isLogged');
Route::get('/admin/completed_appointment', [AdminController::class, 'completed_appointment'])->name('completed_appointment')->middleware('isLogged');
Route::post('/add_enquiry_optional_dates', [AdminController::class, 'add_enquiry_optional_dates'])->name('add_enquiry_optional_dates');
Route::get('/admin/settings', [AdminController::class, 'adminsettings_page'])->name('settings')->middleware('isLogged');
Route::post('/admin/update_settings', [AdminController::class, 'update_settings'])->name('update_settings')->middleware('isLogged');
Route::post('/update_status', [AdminController::class, 'update_status'])->name('update_status')->middleware('isLogged');
Route::post('/add_notes', [AdminController::class, 'add_notes'])->name('add_notes')->middleware('isLogged');
Route::post('/save_notes', [AdminController::class, 'save_notes'])->name('save_notes')->middleware('isLogged');
Route::get('/admin/view_enquiry/{id}', [AdminController::class, 'view_enquiry'])->name('view_enquiry')->middleware('isLogged');


// Fronted routes
Route::get('/', [PatientController::class, 'index'])->name('patient_landing');
Route::post('/add_enquiry', [PatientController::class, 'add_enquiry'])->name('add_enquiry');
Route::get('/confirm_appointment/{id}', [PatientController::class, 'confirm_appointment'])->name('confirm_appointment');
Route::get('/stripe_payment_updated/{id}', [PatientController::class, 'stripe_payment_updated'])->name('stripe_payment_updated');
Route::post('/get_stripe_payment_url', [PatientController::class, 'get_stripe_payment_url'])->name('get_stripe_payment_url');
Route::post('/paystatusrazor', [PatientController::class, 'paystatusrazor'])->name('paystatusrazor');
Route::post('/update_razor_payment', [PatientController::class, 'update_razor_payment'])->name('update_razor_payment');