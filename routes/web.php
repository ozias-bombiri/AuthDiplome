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

Auth::routes();

  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', App\Http\Controllers\Backend\UserController::class);
    Route::resource('products', ProductController::class);
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

Route::group(['middleware' => ['auth', 'role:direction|admin']], function() {
    Route::get('etablissement/parcours', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listParcours'])
    ->name('metiers.etablissements.parcours-list');
    Route::get('etablissement/parcours/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addParcours'])
    ->name('metiers.etablissements.parcours-add');
    Route::post('etablissement/parcours/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeParcours'])
    ->name('metiers.etablissements.parcours-store');

    Route::get('etablissement/attestations', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listAttestation'])
    ->name('metiers.etablissements.attestations-list');
    Route::get('etablissement/attestations/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addAttestation'])
    ->name('metiers.etablissements.attestation-add');
    Route::post('etablissement/attestations/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeAttestation'])
    ->name('metiers.etablissements.attestation-store');

    Route::get('etablissement/etudiants', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listEtudiants'])
    ->name('metiers.etablissements.etudiant-list');
    Route::get('etablissement/etudiants/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addEtudiant'])
    ->name('metiers.etablissements.etudiant-add');
    Route::post('etablissement/etudiants/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeEtudiant'])
    ->name('metiers.etablissements.etudiant-store');

    Route::get('etablissement/{institution_id}/signataires', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'listSignataires'])
    ->name('metiers.etablissements.signataire-list');
    Route::get('etablissement/signataires/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'addSignataire'])
    ->name('metiers.etablissements.signataire-add');
    Route::post('etablissement/signataires/add', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'storeSignataire'])
    ->name('metiers.etablissements.signataire-store');
    
    
});

