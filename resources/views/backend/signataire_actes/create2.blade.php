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
        @if (session('reponse'))
                <div class="alert alert-danger">
                    {{ session('reponse') }}
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
                <form method="post" action="{{ route('signataires.store1') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Categorie d'acte</label>
                        <div class="col">
                            <select class="form-control" id="categorie" name="categorieActe_id" required>
                                <option value="" selected disabled hidden>Choisir</option>
                                @foreach( $categories as $categorie)
                                <option value="{{ $categorie->id}}">{{ $categorie->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            @if(isset($etablissement))
                                <input type="hidden"  id="institution_id" name="institution_id" value="{{ $iesr->id }}">
                        
                                <input type="text" class="form-control" id="institution" name="institution" value="{{ $iesr->sigle.' | '.$iesr->parent->sigle }}" disabled>
                        
                            @else
                            <select class="form-control" id="institution" name="institution_id" required>
                                <option value=""selected disabled hidden>Choisir</option>
                                @foreach( $iesrs as $institution)
                                <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>
                                @endforeach
                            </select>
                            @endif
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
                                <option value="" disabled selected hidden>choisir ...</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Féminin">Féminin</option>
                            </select>
                        </div>
                    </div>                    

                    <div class="form-group row py-2">
                        <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                        <div class="col">
                            <select class="form-control" id="grade" name="grade">
                                <option value="" disabled selected hidden>choisir ...</option>
                                <option value="Dr">Dr</option>
                                <option value="Pr">Pr</option>

                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row py-2">
                        <label for="debut" class="col-sm-2 col-form-label">Date de début de signature </label>
                        <div class="col">
                            <input type="date" class="form-control" id="debut" name="debut" placeholder=" ..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                        <div class="col">
                            <input type="text" class="form-control" id="fonction" name="fonction" placeholder=" ..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                        <div class="col">
                            <input type="text" class="form-control" id="mention" name="mention" placeholder=" ..." required>
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
<script type="module">
    $(document).ready(function() {
        //Categorie par type institution
        $(document).on('change', '#institution', function() {
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });
    });
</script>

@endpush