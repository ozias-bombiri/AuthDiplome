@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('Filieres') }}
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
            <h3 class="box-title">{{ __('Filieres') }} </h3>
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('filieres.create') }}"> Ajouter </a>
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Institution</th>
                            <th>Code</th>
                            <th>Sigle</th>
                            <th>Intitulé</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach ($filieres as $filiere)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $filiere->institution->sigle.' | '.$filiere->institution->parent->sigle}}</td>
                            <td>{{ $filiere->code }}</td>
                            <td>{{ $filiere->sigle }}</td>
                            <td>{{ $filiere->intitule }}</td>                    
                           
                            <td>
                                
                                <a class="btn btn-primary" title="Modifier" href="{{ route('filieres.edit',$filiere->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a class="btn btn-primary" title="Ajouter un parcours" href="{{ route('parcours.create',['filiere_id' =>$filiere->id]) }}">
                                    <i class="bi bi-plus"></i>
                                </a>  
                                <a class="btn btn-info" title="Voir les parcours" href="{{ route('parcours.index',['filiere_id' =>$filiere->id]) }}">
                                    <i class="bi bi-eye-fill"></i>
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