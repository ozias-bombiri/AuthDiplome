@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Attestations provisoires') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('metiers.etablissements.attestation-add', auth()->user()->institution_id) }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                    <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Référence</th>
                                    <th>Intitule</th>
                                    <th>Identifiant de l'impétrant</th>
                                    <th>Nom Prénom </th> 
                                    <th>Parcours (Niveau d'étude)</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attestations as $attestation)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $attestation->reference }}</td>
                                    <td>{{ $attestation->intitule }}</td>
                                    <td>{{ $attestation->resultat_academique->impetrant->identifiant }} </td>
                                    <td>{{ $attestation->resultat_academique->impetrant->nom }} {{ $attestation->resultat_academique->impetrant->prenom }}</td>
                                    <td>{{ $attestation->resultat_academique->parcours->intitule }} ({{ $attestation->resultat_academique->parcours->niveau_etude->intitule }})</td>
                                    <td>
                                        <a class="btn btn-info" title="Détails" href="#">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a class="btn btn-primary" title="Modifier" href="#">
                                            <i class="bi bi-pencil"></i>
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
</div>

@endsection
@push('costum-scripts')

@endpush
