@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un visa pour institution') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un visa pour institution') }}</h3>
                <div class="">

                </div> 
            </div>
            <div class="">
                <form method="post" action="{{ route('visa_institutions.store') }}">
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
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="intitule" name="intitule" required>
                        </div>
                    </div>


                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('visa_institutions.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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