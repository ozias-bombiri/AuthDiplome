@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('Résultats académiques') }}
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
            <h3 class="box-title">{{ __('Résultats académiques') }} @if(isset($procesVerbal)) {{ $procesVerbal->intitule }} @endif</h3>
            <div class="col-4 offset-8 mb-5">
                @hasrole(['SCOLARITE'])
                <a class="btn btn-success" href="{{ route('proces_verbaux.resultats.create', $procesVerbal->id) }}"> Saisie individuelle </a>
                <a class="btn btn-success" href="{{ route('proces_verbaux.resultats.create2', $procesVerbal->id) }}"> Saisie groupée </a>
                @endhasrole
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Référence</th>
                            <th>Parcours</th>
                            <th>Annee académique</th>
                            <th>Etudiant</th>
                            <th>Moyenne</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultats as $resultat)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $resultat->reference }}</td>
                            <td> {{ $resultat->procesVerbal->parcours->intitule }}</td>
                            <td>{{ $resultat->procesVerbal->anneeAcademique->intitule }}</td>
                            <td>{{ $resultat->inscription->etudiant->nom.' '.$resultat->inscription->etudiant->prenom }}</td>
                            <td>{{ $resultat->moyenne }}</td>

                            <td>
                                <form action="{{ route('proces_verbaux.resultats.destroy',[$resultat->procesVerbal->id, $resultat->id]) }}" method="POST">
                                    @hasrole(['SCOLARITE'])
                                    <a class="btn btn-primary" title="corriger la moyenne" href="{{ route('proces_verbaux.resultats.edit',[$resultat->procesVerbal->id, $resultat->id]) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    @if(empty($resultat->getActeByCategorie(1)))
                                    <a class="btn btn-secondary" title="Etablir une attestation provisoire" href="{{ route('proces_verbaux.provisoires.create',$resultat->id) }}">
                                        <i class="bi bi-file-pdf"></i>
                                    </a>
                                    @endif
                                    @endhasrole
                                    @hasrole(['DAOI'])
                                    <a class="btn btn-secondary" title="Etablir une attestation définitive" href="{{ route('proces_verbaux.definitives.create', $resultat->id) }}">
                                        <i class="bi bi-clipboard-plus-fill"></i>
                                    </a>
                                    @endhasrole
                                    @csrf
                                    @method('DELETE')
                                    @hasrole(['SCOLARITE'])
                                    <button type="submit" class="btn btn-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @endhasrole
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