@extends('includes.master')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header bg-info">
                <h4>{{ __('Parcours de formation') }}</h4>
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
                        <button id="add" class="btn btn-success" > Ajouter</a> <br />
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
                                    <form method="post" action="{{ route('metiers.etablissements.parcours-store') }}">
                                        @csrf
                                        <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">
                                        <div class="form-group row py-2">
                                            <label for="niveau" class="col-sm-2 col-form-label">Niveau</label>
                                            <div class="col">
                                                <select class="form-control" id="institution" name="niveauEtude_id" required>
                                                    <option value="" selected disabled hidden> Choisir le niveau</option>
                                                    @foreach( $niveaux as $niveau)
                                                    <option value="{{ $niveau->id}}">{{ $niveau->intitule }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row py-2">
                                            <label for="intitule" class="col-sm-2 col-form-label">Parcours</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="Lettres modernes" required>
                                            </div>
                                        </div>
                                        <div class="form-group row py-2">
                                            <label for="domaine" class="col-sm-2 col-form-label">Domaine</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="domaine" name="domaine" placeholder=" ..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row py-2">
                                            <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control" id="mention" name="mention" placeholder="..." required>
                                            </div>
                                        </div>

                                        <div class="form-group row py-2">
                                            <label for="specialite" class="col-sm-2 col-form-label">Spécialité</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control" id="specialite" name="specialite" placeholder="..." required>
                                            </div>
                                        </div>
                                        <div class="form-group row py-2">
                                            <label for="credit" class="col-sm-2 col-form-label">Nombre de crédit</label>
                                            <div class="col">
                                                <input type="number" class="form-control form-control" id="credit" name="credit" required>
                                            </div>
                                        </div>
                                        <div class="form-group row py-2">
                                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control" id="description" name="description" required>
                                            </div>
                                        </div>
                                        <div class="row py-4">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col">
                                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                                            </div>
                                            <div class="col">
                                                 <button class="btn btn-danger" data-bs-dismiss="modal">Annuler</button> </a>
                                            </div>

                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Institution</th>
                                    <th>Niveau</th>
                                    <th>Intitule</th>
                                    <th>Domaine</th>
                                    <th>Mention</th>
                                    <th>Spécialité</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parcours as $par)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $par->institution->sigle }}</td>
                                    <td>{{ $par->niveau_etude->intitule }}</td>
                                    <td>{{ $par->intitule }}</td>
                                    <td>{{ $par->domaine }} </td>
                                    <td> {{ $par->mention }}</td>
                                    <td>{{ $par->specialite }}</td>

                                    <td>
                                        <a class="btn btn-info action-btn" title="Voir attestations provisoire" href="#">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a class="btn btn-primary action-btn" title="Ajouter une attestation" href="#">
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