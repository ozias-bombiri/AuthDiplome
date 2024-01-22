@extends('layouts.ample')

@section('page-title')
    {{ __('Créer un acte académique (Diplômes)') }}
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
                    <h3 class="box-title mb-0">{{ __('Créer les diplomes du procès verbal : ') }} <span
                            style="color: red">{{ $pv->reference }}</span></h3>
                    <div class="">

                    </div>
                </div>
                <div class="">
                    <form method="post" action="{{ route('proces_verbaux.diplomes.store') }}">
                        @csrf
                        <input type="hidden" id="procesVerbal_id" name="procesVerbal_id" value="{{ $procesVerbal_id }}">
                        <input type="hidden" id="categorieActe_id" name="categorieActe_id"
                            value="{{ $categorieActe->id }}">

                        <div class="form-group row py-2">
                            <label for="signataire" class="col-sm-2 col-form-label">Informations</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="infos" name="infos"
                                    value="{{ $pv->parcours->filiere->institution->denomination }} | {{ $pv->parcours->filiere->intitule }} | {{ $pv->parcours->intitule }} | {{ $pv->parcours->niveauEtude->intitule }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="categorie" class="col-sm-2 col-form-label">Acte académique</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="categorie" name="categorie"
                                    value="{{ $categorieActe->intitule }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="signataire" class="col-sm-2 col-form-label">Signataire</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="signataire" name="signataire"
                                    value="{{ $signataireActe != null ? $signataireActe->signataire->nom . ' ' . $signataireActe->signataire->prenom : 'Pas de signataire associé' }}"
                                    disabled required>
                            </div>
                        </div>


                        <div class="form-group row py-2">
                            <label for="dateSignature" class="col-sm-2 col-form-label">Date de signature</label>
                            <div class="col">
                                <input type="date" class="form-control form-control" id="dateSignature"
                                    name="dateSignature" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="lieu" class="col-sm-2 col-form-label">Fait à</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="lieu" name="lieu"
                                    placeholder="Lieu" required>
                            </div>
                        </div>

                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                @if ($signataireActe != null)
                                    <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                                @endif

                            </div>
                            <div class="col">
                                <a href="{{ route('acte_academiques.index') }}"> <button type="button"
                                        class="btn btn-danger">Annuler</button> </a>
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
