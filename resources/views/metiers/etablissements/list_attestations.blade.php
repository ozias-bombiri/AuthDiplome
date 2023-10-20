@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Attestations provisoires') }}</h4>
            </div>

            <div class="card-body">
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
                <div class="row my-3">
                    <div class="col-3 offset-1">

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                    <td>{{ $attestation->reference }}</td>
                                    <td>{{ $attestation->intitule }}</td>
                                    <td>{{ $attestation->resultat_academique->impetrant->identifiant }} </td>
                                    <td>{{ $attestation->resultat_academique->impetrant->nom }} {{ $attestation->resultat_academique->impetrant->prenom }}</td>
                                    <td>{{ $attestation->resultat_academique->parcours->intitule }} ({{ $attestation->resultat_academique->parcours->niveau_etude->intitule }})</td>
                                    <td>
                                        <button id="{{ $attestation->id }}" class="btn btn-info view" title="Détails">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <a class="btn btn-primary" title="Voir pdf" href="{{ route('metiers.etablissements.attestation-pdf', $attestation->id) }}">
                                            <i class="bi bi-file-pdf"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row my-3">
                    <!-- Modal -->
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
                                                    <td id="reference">{{ $attestation->reference }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Intitulé</td>
                                                    <td id="intitule">{{ $attestation->intitule }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Impétrant</td>
                                                    <td id="identifiant">
                                                        Identifiant : {{ $attestation->resultat_academique->impetrant->identifiant }} <br />
                                                        Nom et Prénom : {{ $attestation->resultat_academique->impetrant->nom }} {{ $attestation->resultat_academique->impetrant->prenom }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Parcours de formation </td>
                                                    <td id="parcours">{{ $attestation->resultat_academique->parcours->intitule }} </td>
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
                                                        Session :  <br />
                                                        Moyenne :  <br />
                                                        Cote :  <br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> </td>
                                                    <td>
                                                        <a class="btn btn-info" title="Voir pdf" href="{{ route('metiers.etablissements.attestation-pdf', $attestation->id) }}">
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


            </div>
        </div>
    </div>
</div>

@endsection
@push('costum-scripts')
<script type="module">
    $(document).ready(function(){

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