@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush


@section('page-title')
    Parcours de formation
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
            <h3 class="box-title">Parcours de formation</h3>
            
            <div class="mb-5">
                <form method="post" action="{{ route('metiers.daoi.attestation-filtre') }}">
                    @csrf
                    <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">

                    <div class="row border border-secondary">
                        <div class="form-group col-4 py-2">
                            <label for="niveau" class="col-sm-10 col-form-label">Niveau d'étude </label>
                            <div class="col">
                                <select class="form-control field" id="niveau" name="niveau" required>
                                    <option value="0" selected >Choisir</option>
                                    @foreach ($niveaux as $niveau)
                                    <option value="{{ $niveau->id}}">{{ $niveau->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-4 py-2">
                            <label for="filiere" class="col-sm-10 col-form-label">Filiere </label>
                            <div class="col">
                                <select class="form-control field" id="filiere" name="filiere" required>
                                    <option value="0" selected>Choisir</option>
                                    @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id}}">{{ $filiere->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <table id="data" class="table table-striped table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Filière</th>
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
                            <td class="text-center">{{ $loop->index +1 }}</td>
                            <td class="text-center">{{ $par->filiere->sigle }}</td>
                            <td class="text-center">{{ $par->niveau_etude->intitule }}</td>
                            <td class="text-center">{{ $par->intitule }}</td>
                            <td class="text-center">{{ $par->domaine }} </td>
                            <td class="text-center"> {{ $par->mention }}</td>
                            <td class="text-center">{{ $par->specialite }}</td>

                            <td>
                                <a class="btn btn-primary action-btn" title="Détails" href="{{ route('metiers.etablissements.parcours-view', $par->id) }}">
                                    <i class="bi bi-eye"></i> 
                                </a>
                                <a class="btn btn-primary action-btn" title="Ajouter une attestation" href="">
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
<!-- Modal ajouter parcours-->
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
        //Formulaire d'ajout 
        $(document).on('click', '#add', function() {
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });
        //Filtre sur les niveaux
        $(document).on('change', '.field', function() {
            var selectNiveauOptions = $('#niveau')[0].options;
            var selectedniveau = selectNiveauOptions.options[selectNiveauOptions.selectedIndex].value;
            var selectFiliereOptions = $('#filiere')[0].options;
            var selectedfiliere = selectFiliereOptions[selectFiliereOptions.selectedIndex].value;
            console.log(selectedfiliere);
            console.log(selectedniveau);
            if(selectedfiliere =="") { selectedfiliere = 0;}
            if(selectedniveau =="") { selectedniveau = 0;}
            $.ajax({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                },
                url: "/parcours/filtre/" + selectedfiliere + "/" + selectedniveau,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {
                    console.log('ok');
                    
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