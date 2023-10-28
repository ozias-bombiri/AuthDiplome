@extends('layout.ample')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter une attestation provisoire') }}</div>

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
                    <form method="post" action="{{ route('metiers.etablissements.attestation-store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="identifiant" name="identifiant" value="{{ $etudiant->identifiant }}" disabled>
                            </div>
                        </div>
                       
                        

                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom Prénom(s)</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}  {{ $etudiant->prenom }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Année académique</label>
                            <div class="col">
                                <select  class="form-control" id="annee" name="annee_id" required>
                                    <option value="" disabled>Choisir </option>
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee->id }}">{{ $annee->intitule }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Parcours</label>
                            <div class="col">
                                <select  class="form-control" id="parcours" name="parcours_id" required>
                                    <option value="" disabled>Choisir </option>
                                    @foreach($parcours as $par)
                                        <option value="{{ $par->id }}">{{ $par->intitule }} ({{ $par->niveau_etude->intitule }} )</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="sexe" class="col-sm-2 col-form-label">Session </label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="sessionr" name="sessionr" placeholder="Session" required>
                                 
                            </div>
                        </div>



                        <div class="form-group row py-2">
                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de soutenance</label>
                            <div class="col">
                                <input type="date" class="form-control form-control" id="dateSoutenance" name="dateSoutenance" placeholder="Date de soutenance" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieuNaissance" class="col-sm-2 col-form-label">Moyenne</label>
                            <div class="col">
                                <input type="number" step="0.01" class="form-control form-control" id="moyenne" name="moyenne"  required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="cote" class="col-sm-2 col-form-label">Côte</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="cote" name="cote" placeholder="cote" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Signataire</label>
                            <div class="col">
                                <select  class="form-control" id="signataire" name="signataire" required>
                                    <option value="" disabled>Choisir </option>
                                    @foreach($signataires as $signataire)
                                        <option value="{{ $signataire->id }}">{{ $signataire->nom }} {{ $signataire->prenom }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieu" class="col-sm-2 col-form-label">Lieu</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="lieu" name="lieuCreation" required>
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-control" id="impetrant" name="impetrant" value="{{ $etudiant->id }}">
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('impetrants.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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