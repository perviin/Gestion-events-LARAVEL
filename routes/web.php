<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\SettingsController;

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

Route::get('/register', [App\Http\Controllers\Auth\CustomRegisterController::class, 'showRegistrationForm'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [App\Http\Controllers\Auth\CustomRegisterController::class, 'register'])
    ->middleware('guest');


// Dashboard accessible aux utilisateurs authentifiés
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Routes pour la gestion des événements
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
    
    // Routes pour les participations
    Route::get('/participations', [ParticipationController::class, 'index'])->name('participations.index');
    Route::get('/events/{event}/participate', [ParticipationController::class, 'showParticipateForm'])->name('participations.form');
    Route::post('/events/{event}/participate', [ParticipationController::class, 'participate'])->name('participations.participate');
    Route::delete('/participations/{participation}', [ParticipationController::class, 'cancel'])->name('participations.cancel');
    Route::get('/events/{event}/participants', [ParticipationController::class, 'eventParticipants'])->name('participations.participants');
    
    // Routes pour les activités
    Route::resource('activities', ActivityController::class);
    Route::post('/activities/{activity}/register', [ActivityController::class, 'register'])->name('activities.register');
    Route::delete('/activities/{activity}/unregister', [ActivityController::class, 'unregister'])->name('activities.unregister');
});

// Routes pour la gestion du profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update-language', [SettingsController::class, 'updateLanguage'])->name('settings.updateLanguage');
    Route::get('/settings/download-data', [SettingsController::class, 'downloadData'])->name('settings.downloadData');
});

// Routes pour l'authentification via des réseaux sociaux
Route::get('/auth/redirect/facebook', [SocialiteController::class, 'redirectToFacebook'])
    ->name('login.facebook');
Route::get('/auth/callback/facebook', [SocialiteController::class, 'handleFacebookCallback']);

Route::get('/auth/redirect/google', [SocialiteController::class, 'redirectToGoogle'])
    ->name('login.google');
Route::get('/auth/callback/google', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/locations', [EventController::class, 'getLocations'])->name('locations.index');

require __DIR__.'/auth.php';