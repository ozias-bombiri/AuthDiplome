@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un numeroteur') }}
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

        @if (session('reponse'))
                <div class="alert alert-danger">
                    {{ session('reponse') }}
                </div>
            @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">{{ __('Ajouter un numeroteur') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('numeroteurs.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="intitution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            @if(isset($institution))
                            <input type="hidden"  id="institution_id" name="institution_id" value="{{ $institution->id }}">
                            <input type="texte" class="form-control" id="institution" name="institution" value="{{ $institution->sigle.' | '.$institution->denomination }}" disabled>
                        
                            @else
                            
                            <select class="form-control" id="institution" name="institution_id" required>
                                <option value="" selected disabled hidden> Choisir </option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" > {{ $institution->sigle }} </option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="categorie" class="col-sm-2 col-form-label">Catégorie de document</label>
                        <div class="col">
                            @if(isset($categorie))
                            <input type="hidden"  id="categorie_id" name="categorie_id" value="{{ $categorie->id }}">
                            <input type="texte" class="form-control" id="categorie" name="categorie" value="{{ $categorie->intitule }}" disabled>
                        
                            @else
                            <select class="form-control" id="categorie" name="categorieActe_id" required >
                                <option value="" selected disabled hidden> Choisir </option>
                                
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" > {{ $categorie->intitule }} </option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="chaine" class="col-sm-2 col-form-label">Chaine d'identification</label>
                        <div class="col">
                            <input type="texte" class="form-control form-control" id="chaine" name="chaine" required>
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