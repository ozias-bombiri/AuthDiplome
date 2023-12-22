@extends('layouts.ample')

@section('page-title')
{{ __('Modifier une catégorie d\'acte') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier une catégorie d\'acte') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('categorie_actes.update' ,$categorie->id) }}">
                    @method('PUT')
                    @csrf
                    

                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="intitule" name="intitule" value="{{ $categorie->intitule }}" required>
                        </div>
                    </div>
                    

                    <div class="form-group row py-2">
                        <label for="nombreCopies" class="col-sm-2 col-form-label">Nombre de copies</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="nombreCopies" name="nombreCopies" value="{{ $categorie->nombreCopies }}" required>
                        </div>
                    </div>
                    

                    

                    <div class="form-group row py-2">
                        <label for="visas" class="col-sm-2 col-form-label">Visas</label>
                        <div class="col">
                            <input type="radio" value="1" id="visas" name="visas"> Oui <br>
                            <input type="radio" value="0" id="visas" name="visas"> Non
                        </div>
                    </div>

                   
                    <div class="form-group row py-2">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col">
                            <textarea class="form-control" id="description" name="description" required> {{ $categorie->description }}</textarea>
                        </div>
                    </div>

                    
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('categorie_actes.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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