@extends('layout.ample')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Ajouter un signataire') }}</h4>
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
                    <div class="col-10 offset-1">
                        <form method="post" action="{{ route('metiers.etablissements.signataire-store') }}">
                            @csrf
    

                            <div class="form-group row py-2">
                                <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder=" ..." required>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder=" ..." required>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="nip" class="col-sm-2 col-form-label">NIP (CNIB)</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="nip" name="nip" required>
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
                                        <option value="Attestation Provisoire">Attestation Provisoire</option>
                                        <option value="Attestation Definitive">Attestation Definitive</option>
                                        <option value="Diplome">Diplome</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row py-2">
                                <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="fonction" name="fonction" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="fonctionLongue" class="col-sm-2 col-form-label">Fonction longue</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="fonctionLongue" name="fonctionLongue" required>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                                <div class="col">
                                    <select class="form-control" id="grade" name="grade">
                                        <option value="" disabled selected>choisir ...</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Pr">Pr</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="titreAcademique" class="col-sm-2 col-form-label">Titre academique</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="titreAcademique" name="titreAcademique">
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="titreHonorifique" class="col-sm-2 col-form-label">Titre honorifique</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="titreHonorifique" name="titreHonorifique">
                                </div>
                            </div>



                            <div class="row py-4">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col">
                                    <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                                </div>
                                <div class="col">
                                    <a href="{{ route('signataires.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
@push('costum-scripts')

@endpush