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
                <form method="post" action="{{ route('metiers.auth.recherche') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-2 col-form-label">Référence à chercher</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="reference" name="reference" required>
                        </div>

                        <label for="sigle" class="col-sm-2 col-form-label">Catégorie</label>
                        <div class="col">
                            <select class="form-control" id="categorie" name="categorie" required>
                                <option value="provisoire">Attestation provisoire</option>
                                <option value="definitive">Attestation définitive</option>
                                <option value="diplome">Diplôme</option>

                            </select>
                        </div>
                    </div>

                    <div class="row py-4">
                        <label class="col-sm-2 offset-1 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Rechercher</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('metiers.auth.index') }}"> <button type="button" class="btn btn-secondary">Retour</button> </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                @if(isset($message))
                <p class="text-danger"> {{ $message }}</p>
                @endif

                @if(isset($document))
                <button class="btn btn-link btn-primary" id="visualiser" href="{{ route('metiers.auth.visualiser', ['categorie' =>$categorie, 'document' =>$document->id]) }}">Document trouver : {{ $document->intitule }}</a>
                <input type="hidden" id="categorie" value="{{ $categorie }}" />
                <input type="hidden" id="document" value="{{ $document->id }}" />
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
                    <h5 class="modal-title" id="exampleModalLabel">Détails attestation</h5>
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
                                    <td id="reference"></td>
                                </tr>
                                <tr>
                                    <td>Intitulé</td>
                                    <td id="intitule"></td>
                                </tr>
                                <tr>
                                    <td>Impétrant</td>
                                    <td id="identifiant"></td>
                                </tr>

                                <tr>
                                    <td>Parcours de formation </td>
                                    <td id="parcours"></td>
                                </tr>
                                <tr>
                                    <td>Niveau d'étude </td>
                                    <td id="niveau"></td>
                                </tr>
                                <tr>
                                    <td>Institution </td>
                                    <td id="institution"> </td>
                                </tr>
                                <tr>
                                    <td>Résultats académiques </td>
                                    <td id="sessionr">
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

        $(document).on('click', '#visualiser', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $("#document").value;
            var categorie = $("#categorie").value;
            $.ajax({
                // Our sample url to make request 
                url: "/authentification/view/"+ categorie + "/" + id,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {
                    $("#reference").text(data.result.reference);
                    $("#intitule").text(data.result.intitule);
                    $("#identifiant").text(data.result.impetrant);
                    $("#parcours").text(data.result.parcours);
                    $("#niveau").text(data.result.niveau);
                    $("#institution").text(data.result.institution);
                    $("#sessionr").text(data.result.sessionr);
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