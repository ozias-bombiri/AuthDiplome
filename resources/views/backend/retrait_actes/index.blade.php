@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('Rétrait actes') }}
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
            <h3 class="box-title">{{ __('Rétrait d\'actes') }} </h3>
            <div class="col-2 offset-10 mb-5">
                
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Référence</th>
                            <th>Acte academique</th>
                            <th>Impétrant</th>
                            <th>Date retrait</th>
                            <th>Retirant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($retraits as $retrait)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $retrait->reference }}</td>
                            <td>{{ $retrait->acteAcademique->intitule }}</td>
                            <td> {{ $retrait->acteAcademique->resultatAcademique->inscription->etudiant->identifiant.' | '.$retrait->acteAcademique->resultatAcademique->inscription->etudiant->nom. ' '.$retrait->acteAcademique->resultatAcademique->inscription->etudiant->prenom }}</td>
                            <td>{{ $retrait->dateRetrait }}</td>
                            <td>{{ $retrait->retirant }}</td>

                            
                            <td>
                                <form action="{{ route('retrait_actes.destroy',$retrait->id) }}" method="POST">
                                    <a class="btn btn-info" title="Détails" href="{{ route('retrait_actes.show',$retrait->id) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a class="btn btn-primary" title="Modifier" href="{{ route('retrait_actes.edit',$retrait->id) }}">
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