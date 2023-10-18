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
                        <a class="btn btn-success" href="{{ route('metiers.etablissements.etudiant-add') }}"> Ajouter</a> <br />
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
                                        <a class="btn btn-info" title="Voir attestations provisoire" href="{{ route('impetrants.show',$etudiant->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a class="btn btn-primary" title="Ajouter une attestation" href="{{ route('metiers.etablissements.attestation-add',['institution_id' => $institution->id, 'etudiant_id' => $etudiant->id]) }}">
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

<!-- Core theme JS-->
<script type="module" src="{{URL::asset('/assets/datatables.js/datatable.min.js')}}"></script>

<script type="module">
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>
@endpush