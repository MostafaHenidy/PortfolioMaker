<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
    'as' => 'dashboard.'
], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard');
        Route::patch('/dashboard/update', 'updateUserInfo')->name('update');
        Route::post('/dashboard/skills/store', 'storeSkills')->name('skills.store');
        Route::patch('/dashboard/skills/{id}/update' ,'updateSkill')->name('skills.update');
        Route::post('/dashboard/projects/store', 'storeProjects')->name('projects.store');
        Route::patch('/dashboard/project/{id}/update' ,'updateProject')->name('project.update');
        Route::get('/dashboard/protfolio', 'portfolio')->name('portfolio');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
