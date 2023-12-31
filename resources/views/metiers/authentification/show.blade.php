@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Recherche
@endsection

@section('content')

<div class="row my-3">

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

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div>
                <h3 class="box-title">{{ __('Rechercher') }}</h3>
                <div>

                </div>
            </div>
            <div class="row">
                @if(isset($message))
                <p class="text-danger"> {{ $message }}</p>
                @endif

                @if(isset($document))

                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
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
                        <tr>

                            <td> {{ $document->resultat_academique->annee_academique->intitule }}</td>
                            <td>{{ $document->reference }}</td>
                            <td>{{ $document->intitule }}</td>
                            <td>{{ $document->resultat_academique->impetrant->identifiant }} </td>
                            <td>{{ $document->resultat_academique->impetrant->nom }} {{ $document->resultat_academique->impetrant->prenom }}</td>
                            <td>{{ $document->resultat_academique->parcours->intitule }} ({{ $document->resultat_academique->parcours->niveau_etude->intitule }})</td>
                            <td>
                                <a id="{{ $document->id }}" class="btn btn-info view-btn" href="{{ route('metiers.auth.pdf', [$document->reference]) }}">
                                    <i class="bi bi-pdf"></i>Afficher le document
                                </a>                                
                                
                            </td>
                        </tr>
                    </tbody>
                </table>

                @endif
            </div>

        </div>
    </div>
</div>

<!-- Modal Details-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Détails du document</h5>
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

        $(document).on('click', '.view-btn', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            var categorie = $(this).attr("data");
            console.log(categorie +'/'+id);
            $.ajax({
                // Our sample url to make request 
                url: "/authentification/view/" + categorie + "/" + id,
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
                    var myModal = new bootstrap.Modal($("#exampleModal"), {});
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