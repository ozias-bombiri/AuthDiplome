<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('annee_academiques', App\Http\Controllers\Backend\AnneeAcademiqueController::class);
Route::resource('niveau_etudes', App\Http\Controllers\Backend\NiveauEtudeController::class);
Route::resource('etablissements', App\Http\Controllers\Backend\EtablissementController::class);
Route::resource('diplomes', App\Http\Controllers\Backend\DiplomeController::class);
Route::resource('attestation_provisoires', App\Http\Controllers\Backend\AttestationProvisoireController::class);
Route::resource('attestation_definitives', App\Http\Controllers\Backend\AttestationDefinitiveController::class);
Route::resource('demande_authentifications', App\Http\Controllers\Backend\DemandeAuthentificationController::class);
Route::resource('documents', App\Http\Controllers\Backend\DocumentController::class);
Route::resource('etudiants', App\Http\Controllers\Backend\EtudiantController::class);
Route::resource('parcours', App\Http\Controllers\Backend\ParcoursController::class);
Route::resource('resultat_academiques', App\Http\Controllers\Backend\ResultatAcademiqueController::class);
Route::resource('signataire_etablissements', App\Http\Controllers\Backend\SignataireEtablissementController::class);
Route::resource('signataire_iesrs', App\Http\Controllers\Backend\SignataireIesrController::class);
Route::resource('timbre_iesrs', App\Http\Controllers\Backend\TimbreIesrController::class);
Route::resource('timbre_etablissements', App\Http\Controllers\Backend\TimbreEtablissementController::class);
Route::resource('users', App\Http\Controllers\Backend\UserController::class);




