@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
    Utilisateurs
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
            <h3 class="box-title">Utilisateurs </h3>
            <div class="col-4 offset-6 mb-5">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Créer un utilisateur </a>
                <a class="btn btn-success" href="{{ route('roles.index') }}"> Voir les roles</a>
            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nom Prénom</th>
                            <th>Email</th>
                            <th>Institution</th>
                            <th>Statut</th>                            
                            <th>Roles</th>
                            <th>Attributions</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($utilisateurs as $utilisateur)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td> @if(!empty($utilisateur->institution)) {{ $utilisateur->institution->sigle }} @else - @endif
                            <td>{{ $utilisateur->statut }}</td>
                            
                            <td>

                                @if(!empty($utilisateur->getRoleNames()))
                                    @foreach($utilisateur->getRoleNames() as $v)
                                        <label class="bg-success badge">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>

                                @if(!empty($utilisateur->permissions))
                                    @foreach($utilisateur->permissions as $v)
                                        <label class="bg-secondary badge">{{ $v->name }}</label> <br/>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('users.destroy',$utilisateur->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
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