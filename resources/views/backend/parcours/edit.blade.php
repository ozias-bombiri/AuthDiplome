@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un parcours de formation') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier un parcours de formation') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('parcours.update', $parcours->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row py-2">
                        <label for="etablissement" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            <select class="form-control" id="institution" name="institution_id" required>
                                @foreach( $etablissements as $etablissement)
                                <option value="{{ $etablissement->id}}">{{ $etablissement->sigle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé du parcours</label>
                        <div class="col">
                            <input type="text" class="form-control" id="intitule" name="intitule" placeholder="Lettres modernes" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="domaine" class="col-sm-2 col-form-label">Domaine</label>
                        <div class="col">
                            <input type="text" class="form-control" id="domaine" name="domaine" placeholder=" ..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                        <div class="col">
                            <input type="text" class="form-control" id="mention" name="mention" placeholder="..." required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="specialite" class="col-sm-2 col-form-label">Spécialité</label>
                        <div class="col">
                            <input type="text" class="form-control" id="specialite" name="specialite" placeholder="..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="soutenance" class="col-sm-2 col-form-label">Parcours avec soutenance ?</label>
                        <div class="col-sm-1">
                            <input type="checkbox" class="" id="soutenance" name="soutenance">
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="niveau" class="col-sm-2 col-form-label">Niveau d'étude</label>
                        <div class="col">
                            <select class="form-control" id="niveauEtude_id" name="niveauEtude_id" required>
                                @foreach( $niveaux as $niveau)
                                <option value="{{ $niveau->id}}">{{ $niveau->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col">
                            <textarea class="form-control" id="description" name="description" required> </textarea>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('parcours.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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