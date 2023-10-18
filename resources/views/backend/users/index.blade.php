@extends('includes.master')

@push('custom-styles')
<link href="{{ URL::asset('/assets/css/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Utilisateurs') }}</h4>
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
                    <div class="col-8 offset-1">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Créer un utilisateur </a>
                        <a class="btn btn-success" href="{{ route('roles.index') }}"> Voir les roles</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Statut</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($utilisateurs as $utilisateur)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $utilisateur->name }}</td>
                                    <td>{{ $utilisateur->email }}</td>
                                    <td>

                                        @if(!empty($utilisateur->getRoleNames()))
                                        @foreach($utilisateur->getRoleNames() as $v)

                                        <label class="bg-success badge">{{ $v }}</label>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $utilisateur->statut }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy',$utilisateur->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-info" title="Détails" href="{{ route('users.show',$utilisateur->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('users.edit',$utilisateur->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
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