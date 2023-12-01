@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush


@section('page-title')
Ajouter une attestation
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
            <h3 class="box-title">Ajouter une attestation provisoire</h3>
            <div class="col-4 offset-8 mb-5">
                <button id="add" class="btn btn-success"> Ajouter</button>
                <button id="upload" class="btn btn-success"> Importer</button>
                <input type="hidden" id="institution" value="{{ $institution->id }}" />
            </div>

            <div>
                <form method="post" action="{{ route('metiers.etablissements.attestation-store') }}">
                    @csrf
                    <fieldset class="border border-secondary px-4 py-3 my-2">
                        <legend> Informations impétrant</legend>
                        <input type="hidden"  id="idi" value="{{ $etudiant->id }}" name="impetrant_id">
                        <input type="hidden"  id="idp" value="{{ $parcou->id }}" name="parcours_id">
                        <div class="form-group row py-2">
                            <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="identifiant" value="{{ $etudiant->identifiant }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom Prénom(s)</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom. ' '.$etudiant->prenom }}" disabled>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary px-4 py-4 my-2">
                        <legend>Information résultats académiques</legend>
                        <div class="form-group row py-2">
                            <label for="annee" class="col-sm-2 col-form-label">Année académique</label>
                            <div class="col">
                                <select class="form-control" id="annee2" name="annee_id" required>
                                    <option value="" selected hidden disabled>Choisir </option>
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee->id }}">{{ $annee->intitule }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                            <div class="col">
                            <input type="text" class="form-control form-control" id="parcours" name="parcours_id" value="{{ $parcou->intitule }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="sexe" class="col-sm-2 col-form-label">Session </label>
                            <div class="col">
                                <select class="form-control" id="sessionr" name="sessionr" required>
                                    <option value="" selected hidden disabled>Choisir </option>
                                    <option value="Normale">Normale </option>
                                    <option value="Rattrapage">Rattrapage </option>
                                    <option value="Spéciale">Spéciale </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de soutenance</label>
                            <div class="col">
                                <input type="date" min="2023-10-3" class="form-control form-control" id="dateSoutenance" name="dateSoutenance" placeholder="Date de soutenance" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieuNaissance" class="col-sm-2 col-form-label">Moyenne</label>
                            <div class="col">
                                <input type="number" min="0.0" max="20.0" step="0.10" class="form-control form-control" id="moyenne" name="moyenne" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="cote" class="col-sm-2 col-form-label">Côte</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="cote" name="cote" placeholder="cote" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary px-4 py-4 my-2">
                        <legend>Informations signature</legend>
                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Signataire</label>
                            <div class="col">
                                <select class="form-control" id="signataire2" name="signataire" required>
                                    <option value="" selected hidden disabled>Choisir </option>
                                    @foreach($signataires as $signataire)
                                        <option value="{{ $signataire->id}}">{{ $signataire->nom.' '.$signataire->prenom }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="dateSignature" class="col-sm-2 col-form-label">Date de signature</label>
                            <div class="col">
                                <input type="date" min="now()" class="form-control form-control" id="dateSignature" name="dateSignature" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieu" class="col-sm-2 col-form-label">Lieu</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="lieu" name="lieuCreation" required>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
    <!-- Modal ajouter parcours-->
    <div class="row my-3">

        <div class="modal fade" id="exampleModal1" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel1">Informations étudiants</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>
    </div>


    @endsection
    @push('costum-scripts')

    <!-- SCRIPT FOR DATATABLE-->
    <script type="module" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="module" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script type="module">
        $(document).ready(function() {
            $('#data').DataTable();
        });
    </script>

    <script type="module">
        $(document).ready(function() {
            //Formulaire d'ajout d'étudiant
            $(document).on('click', '#add', function() {
                var myModal = new bootstrap.Modal($("#exampleModal1"), {});
                myModal.show();

            });
        });
    </script>
    @endpush