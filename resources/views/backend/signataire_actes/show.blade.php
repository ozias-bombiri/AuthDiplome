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
                <h3 class="box-title mb-0">{{ __('Informations du signataire') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                
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
                        <label for="nom" class="col-sm-2 col-form-label">Signataire </label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $sign_acte->signataire->grade.' '.$sign_acte->signataire->nom.' '.$sign_acte->signataire->prenom }}" disabled>
                        </div>
                    </div>         

                    <div class="form-group row py-2">
                        <label for="grade" class="col-sm-2 col-form-label">Statut </label>
                        <div class="col">
                        @if( $sign_acte->statut)
                            <input type="text" class="form-control" id="nom" name="nom" value="Actif" disabled>
                        @else 
                            <input type="text" class="form-control" id="nom" name="nom" value="Désactivé" disabled>
                        
                        @endif
                        </div>
                    </div>
                    
                    <div class="form-group row py-2">
                        <label for="debut" class="col-sm-2 col-form-label">Date de début de signature </label>
                        <div class="col">
                            <input type="date" class="form-control" id="debut" name="debut" value="{{ $sign_acte->debut }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="fonction" class="col-sm-2 col-form-label">Fonction</label>
                        <div class="col">
                            <input type="text" class="form-control" id="fonction" name="fonction" value="{{ $sign_acte->fonction }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                        <div class="col">
                            <input type="text" class="form-control" id="mention" name="mention" value="{{ $sign_acte->mention }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="titreAcademique" class="col-sm-2 col-form-label">Titre academique</label>
                        <div class="col">
                            <input type="text" class="form-control" id="titreAcademique" name="titreAcademique" value="{{ $sign_acte->signataire->titreAcademique }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="titreHonorifique" class="col-sm-2 col-form-label">Titre honorifique</label>
                        <div class="col">
                            <input type="text" class="form-control" id="titreHonorifique" name="titreHonorifique" value="{{ $sign_acte->signataire->titreHonorifique }}" disabled>
                        </div>
                    </div>



                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        
                        <div class="col">
                            <a href="{{ route('signataires.index') }}"> <button type="button" class="btn btn-secondary">Retour</button> </a>
                        </div>

                    </div>

                

            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')
<script type="module">
    $(document).ready(function() {
        
    });
</script>

@endpush