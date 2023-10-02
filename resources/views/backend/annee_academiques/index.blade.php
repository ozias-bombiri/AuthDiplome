@extends('includes.master')

@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Années academiques') }}</div>

    <div class="card-body">
        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('annee_academiques.create') }}"> Ajouter</a>

        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="15%">Intitule</th>
                        <th scope="col">Début</th>
                        <th scope="col" width="15%">Fin</th>
                        <th scope="col" width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($annees as $annee)
                    <tr>
                        <th scope="row">{{ $loop->index +1 }}</th>
                        <td>{{ $annee->intitule }}</td>
                        <td>{{ $annee->debut }}</td>
                        <td>{{ $annee->fin }}</td>
                        <td>
                            <div class='btn-group'>
                                <a data-tooltip="Détails" href="{{ route('annee_academiques.show', $annee->id) }}" class='data-tooltip btn btn-success mx-1'>
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a data-tooltip="Modifier" href="{{ route('annee_academiques.edit', $annee->id) }}" class='data-tooltip btn btn-info mx-1'>
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('annee_academiques.destroy', $annee->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger delete-btn data-tooltip delete-btn mx-1" data-tooltip="Supprimer" href="{{ route('annee_academiques.destroy', $annee->id) }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $annees->links() !!}
            </div>
        </div>

    </div>
</div>
@endsection

@push('costum-scripts')

@endpush