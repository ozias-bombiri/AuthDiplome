<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Metiers\AttestationProvisoireController;
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
Route::resource('demande_authentifications', App\Http\Controllers\Backend\DemandeAuthentificationController::class);
Route::resource('documents', App\Http\Controllers\Backend\DocumentController::class);
//Route::resource('resultat_academiques', App\Http\Controllers\Backend\ResultatAcademiqueController::class);
//Route::resource('signataires', App\Http\Controllers\Backend\SignataireController::class);
Route::resource('timbres', App\Http\Controllers\Backend\TimbreController::class);
//Route::resource('visas', App\Http\Controllers\Backend\VisaController::class);
//Route::resource('parcours', App\Http\Controllers\Backend\ParcoursController::class);
Route::resource('etudiants', App\Http\Controllers\Backend\EtudiantController::class);

Route::resource('numeroteurs', App\Http\Controllers\Backend\NumeroteurController::class);
Route::resource('acte_academiques', App\Http\Controllers\Backend\ActeAcademiqueController::class);
Route::resource('categorie_actes', App\Http\Controllers\Backend\CategorieActeController::class);
Route::resource('ministeres', App\Http\Controllers\Backend\MinistereController::class);
Route::resource('proces_verbals', App\Http\Controllers\Backend\ProcesVerbalController::class);
Route::resource('retrait_actes', App\Http\Controllers\Backend\RetraitActeController::class);
Route::resource('signataire_actes', App\Http\Controllers\Backend\SignataireActeController::class);
Route::resource('visa_diplomes', App\Http\Controllers\Backend\VisaDiplomeController::class);
//Route::resource('visa_institutions', App\Http\Controllers\Backend\VisaInstitutionController::class);
//Route::resource('filieres', App\Http\Controllers\Backend\FiliereController::class);
//Route::resource('inscriptions', App\Http\Controllers\Backend\InscriptionController::class);

//ROUTES POUR LES VISAS DES DIPLOMES
Route::group(['middleware' => ['auth']], function(){
    Route::get('visas', [App\Http\Controllers\Backend\VisaController::class, 'index'])
    ->name('visas.index');
    Route::get('visas/add', [App\Http\Controllers\Backend\VisaController::class, 'create'])
    ->name('visas.create');
    Route::post('visas/add', [App\Http\Controllers\Backend\VisaController::class, 'store'])
    ->name('visas.store');
    Route::get('visas/{id}/edit', [App\Http\Controllers\Backend\VisaController::class, 'edit'])
    ->name('visas.edit');
    Route::post('visas/{id}/edit', [App\Http\Controllers\Backend\VisaController::class, 'update'])
    ->name('visas.update');
    Route::get('visas_diplomes', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'index'])
    ->name('visa_institutions.index');
    Route::get('visas_diplomes/add', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'create'])
    ->name('visa_institutions.create');
    Route::post('visas_diplomes/add', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'store'])
    ->name('visa_institutions.store');
    Route::get('visas_diplomes{id}', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'show'])
    ->name('visa_institutions.show');

    Route::get('visas_diplomes/{id}/configVisa', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'configVisas'])
    ->name('visa_institutions.configvisas');

    Route::post('visas_diplomes/configVisa', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'storeConfigVisas'])
    ->name('visa_institutions.storeconfigvisas');

    Route::get('visas_diplomes/{id}/edit', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'edit'])
    ->name('visa_institutions.edit');
    
    Route::delete('visas_diplomes/{id}/delete', [App\Http\Controllers\Backend\VisaInstitutionController::class, 'store'])
    ->name('visa_institutions.destroy');
    
});


//ROUTES POUR LES FILIERES ET LES PARCOURS DE FORMATIONS
Route::group(['middleware' => ['auth']], function(){
    Route::get('filieres/', [App\Http\Controllers\Backend\FiliereController::class, 'index'])
    ->name('filieres.index');
    Route::get('filieres/add', [App\Http\Controllers\Backend\FiliereController::class, 'create'])
    ->name('filieres.create');
    Route::post('filieres/add', [App\Http\Controllers\Backend\FiliereController::class, 'store'])
    ->name('filieres.store');
    Route::get('filieres/{id}/edit', [App\Http\Controllers\Backend\FiliereController::class, 'edit'])
    ->name('filieres.edit');
    Route::put('filieres/{id}/edit', [App\Http\Controllers\Backend\FiliereController::class, 'update'])
    ->name('filieres.update');
    Route::get('parcours/', [App\Http\Controllers\Backend\ParcoursController::class, 'index'])
    ->name('parcours.index');
    Route::get('parcours/add', [App\Http\Controllers\Backend\ParcoursController::class, 'create'])
    ->name('parcours.create');
    Route::post('parcours/add', [App\Http\Controllers\Backend\ParcoursController::class, 'store'])
    ->name('parcours.store');
    Route::get('parcours/{id}/edit', [App\Http\Controllers\Backend\ParcoursController::class, 'edit'])
    ->name('parcours.edit');
    Route::put('parcours/{id}/edit', [App\Http\Controllers\Backend\ParcoursController::class, 'update'])
    ->name('parcours.update');
    Route::delete('parcours/{id}/delete', [App\Http\Controllers\Backend\ParcoursController::class, 'destroy'])
    ->name('parcours.destroy');
    Route::get('parcours/{id}/inscriptions', [App\Http\Controllers\Backend\InscriptionController::class, 'index'])
    ->name('parcours.inscriptions.index');
    Route::get('parcours/{id}/inscriptions/add', [App\Http\Controllers\Backend\InscriptionController::class, 'create'])
    ->name('parcours.inscriptions.create');
    Route::post('parcours/{id}/inscriptions/add', [App\Http\Controllers\Backend\InscriptionController::class, 'store'])
    ->name('parcours.inscriptions.store');
    Route::delete('parcours/{id}/inscriptions/delete', [App\Http\Controllers\Backend\InscriptionController::class, 'destroy'])
    ->name('parcours.inscriptions.destroy');
    Route::get('parcours/inscriptions/{inscription}/show', [App\Http\Controllers\Backend\InscriptionController::class, 'show'])
    ->name('parcours.inscriptions.show');
    
});
// ROUTS POUR LA GESTION DES SIGNATAIRES
Route::group(['middleware' => ['auth']], function(){
    Route::get('signataires', [App\Http\Controllers\Backend\SignataireActeController::class, 'index'])
    ->name('signataires.index');
    Route::get('signataires/add1', [App\Http\Controllers\Backend\SignataireActeController::class, 'create1'])
    ->name('signataires.create1');    
    Route::post('signataires/add1', [App\Http\Controllers\Backend\SignataireActeController::class, 'store1'])
    ->name('signataires.store1');
    Route::get('signataires/add2', [App\Http\Controllers\Backend\SignataireActeController::class, 'create2'])
    ->name('signataires.create2');
    Route::delete('signataires/delete', [App\Http\Controllers\Backend\SignataireActeController::class, 'destroy'])
    ->name('signataires.destroy');
    Route::get('signataires/{id}/edit', [App\Http\Controllers\Backend\SignataireActeController::class, 'edit'])
    ->name('signataires.edit');
    Route::get('signataires/{id}/show', [App\Http\Controllers\Backend\SignataireActeController::class, 'show'])
    ->name('signataires.show');
    Route::post('signataires/{id}/edit', [App\Http\Controllers\Backend\SignataireActeController::class, 'update'])
    ->name('signataires.update');
});


//ROUTES POUR ATTESTATIONS PROVISOIRES
Route::group(['middleware' => ['auth']], function(){
    Route::get('actes/provisoires', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'index'])
    ->name('actes.provisoires.index');
    Route::get('actes/provisoires/{niveau}', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'index2'])
    ->name('actes.provisoires.niveaux');    
    
    
});

//ROUTES POUR LES ATTESTATION DEFINITIVES
Route::group(['middleware' => ['auth']], function(){
    Route::get('actes/definitives', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'index'])
    ->name('actes.definitives.index');
    Route::get('actes/definitives/{niveau}', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'index2'])
    ->name('actes.definitives.niveaux');
    
});

//ROUTES POUR LES DIPLOMES
Route::group(['middleware' => ['auth']], function(){
    Route::get('actes/diplomes', [App\Http\Controllers\Metiers\DiplomeController::class, 'index'])
    ->name('actes.diplomes.index'); 
    
});

//ROUTES POUR LES PROCES VERBAUX
Route::group(['middleware' => ['auth']], function(){
    Route::get('parcours/{parcours_id}/procesverbaux', [App\Http\Controllers\Backend\ProcesVerbalController::class, 'index2'])
    ->name('parcours.proces_verbaux.index');    
    Route::get('proces_verbaux', [App\Http\Controllers\Backend\ProcesVerbalController::class, 'index'])
    ->name('proces_verbaux.index'); 
    Route::get('proces_verbaux/create', [App\Http\Controllers\Backend\ProcesVerbalController::class, 'create'])
    ->name('proces_verbaux.create');
    
});


//ROUTES POUR LES RESULTATS ACADEMIQUES ET ACTES ACADEMIQUES
Route::group(['middleware' => ['auth']], function(){
    Route::get('proces_verbaux/{pv_id}/resultats', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'index'])
    ->name('proces_verbaux.resultats.index');
    Route::get('proces_verbaux/{pv_id}/resultats/add', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'create'])
    ->name('proces_verbaux.resultats.create');
    Route::get('proces_verbaux/{pv_id}/resultats/add2', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'create2'])
    ->name('proces_verbaux.resultats.create2');
    Route::get('proces_verbaux/{pv_id}/resultats/{res_id}/edit', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'edit'])
    ->name('proces_verbaux.resultats.edit');
    Route::put('proces_verbaux/{pv_id}/resultats/{res_id}/edit', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'update'])
    ->name('proces_verbaux.resultats.update');
    Route::delete('proces_verbaux/{pv_id}/resultats/{res_id}/delete', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'destroy'])
    ->name('proces_verbaux.resultats.destroy');    
    Route::get('resultats/{resultat_id}/provisoires/add', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'provisoire1'])
    ->name('proces_verbaux.provisoires.create');
    Route::get('proces_verbaux/{id}/provisoires/add2', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'provisoire2'])
    ->name('proces_verbaux.provisoires.create2');
    Route::post('proces_verbaux/provisoires/store', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'store2'])
    ->name('proces_verbaux.provisoires.store2');
    Route::post('proces_verbaux/{id}/resultats/add', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'store'])
    ->name('proces_verbaux.resultats.store'); 
    Route::post('proces_verbaux/{id}/resultats/add2', [App\Http\Controllers\Backend\ResultatAcademiqueController::class, 'store2'])
    ->name('proces_verbaux.resultats.store2');
    Route::get('resultats/{resultat_id}/definitives/add', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'definitive'])
    ->name('proces_verbaux.definitives.create');
    Route::get('proces_verbaux/{id}/definitives/add2', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'definitive2'])
    ->name('proces_verbaux.definitives.create2');
    Route::get('proces_verbaux/{id}/definitives/add_acte_solo/{ident}', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'definitiveSolo'])
    ->name('proces_verbaux.definitives.definitiveSolo');
    Route::post('proces_verbaux/definitives/store', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'store2'])
    ->name('proces_verbaux.definitives.store');
    Route::post('proces_verbaux/definitives/storeSolo', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'storeSolo'])
    ->name('proces_verbaux.definitives.storeSolo');
    Route::get('resultats/{resultat_id}/diplomes/add', [App\Http\Controllers\Backend\ActeAcademiqueController::class, 'diplome'])
    ->name('proces_verbaux.diplomes.create');
    
});

//ROUTES POUR LA GENERATION DES PDF
Route::group(['middleware' => ['auth']], function(){
    Route::get('actes/provisoires/{id}/generate', [App\Http\Controllers\Metiers\AttestationProvisoireController::class, 'generer'])
    ->where('id', '[0-9]+')->name('metiers.actes.provisoires.generer');
    Route::get('actes/definivites/{id}/generate', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'generer'])
    ->where('id', '[0-9]+')->name('metiers.actes.definitives.generer');  
    
});

//ROUTES POUR LES CONFIGURATIONS
Route::group(['middleware' => ['auth']], function(){
    Route::get('metiers/{institution}/config', [App\Http\Controllers\Metiers\ConfigurationController::class, 'index'])
    ->where('institution', '[0-9]+')->name('metiers.config.index');
    
});

//ROUTES POUR LES REMISE D'ACTES
Route::group(['middleware' => ['auth']], function(){
    Route::get('provisoires/retraits', [App\Http\Controllers\Backend\RetraitActeController::class, 'index1'])
    ->name('actes.provisoires.retrait');
    Route::get('provisoires/{acte_id}/retrait', [App\Http\Controllers\Backend\RetraitActeController::class, 'create'])
    ->name('actes.provisoires.retirer');
    Route::post('provisoires/{acte_id}/retrait', [App\Http\Controllers\Backend\RetraitActeController::class, 'store'])
    ->name('actes.provisoires.retirer.store');
    
    Route::get('actes/definitives/retrait', [App\Http\Controllers\Backend\RetraitActeController::class, 'index2'])
    ->name('actes.definitives.retrait');
    
});


/*
Route::group(['middleware' => ['auth', 'role:directeur']], function() {

    Route::get('filieres/{institution_id}', [App\Http\Controllers\Etablissement\FiliereController::class, 'listFiliere'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.filiere-list');
    Route::get('filieres/create', [App\Http\Controllers\Etablissement\FiliereController::class, 'addFiliere'])
    ->name('metiers.etablissements.filiere-add');
    Route::post('filieres/create', [App\Http\Controllers\Etablissement\FiliereController::class, 'storeFiliere'])
    ->name('metiers.etablissements.filiere-store');
    
    Route::get('parcours/{institution_id}', [App\Http\Controllers\Etablissement\ParcoursController::class, 'listParcours'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.parcours-list');
    Route::get('parcours/add/', [App\Http\Controllers\Etablissement\ParcoursController::class, 'addParcours'])
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
    
    Route::get('impetrants/{institution_id}', [App\Http\Controllers\Etablissement\EtudiantController::class, 'listEtudiants'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.etudiant-list');
    Route::get('impetrants/create/{id}', [App\Http\Controllers\Etablissement\EtudiantController::class, 'addEtudiant'])
    ->where('id', '[0-9]+')->name('metiers.etablissements.etudiant-add');
    Route::post('impetrants/create', [App\Http\Controllers\Etablissement\EtudiantController::class, 'storeEtudiant'])
    ->name('metiers.etablissements.etudiant-store');

    Route::get('signataires2/{institution_id}', [App\Http\Controllers\Etablissement\SignataireController::class, 'listSignataires'])
    ->where('institution_id', '[0-9]+')->name('metiers.etablissements.signataire-list');
    Route::get('signataires2/create', [App\Http\Controllers\Etablissement\SignataireController::class, 'addSignataire'])
    ->name('metiers.etablissements.signataire-add');
    Route::post('signataires2/create', [App\Http\Controllers\Etablissement\SignataireController::class, 'storeSignataire'])
    ->name('metiers.etablissements.signataire-store');
    
    
});

*/
//ROUTES FOR AUTHENTICATION
Route::group(['middleware' =>['auth']], function(){
    Route::get('recherche', [App\Http\Controllers\Metiers\Authentification\VerificationController::class, 'index'])
    ->name('authentification.provisoires.index');
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
//Route::group(['middleware' =>['auth', 'role:daoi']], function(){
Route::group(['middleware' =>['auth']], function(){
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
    
    Route::get('d/definitives/list', [App\Http\Controllers\Metiers\AttestationDefinitiveController::class, 'index'])
    //->where('institution_id', '[0-9]+')->name('metiers.daoi.attestationdef-list');
    ->name('metiers.daoi.attestationdef-list');
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

    Route::get('d/diplomes/list', [App\Http\Controllers\Metiers\DiplomeController::class, 'index'])
    //->where('institution_id', '[0-9]+')->name('metiers.daoi.attestationdef-list');
    ->name('metiers.daoi.diplomes-list');
    

});