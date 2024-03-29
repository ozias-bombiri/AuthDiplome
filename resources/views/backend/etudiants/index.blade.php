@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Etudiants
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
            <h3 class="box-title">Etudiants </h3>
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('etudiants.create') }}"> Ajouter </a>
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered table-responsible">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Identifiant</th>
                            <th>Nom prénom</th>
                            <th>Date de naissance</th>
                            <th>Lien de naissance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $impetrant)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $impetrant->identifiant }}</td>
                            <td>{{ $impetrant->nom. ' '.$impetrant->prenom }}</td>
                            
                            <td>{{ \Carbon\Carbon::parse($impetrant->dateNaissance)->translatedFormat('d F Y') }}</td>
                            <td> {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance}}) </td>
                            <td>
                                <a class="btn btn-info" title="Détails" href="{{ route('etudiants.show',$impetrant->id) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a class="btn btn-primary" title="Modifier" href="{{ route('etudiants.edit',$impetrant->id) }}">
                                    <i class="bi bi-pencil"></i>
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