@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Attestations provisoires
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
    <ul class="nav nav-tabs">
        @foreach($niveaux as $niveau)
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('metiers.etablissements.attestation-niveaux', $niveau->id) }}">{{ $niveau->intitule}}</a>
        </li>
        @endforeach
    </ul>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Filtres</h3>
            <div class="table">
                <form method="post" action="{{ route('metiers.etablissements.attestation-filtre') }}">
                    @csrf
                    <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">

                    <div class="row border border-secondary">

                        <div class="form-group col-4 py-2">
                            <label for="niveau" class="col-sm-10 col-form-label">Niveau </label>
                            <div class="col">
                                <select class="form-control" id="niveau" name="niveau" required>
                                    <option value="">Choisir</option>
                                    @foreach ($niveaux as $niveau)
                                    <option value="{{ $niveau->id}}">{{ $niveau->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-4 py-2">
                            <label for="parcours" class="col-sm-10 col-form-label">Parcours </label>
                            <div class="col">
                                <select class="form-control" id="parcours" name="parcours" required>
                                    <option value="">Choisir</option>
                                    @foreach ($parcours as $parc)
                                    <option value="{{ $parc->id}}">{{ $parc->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-4 py-2">
                            <label for="annee" class="col-sm-10 col-form-label">Année acedémique</label>
                            <div class="col">
                                <select class="form-control" id="annee" name="annee" required>
                                    <option value="">Choisir</option>
                                    @foreach ($annees as $annee)
                                    <option value="{{ $annee->id}}">{{ $annee->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <button id="filtre" type="submit" class="btn btn-success">Afficher</button>
                            </div>
                            <div class="col-sm-3">
                                <a class="btn btn-danger" href="{{ route('metiers.etablissements.attestation-list', $institution->id) }}"> Annuler filtre </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h3 class="box-title mb-4">Attestations Provisoires</h3>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Année</th>
                            <th>Référence</th>
                            <th>Intitule</th>
                            <th>Identifiant</th>
                            <th>Nom Prénom </th>
                            <th>Parcours (Niveau d'étude)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attestations as $attestation)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td> {{ $attestation->resultatAcademique->procesVerbal->anneeAcademique->intitule }}</td>
                            <td>{{ $attestation->reference }}</td>
                            <td>{{ $attestation->intitule }}</td>
                            <td>{{ $attestation->resultatAcademique->inscription->etudiant->identifiant }} </td>
                            <td>{{ $attestation->resultatAcademique->inscription->etudiant->nom }} {{ $attestation->resultatAcademique->inscription->etudiant->prenom }}</td>
                            <td>{{ $attestation->resultatAcademique->procesVerbal->parcours->intitule }} ({{ $attestation->resultatAcademique->procesVerbal->parcours->niveauEtude->intitule }})</td>
                            <td>
                                <button id="{{ $attestation->id }}" class="btn btn-info view action-btn" title="Détails">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <a class="btn btn-primary action-btn" title="Voir pdf" href="{{ route('metiers.actes.definitives.generer', $attestation->id) }}">
                                    <i class="bi bi-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- Modal Details-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal1" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Détails attestation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Référence </td>
                                    <td id="reference1"></td>
                                </tr>
                                <tr>
                                    <td>Intitulé</td>
                                    <td id="intitule1"></td>
                                </tr>
                                <tr>
                                    <td>Impétrant</td>
                                    <td id="identifiant1"></td>
                                </tr>

                                <tr>
                                    <td>Parcours de formation </td>
                                    <td id="parcours1"></td>
                                </tr>
                                <tr>
                                    <td>Niveau d'étude </td>
                                    <td id="niveau1"></td>
                                </tr>
                                <tr>
                                    <td>Institution </td>
                                    <td id="institution1"> </td>
                                </tr>
                                <tr>
                                    <td>Résultats académiques </td>
                                    <td id="sessionr1">
                                        Année académique : <br />
                                        Session : <br />
                                        Moyenne : <br />
                                        Cote : <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>
                                        <a class="btn btn-info" title="Voir pdf" href="#">
                                            <i class="bi bi-file-pdf"></i>
                                        </a>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

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
        $(document).on('click', '#filtre0', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var selectNiveau = $('#niveau')[0];
            var niveau = selectNiveau.options[selectNiveau.selectedIndex].value;
            var selectAnnee = $('#annee')[0];
            var annee = selectAnnee.options[selectAnnee.selectedIndex].value;
            var selectParcours = $('#parcours')[0];
            var parcours = selectParcours.options[selectParcours.selectedIndex].value;
            $.ajax({
                // Our sample url to make request 
                url: "/d/provisoires/filtre/" + niveau + "/" + parcours + "/" + annee,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {
                    console.log("ok");
                    var data_table = $('#data')[0];
                    if ($.fn.dataTable.isDataTable('#data')) {
                        $.fn.dataTable.destroy('#data');
                    }
                    $('#data').DataTable({
                        data: data.result.attestations
                    });

                },

                // Error handling 
                error: function(error) {
                    console.log("Error ${error}");
                }
            });
        });
    });
</script>


<script type="module">
    $(document).ready(function() {

        $(document).on('click', '.view', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            $.ajax({
                // Our sample url to make request 
                url: "/d/provisoires/view/" + id,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {
                    $("#reference1").text(data.result.reference);
                    $("#intitule1").text(data.result.intitule);
                    $("#identifiant1").text(data.result.impetrant);
                    $("#parcours1").text(data.result.parcours);
                    $("#niveau1").text(data.result.niveau);
                    $("#institution1").text(data.result.institution);
                    $("#sessionr1").text(data.result.sessionr);
                    var myModal = new bootstrap.Modal($("#exampleModal1"), {});
                    myModal.show();
                },

                // Error handling 
                error: function(error) {
                    console.log("Error ${error}");
                }
            });
        });
    });
</script>
@endpush