@extends('includes.master')

@push('custom-styles')
<link href="{{ URL::asset('/assets/css/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Etudiants') }}</h4>
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
                        <button id="add" class="btn btn-success" > Ajouter</button> 
                        <input type="hidden" id="institution" value="{{ $institution->id }}" />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
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
                                        <button class="btn btn-info view" title="Informations détaillées " data="{{ $etudiant->id }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <button class="btn btn-primary add" title="Ajouter une attestation" id="{{ $etudiant->id }}" data="{{ $institution->id }}">
                                            <i class="bi bi-plus"></i>
                                            <input type="hidden" id="institution" value="{{ $institution->id }}" />
                                        </button>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal Ajouter -->
                <div class="row my-3">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Informations étudiants</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('metiers.etablissements.etudiant-store') }}">
                                        @csrf
                                        <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">
                                        <div class="form-group row py-2">
                                            <label for="identifiant1" class="col-sm-2 col-form-label">Identifiant</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control" id="identifiant1" name="identifiant" placeholder="N0000000014257" required>
                                            </div>
                                        </div>

                                        <div class="form-group row py-2">
                                            <label for="typeIdentifiant" class="col-sm-2 col-form-label">Type de l'identifiant </label>
                                            <div class="col">
                                                <select class="form-control" id="typeIdentifiant" name="typeIdentifiant" required>
                                                    <option value="INE">INE</option>
                                                    <option value="Matricule">Matricule</option>
                                                    <option value="Autres">Autres</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row py-2">
                                            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="nom1" name="nom" placeholder="Nom" required>
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
                                                    <option value="Masculin">Masculin</option>
                                                    <option value="Feminin">Féminin</option>

                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group row py-2">
                                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                                            <div class="col">
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
                <div class="row my-3">
                    <!-- Modal Information-->
                    <div class="modal fade" id="exampleModal2" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Informations étudiants</h5>
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

                <div class="row my-3">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une attestation provisoire</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('metiers.etablissements.attestation-store') }}">
                                        @csrf
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

                                        <div class="form-group row py-2">
                                            <label for="prenom" class="col-sm-2 col-form-label">Année académique</label>
                                            <div class="col">
                                                <select class="form-control" id="annee" name="annee_id" required>
                                                    <option value="" disabled>Choisir </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row py-2">
                                            <label for="prenom" class="col-sm-2 col-form-label">Parcours</label>
                                            <div class="col">
                                                <select class="form-control" id="parcours" name="parcours_id" required>
                                                    <option value="" disabled selected>Choisir </option>

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
                                                <input type="number" step="0.01" class="form-control form-control" id="moyenne" name="moyenne" required>
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
                                                <select class="form-control" id="signataire" name="signataire" required>
                                                    <option value="" disabled>Choisir </option>

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
        </div>
    </div>
</div>

@endsection
@push('costum-scripts')

<script type="module">
    $(document).ready(function() {
        //Formulaire d'ajout d'étudiant
        $(document).on('click', '#add', function() {
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });
        //Informations détaillée de l'étudiant
        $(document).on('click', '.view', function() {
            var myModal = new bootstrap.Modal($("#exampleModal2"), {});
            myModal.show();

        });
        $(document).on('click', '.add', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            var institution_id = $(this).attr('data');

            $.ajax({
                // Our sample url to make request 
                url: "/d/provisoires/add/" + institution_id + "/" + id,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {

                    //console.log(data.result);
                    $("#identifiant").val(data.result.etudiant.identifiant);
                    $("#nom").val(data.result.etudiant.nom + " " + data.result.etudiant.prenom);
                    var anneeList = $("#annee")[0];
                    anneeList.innerHTML = "";
                    data.result.annees.forEach((annee) => {
                        const newOption = document.createElement('option');
                        const optionText = document.createTextNode(annee.intitule);
                        // set option text
                        newOption.appendChild(optionText);
                        // and option value
                        newOption.setAttribute('value', annee.id);
                        //console.log(anneeList);
                        anneeList.appendChild(newOption);

                    });

                    var parcoursList = $("#parcours")[0];
                    parcoursList.innerHTML = "";
                    data.result.parcours.forEach((parc) => {
                        const newOption = document.createElement('option');
                        const optionText = document.createTextNode(parc.intitule);
                        // set option text
                        newOption.appendChild(optionText);
                        // and option value
                        newOption.setAttribute('value', parc.id);
                        //console.log(anneeList);
                        parcoursList.appendChild(newOption);

                    });

                    var signataireList = $("#signataire")[0];
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
        });
    });
</script>
@endpush