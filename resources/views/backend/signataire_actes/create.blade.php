@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un signataire d\'acte') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un signataire d\'acte') }}</h3>
                <div class="">

                </div>   
            </div>
            <div class="">
                <form method="post" action="{{ route('signataire_actes.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Categorie acte</label>
                        <div class="col">
                            <select class="form-control" id="categorieActe_id" name="categorieActe_id" required>
                                @foreach( $categories as $categorie)
                                <option value="{{ $categorie->id}}">{{ $categorie->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                    <label for="signataire" class="col-sm-2 col-form-label">Signataire</label>
                        <div class="col">
                            <select class="form-control" id="signataire" name="signataire_id" required>
                                @foreach( $signataires as $signataire)
                                <option value="{{ $parcour->id}}">{{ $signataire->nom }} {{ $signataire->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution </label>
                        <div class="col">
                            <select class="form-control" id="institution" name="institution_id" required>
                                @foreach( $institutions as $institution)
                                <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row py-2">
                        <label for="statut" class="col-sm-2 col-form-label">Statut</label>
                        <div class="col">
                            <input type="radio" value="1" id="statut" name="statut"> Activé <br>
                            <input type="radio" value="0" id="statut" name="statut"> Desactivé
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="debut" class="col-sm-2 col-form-label">Date de debut</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="debut" name="debut" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="fin" class="col-sm-2 col-form-label">Date de fin</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="fin" name="fin" required>
                        </div>
                    </div>


                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('signataire_actes.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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