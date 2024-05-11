<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\SuperviseurController;
use App\Http\Controllers\CoordinateurController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';








Route::prefix('admin')->group(function () {
    Route::get('/creercoordinateur', [AdminController::class, 'creercoordinateur']);
    Route::get('/creerequipe', [AdminController::class, 'creerequipe']);
});

Route::prefix('coordinateur')->group(function () {
    Route::get('/creeroperateur', [CoordinateurController::class, 'creeroperateur']);
    Route::get('/creersuperviseur', [CoordinateurController::class, 'creersuperviseur']);
});

Route::prefix('operateur')->group(function () {
    Route::get('/creerreclamation', [OperateurController::class, 'creerreclamation']);
});

Route::prefix('superviseur')->group(function () {
    Route::get('/traiterreclamation', [SuperviseurController::class, 'traiterreclamation']);
});










Route::get('/creerequipe', function () {
    return view('admin/creerequipe');
});

Route::get('/creercoordinateur', function () {
    return view('admin/creercoordinateur');
});

Route::get('/creeroperateur', function () {
    return view('coordinateur/creeroperateur');
});

Route::get('/creersuperviseur', function () {
    return view('coordinateur/creersuperviseur');
});

Route::get('/creerreclamation', function () {
    return view('operateur/creerreclamation');
});

Route::get('/traitereclamation', function () {
    return view('superviseur/traitereclamation');
});
