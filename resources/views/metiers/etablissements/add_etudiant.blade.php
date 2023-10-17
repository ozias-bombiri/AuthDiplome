@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un étudiant') }}</div>

            <div class="card-body">

                <div class="table-responsive">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('metiers.etablissements.etudiant-store') }}">
                        @csrf
<<<<<<< HEAD
=======
                        <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                        <div class="form-group row py-2">
                            <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="identifiant" name="identifiant" placeholder="Identifiant" required>
                            </div>
                        </div>
                       
                        <div class="form-group row py-2">
                            <label for="typeIdentifiant" class="col-sm-2 col-form-label">Type de l'identifiant </label>
                            <div class="col">
                                <select  class="form-control" id="typeIdentifiant" name="typeIdentifiant" required>
<<<<<<< HEAD
                                    <option value="" selected disabled hidden> Choisir un type d'identifiant</option>
=======
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                                    <option value="INE">INE</option>
                                    <option value="Matricule">Matricule</option>
                                    <option value="Autres">Autres</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="sexe" class="col-sm-2 col-form-label">Sexe </label>
                            <div class="col">
                                <select  class="form-control" id="typeIdentifiant" name="sexe" required>
<<<<<<< HEAD
                                    <option value="" selected disabled hidden> Choisir le sexe</option>
=======
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                                    <option value="Masculin">Masculin</option>
                                    <option value="Feminin">Féminin</option>
                                    
                                </select>
                            </div>
                        </div>



                        <div class="form-group row py-2">
                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                            <div class="col">
                                <input type="date" class="form-control form-control" id="dateNaissance" name="dateNaissance" placeholder="Date de naissance" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieuNaissance" class="col-sm-2 col-form-label">Lieu de naissance</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="lieuNaissance" name="lieuNaissance" placeholder="Lieu naissance" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="paysNaissance" class="col-sm-2 col-form-label">Pays de naissance</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="paysNaissance" name="paysNaissance" placeholder="Pays de naissance" required>
                            </div>
                        </div>
<<<<<<< HEAD
                        
=======
                        <div class="form-group row py-2">
                            <label for="reference" class="col-sm-2 col-form-label">Référence d'inscription</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="reference" name="reference"  required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="reference" class="col-sm-2 col-form-label">Année d'inscription</label>
                            <div class="col">
                                <input type="number" class="form-control form-control" id="annee" name="annee"  required>
                            </div>
                        </div>
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
<<<<<<< HEAD
                                <a href="{{ route('metiers.etablissements.etudiant-list') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
=======
                                <a href="{{ route('impetrants.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                            </div>

                        </div>
                   
                        
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('costum-scripts')

@endpush