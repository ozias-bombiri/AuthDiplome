@extends('layouts.ample')

@section('page-title')
{{ __('Créer un acte académique') }}
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
                <h3 class="box-title mb-0">{{ __('Créer un acte académique') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('acte_academiques.store') }}">
                    @csrf
                    <input type="hidden"  id="resultat_id" name="resultat_id" value="{{ $resultat->id }}">
                    <input type="hidden"  id="categorieActe_id" name="categorieActe_id" value="{{ $categorieActe->id }}">
                    
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Acte académique</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="categorie" name="categorie" value="{{ $categorieActe->intitule }}"  disabled>
                        </div>
                    </div>
                    <div class="form-group row py-2">                        
                        <label for="etudiant" class="col-sm-2 col-form-label">Identifiant étudiant</label>
                        <div class="col">
                            <input type="text" class="form-control " id="identifiant" name="identifiant" value="{{ $etudiant->identifiant }}"  disabled>
                        </div>                        
                    </div>
                    <div class="form-group row py-2">                        
                        <label for="etudiant" class="col-sm-2 col-form-label">Nom Prénom</label>
                        <div class="col">
                            <input type="text" class="form-control " id="etudiant" name="etudiant" value="{{ $etudiant->nom.' '.$etudiant->prenom }}"  disabled>
                        </div>                        
                    </div>

                    <div class="form-group row py-2">
                        <label for="signataire" class="col-sm-2 col-form-label">Signataire</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="signataire" name="signataire" value="{{ $signataireActe->signataire->nom.' '.$signataireActe->signataire->prenom }}"  disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="resultat" class="col-sm-2 col-form-label">Moyenne</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="resultat" name="resultat" value="{{ $resultat->moyenne }}"  disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="lieu" class="col-sm-2 col-form-label">Fait à</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="lieu" name="lieu" placeholder="Lieu" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="dateSignature" class="col-sm-2 col-form-label">Date de signature</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateSignature" name="dateSignature" placeholder="..." required>
                        </div>
                    </div>                   

                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('acte_academiques.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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