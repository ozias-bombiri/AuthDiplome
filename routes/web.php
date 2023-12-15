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
Route::resource('numeroteurs', App\Http\Controllers\Backend\NumeroteurController::class);



// Route::resource('users', App\Http\Controllers\Backend\UserController::class);
// Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth', 'role:direction']], function() {

    Route::get('filieres/{institution_id}', [App\Http\Controllers\Etablissement\FiliereController::class, 'listFiliere'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.filiere-list');
    Route::get('filieres/create', [App\Http\Controllers\Etablissement\FiliereController::class, 'addFiliere'])
    ->name('metiers.etablissements.filiere-add');
    Route::post('filieres/create', [App\Http\Controllers\Etablissement\FiliereController::class, 'storeFiliere'])
    ->name('metiers.etablissements.filiere-store');
    
    Route::get('parcours/{institution_id}', [App\Http\Controllers\Etablissement\ParcoursController::class, 'listParcours'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.parcours-list');
    Route::get('parcours/create/', [App\Http\Controllers\Etablissement\ParcoursController::class, 'addParcours'])
    ->name('metiers.etablissements.parcours-add');
    Route::post('parcours/create', [App\Http\Controllers\Etablissement\ParcoursController::class, 'storeParcours'])
    ->name('metiers.etablissements.parcours-store');
    Route::get('parcours/view/{id}', [App\Http\Controllers\Etablissement\ParcoursController::class, 'viewParcours'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.parcours-view');

    Route::get('provisoires/{institution_id}', [App\Http\Controllers\Etablissement\AttestationController::class, 'listAttestation'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.attestation-list');
    Route::get('provisoires/create/{parcours}/{impetrant}', [App\Http\Controllers\Etablissement\AttestationController::class, 'addAttestation'])
    ->where('parcours', '[0-9]+')->where('impetrant', '[0-9]+')->name('metiers.etablissements.attestation-add');
    Route::post('provisoires/create', [App\Http\Controllers\Etablissement\AttestationController::class, 'storeAttestation'])
    ->name('metiers.etablissements.attestation-store');
    Route::get('provisoires/view/{id}', [App\Http\Controllers\Etablissement\AttestationController::class, 'viewAttestation'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.attestation-view');
    Route::get('provisoires/generate/{id}', [App\Http\Controllers\Etablissement\AttestationController::class, 'pdfAttestation'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.attestation-pdf');
    Route::post('provisoires/filtre/', [App\Http\Controllers\Etablissement\AttestationController::class, 'filtreAttestation'])
    ->name('metiers.etablissements.attestation-filtre');
    Route::get('provisoires/niveaux/{id}', [App\Http\Controllers\Etablissement\AttestationController::class, 'filtreNiveau'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.attestation-niveaux');
    
    Route::get('impetrants/{institution_id}', [App\Http\Controllers\Etablissement\ImpetrantController::class, 'listEtudiants'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.etudiant-list');
    Route::get('impetrants/create/{id}', [App\Http\Controllers\Etablissement\ImpetrantController::class, 'addEtudiant'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.etudiant-add');
    Route::post('impetrants/create', [App\Http\Controllers\Etablissement\ImpetrantController::class, 'storeEtudiant'])
    ->name('metiers.etablissements.etudiant-store');

    Route::get('signataires/{institution_id}', [App\Http\Controllers\Etablissement\SignataireController::class, 'listSignataires'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.signataire-list');
    Route::get('signataires/create', [App\Http\Controllers\Etablissement\SignataireController::class, 'addSignataire'])
    ->name('metiers.etablissements.signataire-add');
    Route::post('signataires/create', [App\Http\Controllers\Etablissement\SignataireController::class, 'storeSignataire'])
    ->name('metiers.etablissements.signataire-store');
    
    
});
//ROUTES FOR AUTHENTICATION PROFILE
Route::group(['middleware' =>['auth', 'role:authentification']], function(){
    Route::get('recherche', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'index'])
    ->name('metiers.auth.index');
    Route::post('recherche', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'rechercher'])
    ->name('metiers.auth.recherche');
    Route::get('/authentification/view/{categorie}/{id}', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'visualiser'])
    ->name('metiers.auth.visualiser');
    
});

//ROUTES FOR VERIFYING INFIRMATIONS
Route::get('authentification/details/{categorie}/{id}', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'detailsDocument'])
    ->name('metiers.auth.details');
    Route::get('authentification/pdf/{reference}', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'viewpdf'])
    ->name('metiers.auth.pdf');


//ROUTES FOR DAOI PROFILE
Route::group(['middleware' =>['auth', 'role:daoi']], function(){
    Route::get('etablissements/{institution_id}', [App\Http\Controllers\Daoi\EtablissementController::class, 'listEtablissement'])
    ->where('institution_id', '[0-9]+')->name('metiers.daoi.etablissement-list');
    Route::post('etablissements/create', [App\Http\Controllers\Daoi\EtablissementController::class, 'storeEtablissement'])
    ->name('metiers.daoi.etablissement-store');
    Route::get('etablissements/view/{id}', [App\Http\Controllers\Daoi\EtablissementController::class, 'viewEtablissement'])
    ->where('id', '[0-9]+')->name('metiers.daoi.etablissement-view');
    
    Route::get('etablissements/filieres/{id}', [App\Http\Controllers\Daoi\ParcoursController::class, 'listParcours'])
    ->where('id', '[0-9]+')->name('metiers.daoi.parcours-list');

    Route::get('parcours/filtre/{filiere}/{niveau}', [App\Http\Controllers\Daoi\ParcoursController::class, 'filtreParcours'])
    ->where('filiere', '[0-9]+')->where('niveau', '[0-9]+')->name('metiers.daoi.parcours-filtre');



    Route::post('definitives/filtre/', [App\Http\Controllers\Daoi\AttestationController::class, 'filtreAttestation'])
    ->name('metiers.daoi.attestation-filtre');
   

    Route::get('etablissements/signataires/{id}', [App\Http\Controllers\Daoi\SignataireController::class, 'listSignataire'])
    ->where('id', '[0-9]+')->name('metiers.daoi.signataires-list');
    

    Route::get('d/impetrantsattdef/list/{institution_id}', [App\Http\Controllers\Daoi\AttestationController::class, 'listEtudiantsAttDef'])
    ->where('institution_id', '[0-9]+')->name('metiers.daoi.etudiantattdef-list');
    Route::get('d/impetrantsattdef/create/', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'addEtudiant'])
    ->name('metiers.daoi.etudiantattdef-add');
    Route::post('d/impetrantsattdef/store', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'storeEtudiant'])
    ->name('metiers.daoi.etudiantattdef-store');

    Route::get('d/definitives/niveaux/{id}', [App\Http\Controllers\Daoi\AttestationController::class, 'filtreNiveau'])
    ->where('id', '[0-9]+')->name('metiers.daoi.attestation-niveaux');
    
    Route::get('d/definitives/list/{institution_id}', [App\Http\Controllers\Daoi\AttestationController::class, 'listAttestation'])
    ->where('institution_id', '[0-9]+')->name('metiers.daoi.attestationdef-list');
    Route::get('d/definitives/add/{institution_id}/{etudiant_id}', [App\Http\Controllers\Daoi\AttestationController::class, 'addAttestation'])
    ->where('institution_id', '[0-9]+')->where('etudiant_id', '[0-9]+')->name('metiers.daoi.attestationdef-add');
    Route::post('d/definitives/store', [App\Http\Controllers\Daoi\AttestationController::class, 'storeAttestation'])
    ->name('metiers.daoi.attestationdef-store');
    Route::get('d/definitives/view/{id}', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'viewAttestation'])
    ->where('id', '[0-9]+')->name('metiers.daoi.attestationdef-view');
    Route::get('d/definitives/pdf/{id}', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'pdfAttestation'])
    ->where('id', '[0-9]+')->name('metiers.daoi.attestationdef-pdf');
    Route::post('d/definitives/filtre/', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'filtreAttestation'])
    ->name('metiers.daoi.attestationdef-filtre');
    

});
