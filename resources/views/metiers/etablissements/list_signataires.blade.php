@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Signataires
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
            <h3 class="box-title">Signataires</h3>
            <div class="col-2 offset-10 mb-5">
                <a id="add1" class="btn btn-success" href="{{ route('metiers.etablissements.signataire-add') }}"> Ajouter</a>
                <button id="upload" class="btn btn-success"> Importer</button>
                
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Fonction</th>
                            <th>Tyde de document signé</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($signataires as $signataire)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $signataire->nom }}</td>
                            <td>{{ $signataire->prenom }}</td>
                            <td>{{ $signataire->fonction }}</td>
                            <td>{{ $signataire->typeDocument }}</td>
                            <td>

                                <button class="btn btn-info view action-btn" title="Détails" data="{{ $signataire->id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button class="btn btn-primary edit action-btn" title="Modifier" data="{{ $signataire->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>



                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal afficher-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal2" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel2">Informations Signataire</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    modal content
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal Editer-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal3" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel3">Modifier Signataire</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('signataires.update', 100) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row py-2">
                            <label for="nom3" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom3" name="nom" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom3" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="prenom3" name="prenom" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="nip" class="col-sm-2 col-form-label">NIP (CNIB)</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nip3" name="nip" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="type" class="col-sm-2 col-form-label">Sexe</label>
                            <div class="col">
                                <select class="form-control" id="sexe" name="sexe">
                                    <option value="" disabled selected>choisir ...</option>
                                    <option value="masculin">Masculin</option>
                                    <option value="feminin">Féminin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                            <div class="col">
                                <input type="text" class="form-control" id="fonction3" name="fonction" value="" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="fonctionLongue" class="col-sm-2 col-form-label">Fonction longue</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="fonctionLongue3" name="fonctionLongue" value="" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                            <div class="col">
                                <select class="form-control" id="grade" name="grade">
                                    <option value="" disabled selected>choisir ...</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Pr">Pr</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="titreAcademique" class="col-sm-2 col-form-label">Titre academique</label>
                            <div class="col">
                                <input type="text" class="form-control" id="titreAcademique3" name="titreAcademique" value="">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="titreHonorifique" class="col-sm-2 col-form-label">Titre honorifique</label>
                            <div class="col">
                                <input type="text" class="form-control" id="titreHonorifique3" name="titreHonorifique" value="">
                            </div>
                        </div>
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
        //Formulaire d'ajout de signataire
        $(document).on('click', '#add', function() {
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });

        //Information signataire
        $(document).on('click', '.view', function() {
            var id = $(this).attr('data');
            var myModal = new bootstrap.Modal($("#exampleModal2"), {});
            myModal.show();

        });

        //Modifier signataire
        $(document).on('click', '.edit', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('data');
            $.ajax({
                // Our sample url to make request 
                url: "/signataires/" + id + "/edit",
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {

                    $("#nom3").val(data.result.signataire.nom);
                    $("#prenom3").val(data.result.signataire.prenom);
                    $("#nip3").val(data.result.signataire.nip);
                    $("#fonction3").val(data.result.signataire.fonction);
                    $("#fonctionLongue3").val(data.result.signataire.fonctionLongue);
                    $("#titreAcademique3").val(data.result.signataire.titreAcademique);
                    $("#titreHonorifique3").val(data.result.signataire.titreHonorifique);

                    var myModal = new bootstrap.Modal($("#exampleModal3"), {});
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