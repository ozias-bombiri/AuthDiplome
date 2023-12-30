@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Signataires
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
            <h3 class="box-title">Signataires </h3>
            <div class="col-4 offset-6 mb-5">
                 <a class="btn btn-success" href="{{ route('signataires.create1') }}"> Ajouter pour un établissement </a> 
                <a class="btn btn-success" href="{{ route('signataires.create2') }}"> Ajouter pour une IESR </a>

            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Institution</th>
                            <th>Actes signés</th>
                            <th>Pédiode</th>
                            <th>Statut</th>
                            <th>Nom Prénom</th>
                            <th>Fonction</th>
                            <th>Mention</th>                            
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($signataireActes as $signataireActe)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td> {{ $signataireActe->institution->sigle }} @if($signataireActe->institution->parent) ({{ $signataireActe->institution->parent->sigle }}) @endif </td>
                            <td> {{ $signataireActe->categorieActe->intitule }}</td> 
                            <td>  {{ $signataireActe->debut.' - '.$signataireActe->fin}}</td> 
                            <td> @if($signataireActe->statut)  Activé @else  Désactivé @endif</td>                          
                            <td>{{ $signataireActe->signataire->grade.' '.$signataireActe->signataire->nom.' '.$signataireActe->signataire->prenom }}</td>
                            <td>{{ $signataireActe->fonction }}</td>
                            <td>{{ $signataireActe->mention }}</td>
                            <td>
                                <form action="{{ route('signataires.destroy',$signataireActe->id) }}" method="POST">
                                    <a class="btn btn-info" title="Détails" href="{{ route('signataires.show',$signataireActe->id) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a class="btn btn-primary" title="Modifier" href="{{ route('signataires.edit',$signataireActe->id) }}">
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