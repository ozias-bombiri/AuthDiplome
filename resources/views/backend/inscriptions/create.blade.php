@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un résultat académique') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un résultat académique') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('resultat_academiques.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="etudiant" class="col-sm-2 col-form-label">Etudiant</label>
                        <div class="col">
                            <select class="form-control" id="impetrant_id" name="impetrant_id" required>
                                @foreach( $etudiants as $etudiant)
                                <option value="{{ $etudiant->id}}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            <select class="form-control" id="parcour" name="parcours_id" required>
                                @foreach( $parcours as $parcour)
                                <option value="{{ $parcour->id}}">{{ $parcour->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="anneeAcademiques" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <select class="form-control" id="parcour" name="anneeAcademique_id" required>
                                @foreach( $anneeAcademiques as $anneeAcademique)
                                <option value="{{ $anneeAcademique->id}}">{{ $anneeAcademique->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="reference" class="col-sm-2 col-form-label">Reference</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="reference" name="reference" placeholder="Reference" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="soutenance" class="col-sm-2 col-form-label">Soutenu</label>
                        <div class="col">
                            <input type="radio" value="1" id="soutenance" name="soutenance"> Oui <br>
                            <input type="radio" value="0" id="soutenance" name="soutenance"> Non
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="dateSignature" class="col-sm-2 col-form-label">Date de signature</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateSignature" name="dateSignature" placeholder="..." required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="moyenne" class="col-sm-2 col-form-label">La moyenne</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="moyenne" name="moyenne" placeholder="..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="cote" class="col-sm-2 col-form-label">Cote</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="cote" name="cote" required>
                        </div>
                    </div>


                    <div class="form-group row py-2">
                        <label for="session" class="col-sm-2 col-form-label">La session</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="session" name="session" required>
                        </div>
                    </div>


                    <div class="form-group row py-2">
                        <label for="dateSoutenance" class="col-sm-2 col-form-label">Date de soutenance</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateSoutenance" name="dateSoutenance" required>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
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