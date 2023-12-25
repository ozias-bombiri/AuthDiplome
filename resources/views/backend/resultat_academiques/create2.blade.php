@extends('layouts.ample')

@section('page-title')
{{ __('Saisir des résultats académiques') }}
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
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">{{ __('Saisir des résultats académiques') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('proces_verbaux.resultats.store2', $procesVerbal->id) }}">
                    @csrf                   

                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="parcours" name="parcours" value="{{ $procesVerbal->parcours->intitule }}" disabled>                        
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="annee" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="annee" name="annee" value="{{ $procesVerbal->anneeAcademique->intitule }}" disabled>
                        </div>
                    </div>
                    <table id="example1" class="table table-head-fixed text-nowrap table-bordered
                            table-hover">
                                <thead>
                                <tr style="background-color:gainsboro">
                                    <th>N°</th>
                                    <th style="text-align: center; width:20%";>Matricule</th>
                                    <th style="text-align: center">Nom et prénoms</th>
                                    <th style="text-align: center; width:10%">Moyenne</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1
                                    @endphp
                                    @foreach($inscriptions as $inscription)
                                        @if ($inscription->moyenne($inscription->id) == null)
                                        <tr>
                                            <td style=" width:5%">{{($index)}}</td>
                                            <td style=" width:20%">{{ $inscription->etudiant->identifiant}}</td>
                                            <td>{{ $inscription->etudiant->nom.' '.$inscription->etudiant->prenom}}</td>
                                            <td style="text-align: center; width:10%">
                                                <input type="number" class="form-control form-control" 
                                                id="{{ 'moyenne'.$inscription->id }}" name="moyenne[{{$inscription->id}}]" 
                                                value="{{$inscription->moyenne($inscription->id)}}"
                                                step="0.01" max="20" min="10">       
                                            </td>
                                        </tr>

                                        {{ $index++ }}
                                        @else
                                            <tr hidden>
                                                <td style=" width:5%">{{($index)}}</td>
                                                <td style=" width:20%">{{ $inscription->etudiant->identifiant}}</td>
                                                <td>{{ $inscription->etudiant->nom.' '.$inscription->etudiant->prenom}}</td>
                                                <td style="text-align: center; width:10%">
                                                    <input type="number" class="form-control form-control" 
                                                    id="{{ 'moyenne'.$inscription->id }}" name="moyenne[{{$inscription->id}}]" 
                                                    value="{{$inscription->moyenne($inscription->id)}}"
                                                    step="0.01" max="20" min="0">       
                                                </td>
                                            </tr>
                                        @endif
                                    
                                    @endforeach
                                </tbody>
                            </table>
                    <div class="row py-4" >
                        <!-- <label class="col-sm-2 col-form-label"></label> -->
                        <div class="col">
                            <button type=" submit button" class="btn btn-success" style="float:right">
                                Enregsitrer
                            </button>
                        </div>
                        <div class="col">
                            <a href="{{ route('resultat_academiques.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')

@endpush