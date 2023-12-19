@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('visa pour diplome') }}
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
            <h3 class="box-title">{{ __('Visa pour diplome') }} </h3>
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('visa_diplomes.create') }}"> Ajouter </a>
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Visa</th>
                            <th>Visa institution</th>
                            <th>Ordre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visa_diplomes as $visa_diplome)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $visa_diplome->visa->intitule }}</td>
                            <td>{{ $visa_diplome->visaInstitution->intitule }}</td>
                            <td>{{ $visa_diplome->type }}</td>

                            
                            <td>
                                <form action="{{ route('visa_diplomes.destroy',$visa_diplome->id) }}" method="POST">
                                    <a class="btn btn-info" title="Détails" href="{{ route('visa_diplomes.show',$visa_diplome->id) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a class="btn btn-primary" title="Modifier" href="{{ route('visa_diplomes.edit',$visa_diplome->id) }}">
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