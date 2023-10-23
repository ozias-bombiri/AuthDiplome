@extends('includes.master')

@push('custom-styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">  
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Attestations définitives') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('attestation_definitives.create') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Réréfence</th>
                                    <th>intitule</th>
                                    <th>dateSignature</th>
                                    <th>LieuSignature</th>
                                    <th>Parcours</th>
                                    <th>Impetrant</th>
                                    <th>Année académique</th>
                                    <th>Document généré </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attestations as $attestation)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $attestation->reference }}</td>
                                    <td>{{ $attestation->intitule }}</td>
                                    <td>{{ $attestation->dateSignature }}</td>
                                    <td>{{ $attestation->lieuSignature }}</td>
                                    <td>{{ $attestation->resultat_academique->parcours->intitule }}</td>
                                    <td>{{ $attestation->resultat_academique->impetrant->nom }} {{ $attestation->resultat_academique->impetrant->prenom }}</td>
                                    <td> {{ $attestation->resultat_academique->annee_academique->intitule }}</td>
                                    <td>
                                        @if($attestation->statutGeneration)
                                            oui
                                        @else non
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('attestation_definitives.destroy',$attestation->id) }}" method="POST">
                                            <a class="btn btn-info" title="Détails" href="{{ route('attestation_definitives.show',$attestation->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('attestation_definitives.edit',$attestation->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>
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
@endpush