@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush


@section('page-title')
Parcours de formation
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
            <h3 class="box-title">Impétrants</h3>
            <div class="col-4 offset-8 mb-5">
                <button id="add" class="btn btn-success"> Ajouter</button>
                <button id="upload" class="btn btn-success"> Importer</button>
                <input type="hidden" id="institution" value="{{ $institution->id }}" />
            </div>

            <div>
                <form method="post" action="{{ route('metiers.etablissements.etudiant-store') }}">
                    @csrf
                    <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row py-2">
                                <label for="typeIdentifiant" class="col-sm-2 col-form-label">Type de l'identifiant </label>
                                <div class="col">
                                    <select class="form-control" id="typeIdentifiant" name="typeIdentifiant" required>
                                        <option value="" selected disabled hidden>Choisir</option>
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
                                    <select class="form-control" id="sexe" name="sexe" required>
                                        <option value="" selected disabled hidden>Choisir</option>
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
                        <div class="col-6">
                            <div class="form-group row py-2">
                                <label for="parcours" class="col-sm-2 col-form-label">Parcours </label>
                                <div class="col">
                                    <input type="hidden" name="parcours_id" value="{{ $parcours->id}}"/>
                                    <input type="text"class="form-control form-control" disabled value="{{ $parcours->code.'-'.$parcours->intitule}}"/>
                                        
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="reference" class="col-sm-2 col-form-label">Référence d'inscription</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="reference" name="reference" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="reference" class="col-sm-2 col-form-label">Année d'inscription</label>
                                <div class="col">
                                    <input type="number" class="form-control form-control" id="annee" name="annee" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('impetrants.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                            </div>

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