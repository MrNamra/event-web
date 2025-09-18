<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OurTeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index']);
// Route::get('/event', function(){
//     return view('events.index');
// });
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.register');
Route::post('/event_register_submit', [RegistrationController::class, 'event_register_submit'])->name('event.register.submit');
Route::get('view_participants/{id}', [EventController::class, 'view_participants'])->name('view.participants');
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
    Route::put('/event_store', [AdminEventController::class, 'store'])->name('admin.event.store');
    Route::delete('/event_delete/{id}', [AdminEventController::class, 'destroy'])->name('admin.event.delete');
    Route::get('/event/status/update/{id}', [AdminEventController::class, 'updateStatus'])->name('event.status.update');
    Route::get('/event/edit/{id}', [AdminEventController::class, 'update'])->name('event.update');

    // Route::resource('categories', AdminCategoryController::class);
    // Route::get('registrations/export/{event}', [AdminController::class, 'exportRegistrations']);
    // Route::post('events/{event}/toggle-registration', [AdminController::class, 'toggleRegistration']);
});

Route::group(['prefix' => '/admin', 'middleware' => 'auth:web'], function() {
    Route::get('/event_member', [OurTeamController::class, 'index'])->name('admin.event_member.index');
    Route::put('/event_member_store', [OurTeamController::class, 'store'])->name('admin.event_member.store');
    Route::get('/event_member_delete/{id}', [OurTeamController::class, 'destroy'])->name('admin.event_member.delete');
    Route::get('/event_member/status/update/{id}', [OurTeamController::class, 'updateStatus'])->name('event.status.update');
    Route::get('/event_member/edit/{id}', [OurTeamController::class, 'update'])->name('event_member.update');
});