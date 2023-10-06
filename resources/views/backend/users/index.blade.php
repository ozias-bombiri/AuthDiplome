@extends('includes.master')

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
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Voir les roles</a> 
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Ajouter un role utilisateur</a> <br /><br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-bordered table-responsive">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($utilisateurs as $utilisateur)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $utilisateur->name }}</td>
                                <td>{{ $utilisateur->email }}</td>
                                <td>
                                    @if(!empty($utilisateur->getRoleNames()))
                                        @foreach($utilisateur->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
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