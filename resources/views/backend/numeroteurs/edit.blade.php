@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un numeroteur') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier une academique') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('numeroteurs.update' ,$numeroteur->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="form-group row py-2">
                        <label for="intitution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            <select class="form-control" id="institution" name="institution_id" required>
                                <option value="" selected disabled hidden> Choisir </option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" @if ($institution->id == $numeroteur->institution->id) selected @endif> 
                                        {{ $institution->sigle }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Catégorie de document</label>
                        <div class="col">
                            <select class="form-control" id="categorie" name="categorieActe_id" required >
                                <option value="" selected disabled hidden> Choisir </option>
                                
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" @if ($categorie->id == $numeroteur->categorieActe->id) selected @endif> 
                                        {{ $categorie->intitule }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="chaine" class="col-sm-2 col-form-label">Chaine d'identification</label>
                        <div class="col">
                            <input type="texte" class="form-control form-control" id="chaine" name="chaine" value="{{ $numeroteur->chaine }}" required>
                        </div>
                    </div>

                   
                    
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('numeroteurs.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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