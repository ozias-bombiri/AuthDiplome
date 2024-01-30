@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
    Roles utilisateurs
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
            <h3 class="box-title">Roles utilisateurs </h3>
            
            <div class="table-responsive">
            <table id="data" class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nom de role</th>
                                    <th>Attributions possibles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if(!empty($role->permissions))
                                            @foreach($role->permissions as $permission)
                                                <label class="bg-secondary badge">{{ $permission->name }}</label>
                                            @endforeach
                                        @endif
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
