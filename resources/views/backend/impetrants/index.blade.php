@extends('includes.master')

@push('custom-styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">  
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Impétrants') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('impetrants.create') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered table-responsible">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Identifiant</th>
                                    <th>Nom </th>
                                    <th>Prénom</th>
                                    <th>Date de naissance</th>
                                    <th>Lien de naissance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impetrants as $impetrant)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $impetrant->identifiant }}</td>
                                    <td>{{ $impetrant->nom }}</td>
                                    <td>{{ $impetrant->prenom }}</td>

                                    <td>{{ \Carbon\Carbon::parse($impetrant->dateNaissance)->translatedFormat('d F Y') }}</td>
                                    <td> {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance}}) </td>
                                    <td>
                                        <form action="{{ route('impetrants.destroy',$impetrant->id) }}" method="POST">
                                            <a class="btn btn-info" title="Détails" href="{{ route('impetrants.show',$impetrant->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('impetrants.edit',$impetrant->id) }}">
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