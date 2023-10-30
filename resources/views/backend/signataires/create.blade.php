@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un signataire') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un signataire') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('signataires.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="iesr" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            <select class="form-control" id="iesr" name="institution_id" required>
                                <option value="">Choisir</option>
                                @foreach( $institutions as $institution)
                                <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>
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

@endsection

@push('costum-scripts')

@endpush