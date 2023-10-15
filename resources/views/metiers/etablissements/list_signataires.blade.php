@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('List des signataires') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('metiers.etablissements.signataire-add') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                    <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Fonction</th> 
                                    <th>Tyde de document signé</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($signataires as $signataire)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $signataire->nom }}</td>
                                    <td>{{ $signataire->prenom }}</td>
                                    <td>{{ $signataire->fonction }}</td>
                                    <td>{{ $signataire->typeDocument }}</td>
                                    <td>
                                        <form action="{{ route('signataires.destroy',$signataire->id) }}" method="POST">
                                            <a class="btn btn-info" title="Détails" href="{{ route('signataires.show',$signataire->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('signataires.edit',$signataire->id) }}">
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

@endpush
