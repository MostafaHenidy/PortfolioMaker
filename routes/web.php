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
        // Dashboard
        //User Info 
        Route::get('/dashboard', 'dashboard');
        Route::patch('/dashboard/update', 'updateUserInfo')->name('update');
        Route::patch('/dashboard/settings/update', 'updateUserSettings')->name('settings.update');
        //User Skills
        Route::post('/dashboard/skills/store', 'storeSkills')->name('skills.store');
        Route::patch('/dashboard/skills/{id}/update', 'updateSkill')->name('skills.update');
        Route::delete('/dashboard/skills/{id}/delete', 'deleteSkill')->name('skills.delete');
        // User Projects
        Route::post('/dashboard/projects/store', 'storeProjects')->name('projects.store');
        Route::patch('/dashboard/project/{id}/update', 'updateProject')->name('project.update');
        Route::delete('/dashboard/project/{id}/delete', 'deleteProject')->name('project.delete');
        // Protfolio
        Route::get('/dashboard/protfolio', 'myPortfolio')->name('myPortfolio');
        Route::get('/portfolio/{userName}', 'viewUserProtfolio')->name('viewUserProtfolio');
        Route::post('/portfolio/contact/{userName}', 'sendMessage')->name('contact.sendMessage');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
