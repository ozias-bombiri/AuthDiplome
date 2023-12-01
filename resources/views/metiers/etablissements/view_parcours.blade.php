@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush


@section('page-title')
    Parcours de formation : {{ $parcours->intitule }}
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
            <h3 class="box-title">Liste des étudiants inscrits</h3>
            <div class="col-4 offset-8 mb-5">
                <a id="add1" class="btn btn-success" href="{{ route('metiers.etablissements.etudiant-add', $parcours->id) }}"> Ajouter</a>
                <button id="upload" class="btn btn-success"> Importer</button>
            </div>
            
            <div>
            <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Identifiant</th>
                            <th>Nom Prénom(s)</th>
                            <th>Date de naissance</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $etudiant)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $etudiant->identifiant }}</td>
                            <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                            <td>{{ \Carbon\Carbon::parse($etudiant->dateNaissance)->translatedFormat('d F Y') }}</td>

                            <td>
                                <button class="btn btn-info view action-btn" title="Informations détaillées " data="{{ $etudiant->id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <a href="{{ route('metiers.etablissements.attestation-add', [$parcours->id, $etudiant->id]) }}" class="btn btn-primary add action-btn" title="Ajouter une attestation" id="{{ $etudiant->id }}">
                                    <i class="bi bi-plus"></i>
                    
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

<!-- Modal Attestation-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une attestation provisoire</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="post" action="{{ route('metiers.etablissements.attestation-store') }}">
                            @csrf
                            <fieldset class="border border-secondary px-4 py-3 my-2">
                                <legend> Informations impétrant</legend>

                                <div class="form-group row py-2">
                                    <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control" id="identifiant" disabled>
                                    </div>
                                </div>
                                <div class="form-group row py-2">
                                    <label for="nom" class="col-sm-2 col-form-label">Nom Prénom(s)</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nom" name="nom" disabled>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border border-secondary px-4 py-4 my-2">
                                <legend>Information résultats académiques</legend>
                                <div class="form-group row py-2">
                                    <label for="annee2" class="col-sm-2 col-form-label">Année académique</label>
                                    <div class="col">
                                        <select class="form-control" id="annee2" name="annee_id" required>
                                            <option value=""selected hidden disabled>Choisir </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row py-2">
                                    <label for="parcoursid" class="col-sm-2 col-form-label">Parcours</label>
                                    <div class="col">
                                    <input type="hidden" class="form-control" id="parcoursid" name="parcours_id" value="{{ $parcours->id }}" >
                                    <input type="text" class="form-control" value="{{ $parcours->intitule }}" disabled>    
                                    </div>
                                </div>

                                <div class="form-group row py-2">
                                    <label for="session" class="col-sm-2 col-form-label">Session </label>
                                    <div class="col">
                                        <select class="form-control" id="sessionr" name="sessionr" required>
                                            <option value="" selected hidden disabled >Choisir </option>
                                            <option value="Normale">Normale </option>
                                            <option value="Rattrapage">Rattrapage </option>
                                            <option value="Spéciale">Spéciale </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row py-2">
                                    <label for="dateSoutenance" class="col-sm-2 col-form-label">Date de soutenance</label>
                                    <div class="col">
                                        <input type="date" min="2023-10-3" class="form-control form-control" id="dateSoutenance" name="dateSoutenance" placeholder="Date de soutenance" required>
                                    </div>
                                </div>
                                <div class="form-group row py-2">
                                    <label for="moyenne" class="col-sm-2 col-form-label">Moyenne</label>
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
                                    <label for="signataire2" class="col-sm-2 col-form-label">Signataire</label>
                                    <div class="col">
                                        <select class="form-control" id="signataire2" name="signataire" required>
                                            <option value="" selected hidden disabled>Choisir </option>

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
        $(document).on('click', '.add', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var impetrant_id = $(this).attr('id');
            var parcours_id = $(this).attr('data');
            var url = "{{ route('metiers.etablissements.attestation-add',['+parcours_id+','+impetrant_id'] ) }}";
            $.ajax({
                // url for getting data 
                url: "/d/provisoires/add/" + parcours_id + "/" + impetrant_id,
                method: "GET",
                dataType: "json",
                // Function to call when to
                // request is ok 
                success: function(data) {
                    $("#identifiant").val(data.result.etudiant.identifiant);
                    $("#nom").val(data.result.etudiant.nom + " " + data.result.etudiant.prenom);
                    var anneeList = $("#annee2")[0];
                    anneeList.innerHTML = "";
                    data.result.annees.forEach((annee) => {
                        const newOption = document.createElement('option');
                        const optionText = document.createTextNode(annee.intitule);
                        // set option text
                        newOption.appendChild(optionText);
                        // and option value
                        newOption.setAttribute('value', annee.id);
                        anneeList.appendChild(newOption);

                    });

                    var parcoursList = $("#parcours2")[0];
                    parcoursList.innerHTML = "";
                    data.result.parcours.forEach((parc) => {
                        const newOption = document.createElement('option');
                        const optionText = document.createTextNode(parc.intitule);
                        // set option text
                        newOption.appendChild(optionText);
                        // and option value
                        newOption.setAttribute('value', parc.id);
                        newOption.setAttribute('data', parc.soutenance);
                        parcoursList.appendChild(newOption);

                    });

                    var signataireList = $("#signataire2")[0];
                    signataireList.innerHTML = "";
                    data.result.signataires.forEach((signataire) => {
                        const newOption = document.createElement('option');
                        const optionText = document.createTextNode(signataire.nom + " " + signataire.prenom);
                        newOption.appendChild(optionText);
                        newOption.setAttribute('value', signataire.id);
                        signataireList.appendChild(newOption);

                    });
                    var myModal = new bootstrap.Modal($("#exampleModal"), {});
                    myModal.show();
                },

                // Error handling 
                error: function(error) {
                    console.log("Error ${error}");
                }
            });
            var myModal = new bootstrap.Modal($("#exampleModal"), {});
            myModal.show();

        });
        //Filtre sur les niveaux
        $(document).on('change', '#niveau', function() {
            var selected = this.options[this.selectedIndex].value;
            
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });
    });


</script>
@endpush