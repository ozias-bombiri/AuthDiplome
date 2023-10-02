@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un timbre établissement') }}</div>

            <div class="card-body">

                <div class="table-responsive">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('timbre_etablissements.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="iesr" class="col-sm-2 col-form-label">Iesr</label>
                            <div class="col">
                                <select  class="form-control" id="iesr" name="iesr_id" required>
                                    @foreach( $iesrs as $iesr)
                                        <option value="{{ $iesr->id}}">{{ $iesr->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder=" ..." required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
                            <div class="col">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder=" ..." required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="nip" class="col-sm-2 col-form-label">NIP (CNIB)</label>
                            <div class="col">
                                <input type="text" class="form-control" id="nip" name="nip"  required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="type" class="col-sm-2 col-form-label">Sexe</label>
                            <div class="col">
                                <select class="form-control" id="sexe" name="sexe">
                                    <option value="" disabled selected>choisir ...</option>
                                    <option value="masculin">Masculin</option>
                                    <option value="feminin">Féminin</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="type" class="col-sm-2 col-form-label">Type de document</label>
                            <div class="col">
                                <select class="form-control" id="typeDocument" name="typeDocument">
                                    <option value="" disabled selected>choisir ...</option>
                                    <option value="provisoire">Provisoire</option>
                                    <option value="definitive">Definitive</option>
                                    <option value="diplome">Diplome</option>
                                </select>                            
                            </div>
                        </div>


                        <div class="form-group row py-2">
                            <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                            <div class="col">
                                <input type="text" class="form-control" id="fonction" name="fonction"  required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="fonctionLongue" class="col-sm-2 col-form-label">Fonction longue</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="fonctionLongue" name="fonctionLongue"  required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                            <div class="col">
                                <input type="text" class="form-control" id="grade" name="grade" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="titreAcademique" class="col-sm-2 col-form-label">Titre academique</label>
                            <div class="col">
                                <input type="text" class="form-control" id="titreAcademique" name="titreAcademique" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="titreHonorifique" class="col-sm-2 col-form-label">Titre honorifique</label>
                            <div class="col">
                                <input type="text" class="form-control" id="titreHonorifique" name="titreHonorifique" required>
                            </div>
                        </div>
                        
                       
                       
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('timbre_etablissements.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                            </div>

                        </div>
                        
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('costum-scripts')

@endpush