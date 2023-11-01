<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Auth::routes(['register' => false,
//                 'password.request' =>false
//                 ]);

  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', App\Http\Controllers\Backend\UserController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('annee_academiques', App\Http\Controllers\Backend\AnneeAcademiqueController::class);
Route::resource('niveau_etudes', App\Http\Controllers\Backend\NiveauEtudeController::class);
Route::resource('institutions', App\Http\Controllers\Backend\InstitutionController::class);
Route::resource('diplomes', App\Http\Controllers\Backend\DiplomeController::class);
Route::resource('attestation_provisoires', App\Http\Controllers\Backend\AttestationProvisoireController::class);
Route::resource('attestation_definitives', App\Http\Controllers\Backend\AttestationDefinitiveController::class);
Route::resource('demande_authentifications', App\Http\Controllers\Backend\DemandeAuthentificationController::class);
Route::resource('documents', App\Http\Controllers\Backend\DocumentController::class);
Route::resource('impetrants', App\Http\Controllers\Backend\ImpetrantController::class);
Route::resource('parcours', App\Http\Controllers\Backend\ParcoursController::class);
Route::resource('resultat_academiques', App\Http\Controllers\Backend\ResultatAcademiqueController::class);
Route::resource('signataires', App\Http\Controllers\Backend\SignataireController::class);
Route::resource('timbres', App\Http\Controllers\Backend\TimbreController::class);
Route::resource('visas', App\Http\Controllers\Backend\VisaController::class);



// Route::resource('users', App\Http\Controllers\Backend\UserController::class);
// Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth', 'role:direction']], function() {
    Route::get('d/parcours/list/{institution_id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listParcours'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.parcours-list');
    Route::get('d/parcours/add/', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addParcours'])
    ->name('metiers.etablissements.parcours-add');
    Route::post('d/parcours/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeParcours'])
    ->name('metiers.etablissements.parcours-store');

    Route::get('d/provisoires/list/{institution_id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listAttestation'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.attestation-list');
    Route::get('d/provisoires/add/{institution_id}/{etudiant_id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addAttestation'])
    ->where('institution_id', '[0-9]+')->where('etudiant_id', '[0-9]+')->name('metiers.etablissements.attestation-add');
    Route::post('d/provisoires/store', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeAttestation'])
    ->name('metiers.etablissements.attestation-store');
    Route::get('d/provisoires/view/{id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'viewAttestation'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.attestation-view');
    Route::get('d/provisoires/pdf/{id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'pdfAttestation'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.attestation-pdf');
    Route::post('d/provisoires/filtre/', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'filtreAttestation'])
    ->name('metiers.etablissements.attestation-filtre');
   
    Route::get('d/impetrants/list/{institution_id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listEtudiants'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.etudiant-list');
    Route::get('d/impetrants/add/', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addEtudiant'])
    ->name('metiers.etablissements.etudiant-add');
    Route::post('d/impetrants/store', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeEtudiant'])
    ->name('metiers.etablissements.etudiant-store');

    Route::get('d/signataires/list/{institution_id}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listSignataires'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.signataire-list');
    Route::get('d/signataires/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addSignataire'])
    ->name('metiers.etablissements.signataire-add');
    Route::post('d/signataires/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeSignataire'])
    ->name('metiers.etablissements.signataire-store');
    
    
});

Route::group(['middleware' =>['auth', 'role:authentification']], function(){
    Route::get('/authentification/recherche', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'index'])
    ->name('metiers.auth.index');
    Route::post('/authentification/recherche', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'rechercher'])
    ->name('metiers.auth.recherche');
});

