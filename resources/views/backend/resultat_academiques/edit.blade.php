@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un résultat académique') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier un résultat académique') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('proces_verbaux.resultats.update', [$resultat->procesVerbal->id, $resultat->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row py-2">
                        <label for="etudiant" class="col-sm-2 col-form-label">Etudiant</label>
                        <div class="col">
                            <input type="hidden"  id="inscription_id" name="inscription_id" value="{{ $resultat->inscription->id }}">
                            <input type="text" class="form-control" id="inscription" name="inscription" value = "{{ $resultat->inscription->etudiant->identifiant.' | '.$resultat->inscription->etudiant->nom.' '.$resultat->inscription->etudiant->prenom }}" disabled>
                        
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="parcours" name="parcours" value="{{ $resultat->procesVerbal->parcours->intitule }}" disabled>                        
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="annee" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="annee" name="annee" value="{{ $resultat->procesVerbal->anneeAcademique->intitule }}" disabled>
                        </div>
                    </div>                    

                    <div class="form-group row py-2">
                        <label for="moyenne" class="col-sm-2 col-form-label">Moyenne</label>
                        <div class="col">
                            <input type="number" class="form-control" id="moyenne" name="moyenne" value="{{ $resultat->moyenne }}" step="0.01" max="20" min="10" required>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('proces_verbaux.resultats.index', $resultat->procesVerbal->id) }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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