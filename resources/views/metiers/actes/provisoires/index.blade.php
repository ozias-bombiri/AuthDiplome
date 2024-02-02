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

        @if (session('reponse'))
                <div class="alert alert-danger">
                    {{ session('reponse') }}
                </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Filtres</h3>
            <div class="form-group row py-2">
                <label for="niveau" class="col-sm-2 col-form-label">Niveaux d'étude</label>
                <div class="col">
                    @foreach( $niveaux as $niveau)
                        <a class="btn btn-link btn-secondary" aria-current="page" href="{{ route('actes.provisoires.niveaux', $niveau->id) }}">{{ $niveau->intitule}}</a>
                    @endforeach
                </div>
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
                            <th>Référence</th>
                            <th>Intitulé</th>
                            <th>Parcours</th>
                            <th>Impétrant</th>
                            <th>Date de signataure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attestations as $acte)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $acte->reference }}</td>
                            <td>{{ $acte->intitule }}</td>
                            <td>{{ $acte->resultatAcademique->procesVerbal->parcours->code.' | '.$acte->resultatAcademique->procesVerbal->parcours->intitule }}</td>
                            <td> {{ $acte->resultatAcademique->inscription->etudiant->identifiant.' | '.$acte->resultatAcademique->inscription->etudiant->nom.' '.$acte->resultatAcademique->inscription->etudiant->prenom }}</td>
                            <td>{{ \Carbon\Carbon::parse($acte->dateSignature)->translatedFormat('d F Y') }}</td>

                            <td>
                                <button id="{{ $acte->id }}" class="btn btn-info view action-btn" title="Détails">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <a class="btn btn-primary action-btn" title="Voir pdf" href="{{ route('metiers.actes.provisoires.generer', $acte->id) }}">
                                    <i class="bi bi-file-pdf"></i>
                                </a>

                                <button id="{{ $acte->id }}" class="btn btn-info remise action-btn" data-bs-toggle="modal" data-bs-target="#modalRemiseActe"  title="Remise de l'attestation">
                                    <i class="bi bi-file-pdf"></i>
                                </button>                          
                               @hasrole('DAOI')
                                    <a class="btn btn-primary action-btn" title="Etablir attestation définitive" href="{{ route('proces_verbaux.definitives.create', ['resultat_id' => $acte->resultatAcademique->id]) }}">
                                        <i class="bi bi-file-pdf"></i>
                                    </a>
                                @endhasrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal REmise actes-->

<div class="modal fade RemiseActe" id="modalRemiseActe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remise de l'acte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('metiers.actes.provisoires.remise', $acte->id) }}">
                @csrf

                <div class="mb-3">
                    <label for="acteAcademique" class="col-sm-2 col-form-label">Acte academique</label>
                    <div class="col">
                        <input type="hidden"  name="acteAcademique_id" value="{{ $acte->id }}">
                        <input type="text" class="form-control form-control" id="intitule2" value="{{ $acte->intitule }}" readonly>
                    </div> 
                </div>

                <div class="mb-3">
                    <label for="reference" class="col-sm-2 col-form-label">Reference</label>
                    <div class="col">
                        <input type="text" class="form-control form-control" id="reference2" name="reference"  value="{{ $acte->reference }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="dateRetrait" class="col-sm-2 col-form-label">Date de retrait</label>
                    <div class="col">
                        <input type="date" class="form-control form-control" id="dateRetrait" name="dateRetrait" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
                    </div>
                </div>
           
                <div class="mb-3">
                    <label for="retirant" class="col-sm-2 col-form-label">Retirant</label>
                    <div class="col">
                        <input type="text" class="form-control form-control" id="retirant" name="retirant" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col">
                        <textarea name="description" class="form-control" id="" cols="5" rows="3"></textarea>
                    </div>
                </div>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
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

        $(document).on('click', '.remise', function() {
            $.ajaxSetup({
                headers: {
                    
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            console.log(id);
            $.ajax({
                // Our sample url to make request 
                url: "http://127.0.0.1:8000/actes/remise/" + id,
                method: "POST",
                data: {  },

                // Function to call when to
                // request is ok 
                success: function(data) {
                    console.log('data');
                    $("#reference2").text(data.result.reference);
                    $("#intitule2").text(data.result.intitule);
                    
                    var myModalRemise = new bootstrap.Modal($("#modalRemiseActe"), {});
                    myModalRemise.show();
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