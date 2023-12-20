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
                <h3 class="box-title mb-0">{{ __('Ajouter un acte académique') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('acte_academiques.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="etudiant" class="col-sm-2 col-form-label">Résultats</label>
                        <div class="col">
                            <select class="form-control" id="resultatAcademique" name="resultatAcademique_id" required>
                                @foreach( $resultats as $resultat)
                                <option value="{{ $resultat->id}}">{{ $resultat->reference }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="signataireActe" class="col-sm-2 col-form-label">Signataire acte</label>
                        <div class="col">
                            <select class="form-control" id="signataireActe" name="signataireActe_id" required>
                                @foreach( $signataireActes as $signataireActe)
                                <option value="{{ $signataireActe->id}}">{{ $signataireActe->statut }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="categorieActe" class="col-sm-2 col-form-label">Catégorie</label>
                        <div class="col">
                            <select class="form-control" id="categorieActe" name="categorieActe_id" required>
                                @foreach( $categories as $categorie)
                                <option value="{{ $categorie->id}}">{{ $categorie->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="Intitulé" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="reference" class="col-sm-2 col-form-label">Reference</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="reference" name="reference" placeholder="Reference" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="numero" class="col-sm-2 col-form-label">Numero</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="numero" name="numero" placeholder="..." required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="lieu" class="col-sm-2 col-form-label">Lieu</label>
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

                    <div class="form-group row py-2">
                        <label for="statutSignature" class="col-sm-2 col-form-label">Statut signature</label>
                        <div class="col">
                            <input type="radio" value="1" id="statutSignature" name="statutSignature"> Signé <br>
                            <input type="radio" value="0" id="statutSignature" name="statutSignature"> Non signé
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="statutRemise" class="col-sm-2 col-form-label">Statut Remise</label>
                        <div class="col">
                            <input type="radio" value="1" id="statutRemise" name="statutRemise"> Oui <br>
                            <input type="radio" value="0" id="statutRemise" name="statutRemise"> Non
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="validite" class="col-sm-2 col-form-label">Validite</label>
                        <div class="col">
                            <input type="radio" value="1" id="validite" name="validite"> Oui <br>
                            <input type="radio" value="0" id="validite" name="validite"> Non
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