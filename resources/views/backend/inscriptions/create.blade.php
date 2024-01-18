@extends('layouts.ample')

@section('page-title')
{{ __('Inscrire une étudiant') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un étudiant') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('parcours.inscriptions.store', $parcours->id) }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="parcours" name="parcours_id" value="{{ $parcours->intitule.' | '.$parcours->filiere->intitule }}" required disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="anneeAcademiques" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <select class="form-control" id="parcour" name="anneeAcademique_id" required>
                                <option value="" selected disabled hidden>Choisir </option>
                                @foreach( $annees as $annee)
                                <option value="{{ $annee->id}}">{{ $annee->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group row py-2">
                            <label for="typeIdentifiant" class="col-sm-2 col-form-label">Type de l'identifiant </label>
                            <div class="col">
                                <select class="form-control" id="typeIdentifiant" name="typeIdentifiant" required>
                                    <option value="" selected disabled hidden>Choisir </option>
                                    <option value="INE">INE</option>
                                    <option value="Matricule">Matricule</option>
                                    <option value="Autres">Autres</option>
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
                                <select class="form-control" id="typeIdentifiant" name="sexe" required>
                                    <option value="" selected disabled hidden>Choisir </option>
                                    <option value="Masculin">Masculin</option>
                                    <option value="Feminin">Féminin</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                            <div class="col-sm-2">
                                Nevers ? <input type="checkbox" class="" id="nevers" name="nevers" value="1">
                            </div>
                            <div class="col-sm-5">
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

                    </div>

                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('parcours.inscriptions.index', $parcours->id) }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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