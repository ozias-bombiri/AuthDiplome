@extends('layouts.ample')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Détails attestation provisoire') }}</h4>
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
                        
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                    <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Référence </td>
                                    <td>{{ $attestation->reference }}</td>
                                </tr>
                                <tr>
                                    <td>Intitulé</td>
                                    <td>{{ $attestation->intitule }}</td>
                                </tr>
                                <tr>
                                    <td>Impétrant</td>
                                    <td>
                                        Identifiant : {{ $attestation->resultat_academique->impetrant->identifiant }} <br/>
                                        Nom et Prénom : {{ $attestation->resultat_academique->impetrant->nom }} {{ $attestation->resultat_academique->impetrant->prenom }}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Parcours de formation </td>
                                    <td>{{ $attestation->resultat_academique->parcours->intitule }} </td>
                                </tr>
                                <tr>
                                    <td>Niveau d'étude </td>
                                    <td>{{ $attestation->resultat_academique->parcours->niveau_etude->intitule }}</td>
                                </tr>
                                <tr>
                                    <td>Institution </td>
                                    <td>{{ $attestation->resultat_academique->parcours->institution->denomination }} </td>
                                </tr>
                                <tr>
                                    <td>Résultats académiques </td>
                                    <td>
                                        Session : {{ $attestation->resultat_academique->session }} <br/>
                                        Moyenne : {{ $attestation->resultat_academique->moyenne }} <br/>
                                        Cote : {{ $attestation->resultat_academique->cote }} <br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>
                                        <a class="btn btn-info" title="Voir pdf" href="{{ route('metiers.etablissements.attestation-pdf', $attestation->id) }}">
                                            <i class="bi bi-file-pdf"></i>
                                        </a>
                                                                                 
                                    </td>
                                </tr>
                                
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
