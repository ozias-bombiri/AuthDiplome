@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('Visas de diplômes') }}
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
            <h3 class="box-title">{{ __('Visas pour les diplômes des institutions') }} </h3>
            <div class="col-6 offset-6 mb-5">
                <a class="btn btn-success" href="{{ route('visas.index') }}"> Voir les visas (textes) </a>
                <a class="btn btn-success" href="{{ route('visa_institutions.create') }}"> Créer visas pour une institution</a>
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Institution</th>                           
                            <th>Intitule</th>
                            <th>Catégorie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visaInstitutions as $visaInstitution)
                        <tr>  
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $visaInstitution->institution->sigle }}</td>
                            <td>{{ $visaInstitution->intitule }}</td>                            
                            <td>{{ $visaInstitution->categorieActe->intitule }}</td>           
                            
                            <td>
                                <form action="{{ route('visa_institutions.destroy',$visaInstitution->id) }}" method="POST">

                                    <a class="btn btn-info" title="Voir les visas" href="{{ route('visa_institutions.show',$visaInstitution->id) }}">
                                        <i class="bi bi-eye-fill"></i>
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