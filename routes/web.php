<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index']);
// Route::get('/event', function(){
//     return view('events.index');
// });
Route::get('/event/{id}', [EventController::class, 'show']);
Route::get('/404', function(){
    return view('404');
});
Route::get('/register/{event}', [RegistrationController::class, 'showForm']);
Route::post('/register/{event}', [RegistrationController::class, 'submit']);

// Admin (middleware: auth:admin)
Route::get('/admin/login',[Admincontroller::class, 'index'])->name('login');
Route::post('/admin/login',[Admincontroller::class, 'credCheck'])->name('admin.login');
Route::group(['prefix' => '/admin', 'middleware' => 'auth:web'], function() {
    Route::get('/dashbaord', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.event.index');

    // Route::resource('categories', AdminCategoryController::class);
    // Route::get('registrations/export/{event}', [AdminController::class, 'exportRegistrations']);
    // Route::post('events/{event}/toggle-registration', [AdminController::class, 'toggleRegistration']);
});