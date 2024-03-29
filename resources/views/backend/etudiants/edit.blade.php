@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un impétrant') }}
@endsection

@section('content')

<div class="row my-3">
    <div class="col-md-12 col-lg-12 col-sm-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">{{ __('Modifier un étudiant') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
            <form method="post" action="{{ route('etudiants.update', $etudiant->id) }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="typeIdentifiant" class="col-sm-2 col-form-label">Type de l'identifiant </label>
                            <div class="col">
                                <select  class="form-control" id="typeIdentifiant" name="typeIdentifiant" required>
                                    <option value="" selected disabled hidden>Choisir </option>
                                    <option value="INE">INE</option>
                                    <option value="Matricule">Matricule</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="identifiant" name="identifiant" placeholder="Identifiant" required>
                            </div>
                        </div>
                       
                        

                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{  $etudiant->nom }}" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{  $etudiant->prenom }}" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="sexe" class="col-sm-2 col-form-label">Sexe </label>
                            <div class="col">
                                <select  class="form-control" id="typeIdentifiant" name="sexe" required>
                                <option value="" selected disabled hidden>Choisir </option>
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
                                <input type="text" class="form-control form-control" id="lieuNaissance" name="lieuNaissance" value="{{  $etudiant->lieuNaissance }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="paysNaissance" class="col-sm-2 col-form-label">Pays de naissance</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="paysNaissance" name="paysNaissance" value="{{  $etudiant->paysNaissance }}" required>
                            </div>
                        </div>
                        
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('etudiants.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                            </div>

                        </div>
                   
                        
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')

@endpush

