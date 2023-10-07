@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Gestion des roles') }}</h4>
            </div>

            <div class="card-body">
                <div class="row my-3">

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
                <div class="row my-3">
                    <div class="col-3 offset-1">
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-info" title="Détails" href="{{ route('roles.show',$role->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            @can('role-edit')
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('roles.edit',$role->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @endcan

                                            @can('role-delete')
                                            <button type="submit" class="btn btn-danger" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endcan
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
</div>

@endsection
@push('costum-scripts')

<!-- Core theme JS-->
<script type="module" src="{{URL::asset('/assets/datatables.js/datatable.min.js')}}"></script>

<script type="module">
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>

@endpush