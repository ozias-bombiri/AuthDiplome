@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Parcours
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
            <h3 class="box-title">Parcours </h3>
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('parcours.create') }}"> Ajouter </a>

            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Institution</th>
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
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $par->filiere->institution->sigle.' ('.$par->filiere->institution->parent->sigle.')' }}</td>
                            <td>{{ $par->filiere->intitule}}</td>
                            <td>{{ $par->niveauEtude->intitule }}</td>
                            <td>{{ $par->intitule }}</td>
                            <td>{{ $par->domaine }} </td>
                            <td> {{ $par->mention }}</td>
                            <td>{{ $par->specialite }}</td>

                            <td>
                                <form action="{{ route('parcours.destroy',$par->id) }}" method="POST">
                                    
                                    <a class="btn btn-primary" title="Modifier" href="{{ route('parcours.edit',$par->id) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a class="btn btn-primary" title="Inscription" href="{{ route('parcours.inscriptions.index',$par->id) }}">
                                        <i class="bi bi-folder"></i>
                                    </a>
                                    <a class="btn btn-primary" title="Procès verbaux" href="{{ route('parcours.proces_verbaux.index',$par->id) }}">
                                        <i class="bi bi-file-pdf"></i>
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
