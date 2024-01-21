@extends('layouts.ample')

@section('page-title')
{{ __('Détails inscriptions') }}
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
                <h3 class="box-title mb-0">{{ __("Détails de l'inscription") }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            <input type="text" class="form-control" id="parcours" name="parcours_id" value="{{ $inscription->parcours->intitule }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="anneeAcademiques" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <input type="text" class="form-control" id="annee" name="annee" value="{{ $inscription->anneeAcademique->intitule }}" disabled>
                        
                        </div>
                    </div>

                    <div>
                        
                        <div class="form-group row py-2">
                            <label for="identifiant" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col">
                                <input type="text" class="form-control" id="identifiant" name="identifiant" value="{{ $inscription->etudiant->typeIdentifiant.' | '.$inscription->etudiant->identifiant }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="nom" class="col-sm-2 col-form-label">Nom et prénom </label>
                            <div class="col">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $inscription->etudiant->nom.'  '.$inscription->etudiant->prenom }}" disabled>
                            </div>
                        </div>

                        

                        <div class="form-group row py-2">
                            <label for="sexe" class="col-sm-2 col-form-label">Sexe </label>
                            <div class="col">
                            <input type="text" class="form-control" id="sexe" name="sexe" value="{{ $inscription->etudiant->sexe }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                            <div class="col">
                            @if(! $inscription->etudiant->nevers) 
                            <input type="texte" class="form-control form-control" id="dateNaissance" name="dateNaissance" value="{{'le '. \Carbon\Carbon::parse($inscription->etudiant->dateNaissance)->translatedFormat('d F Y') }}" disabled>                      
                                
                            @else
                            <input type="texte" class="form-control form-control" id="dateNaissance" name="dateNaissance" value="{{'en '. \Carbon\Carbon::parse($inscription->etudiant->dateNaissance)->translatedFormat('Y') }}" disabled>                          
                                
                            @endif
                            </div>

                        </div>
                        <div class="form-group row py-2">
                            <label for="lieuNaissance" class="col-sm-2 col-form-label">Lieu de naissance</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="lieuNaissance" name="lieuNaissance" value="{{ $inscription->etudiant->lieuNaissance }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="paysNaissance" class="col-sm-2 col-form-label">Pays de naissance</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="paysNaissance" name="paysNaissance" value="{{ $inscription->etudiant->paysNaissance }}" disabled>
                            </div>
                        </div>

                    </div>

                        <div class="col">
                            <a href="{{ route('parcours.inscriptions.index', $inscription->parcours->id) }}"> <button type="button" class="btn btn-secondary">Retour</button> </a>
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