@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un rétrait d\'acte') }}
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
                <h3 class="box-title mb-0">{{ __('Remettre un acte') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('actes.provisoires.retirer.store', $acte->id) }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="acte_id" class="col-sm-2 col-form-label">Acte academique</label>
                        <div class="col">
                            <input type="hidden" id="acte_id" name="acteAcademique_id" value="{{ $acte->id }}" >
                            <input type="text" class="form-control" id="acte" name="acte" value="{{ $acte->reference }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                        <div class="col">
                            <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $acte->intitule }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="impetrant" class="col-sm-2 col-form-label">Iméptrant</label>
                        <div class="col">
                            <input type="text" class="form-control" id="impetrant" name="impetrant" value="{{ $acte->resultatAcademique->inscription->etudiant->identifiant. ' | '.$acte->resultatAcademique->inscription->etudiant->nom.' '.$acte->resultatAcademique->inscription->etudiant->prenom }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="dateRetrait" class="col-sm-2 col-form-label">Date de retrait</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateRetrait" name="dateRetrait" required>
                        </div>
                    </div>
                

                    <div class="form-group row py-2">
                        <label for="retirant" class="col-sm-2 col-form-label">Retirant</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="retirant" name="retirant" required>
                        </div>
                    </div>

                  
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('actes.provisoires.retrait') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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