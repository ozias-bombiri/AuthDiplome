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
                <h3 class="box-title mb-0">{{ __('Modfier un signataire') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('signataires.update', $sign_acte->id) }}">
                    @csrf
                    <input type="hidden" id="signataireActe_id" name="signataireActe_id" value=" {{$sign_acte->id}}">
                    <input type="hidden" id="signataire_id" name="signataire_id" value=" {{$sign_acte->signataire->id}}">
                    <input type="hidden" id="institution_id" name="institution_id" value=" {{$sign_acte->institution->id}}">
                    <input type="hidden" id="categorieActe_id" name="categorieActe_id" value=" {{$sign_acte->categorieActe->id}}">
                         
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Categorie d'acte</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="categorieActe_id" value=" {{$sign_acte->categorieActe->intitule}}" disabled>                            
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                        <input type="text" class="form-control" id="nom" name="institution" value=" {{$sign_acte->institution->sigle}}" disabled>
                        
                        </div>
                    </div>

                    
                    <div class="form-group row py-2">
                        <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $sign_acte->signataire->nom }}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $sign_acte->signataire->prenom }}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="nip" class="col-sm-2 col-form-label">NIP (CNIB)</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ $sign_acte->signataire->nip }}" required>
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
                            <input type="date" class="form-control" id="debut" name="debut" value="{{ $sign_acte->debut }}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="statut" class="col-sm-2 col-form-label">Statut </label>
                        <div class="col">
                            <input type="checkbox" id="statut" name="statut" @if($sign_acte->statut) checked @endif  >
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                        <div class="col">
                            <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $sign_acte->fonction }}" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                        <div class="col">
                            <input type="text" class="form-control" id="mention" name="mention" value="{{ $sign_acte->mention }}">
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="titreAcademique" class="col-sm-2 col-form-label">Titre academique</label>
                        <div class="col">
                            <input type="text" class="form-control" id="titreAcademique" name="titreAcademique" value="{{ $sign_acte->signataire->titreAcademique }}">
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="titreHonorifique" class="col-sm-2 col-form-label">Titre honorifique</label>
                        <div class="col">
                            <input type="text" class="form-control" id="titreHonorifique" name="titreHonorifique" value="{{ $sign_acte->signataire->titreHonorifique }}">
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