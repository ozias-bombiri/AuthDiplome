@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Configurations
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


<div class="row justify-content-center">
    <div class="col-lg-6 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Signataires</h3>
            <div class="row">
                <div class="col-2 offset-10 mb-4">
                    <a class="btn btn-success" href="{{ route('signataires.create1') }}"> Ajouter </a>
                </div>
            </div>
            @if(count($signataireActes) > 0)
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nom Prénom</th>
                            <th>Categorie d'acte</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($signataireActes as $signataireActe)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $signataireActe->signataire->grade.' '.$signataireActe->signataire->nom.' '.$signataireActe->signataire->prenom }}</td>
                            <td>{{ $signataireActe->categorieActe->intitule }}</td>
                            <td>
                                <a class="btn btn-info" title="Détails" href="{{ route('signataires.show',$signataireActe->id) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a class="btn btn-primary" title="Modifier" href="{{ route('signataires.edit',$signataireActe->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Compteur</h3>
            @if(count($numeroteurs) < 1)
                <a class="btn btn-success" href="{{ route('numeroteurs.create') }}"> Ajouter </a>
            @else
                <div class="table-responsive">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Categorie d'acte</th>
                                <th>Valeur actuel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($numeroteurs as $numeroteur)
                            <tr>
                                <td>{{ $numeroteur->categorieActe->intitule }}</td>
                                <td>{{ $numeroteur->compteur }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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

    });
</script>

@endpush