<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/update-image', [RegisteredUserController::class, 'updateImage'])->name('user.updateImage');


    //^^Project
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/show/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{projectId}/files', [ProjectController::class, 'storeFile'])->name('projects.files.store');


    // ! Task
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

    // &Calendar
    Route::get('/calendar',[CalendarController::class, 'index'])->name('calendar.index');

    //*Invitation
    Route::post('/projects/{projectId}/send-invitations', [ProjectController::class, 'sendInvitations'])->name('projects.sendInvitations');
    Route::get('/projects/{projectId}/join', [ProjectController::class,'joinProject'])->name('projects.join');
    Route::get('/join-project/{token}', [ProjectMemberController::class, 'joinProjectByToken'])->name('join.project');


});

require __DIR__ . '/auth.php';
