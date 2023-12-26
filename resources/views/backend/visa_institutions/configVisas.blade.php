@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter des visas') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter des visas') }}</h3>
                <div class="">

                </div> 
            </div>
            <div class="">
            
                <div class="form-group row py-2">
                    <label for="institution" class="col-sm-2 col-form-label">Institution </label>
                    <div class="col">
                    <input type="text" class="form-control form-control" id="categorie" name="categorie" value="{{ $visaInstitution->institution->sigle }}" disabled>
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="categorie" class="col-sm-2 col-form-label">Categorie acte</label>
                    <div class="col">
                        <input type="text" class="form-control form-control" id="categorie" name="categorie" value="{{ $visaInstitution->categorieActe->intitule }}" disabled>
                    </div>
                </div>                    

                <div class="form-group row py-2">
                    <label for="intitule" class="col-sm-2 col-form-label">Visas</label>                    
                </div>
            </div>

            <div class="table-responsive">
            <form method="post" action="{{ route('visa_institutions.storeconfigvisas') }}">
                    @csrf
                    <input type="hidden" id="visaInstitution" name="visaInstitution_id"  value="{{ $visaInstitution->id }}">
                        
                    
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Visas </label>  
                        <div class="col">                  
                            @foreach($visas as $visa)
                                <div class="row">
                                    <input type="checkbox" class="col-sm-1 mb-3" id="categorie" name="visas[]" value="{{ $visa->id }}">
                                    <input type="text" class="col mb-3" id="categorie" value="{{ $visa->texte }}" disabled>
                                </div>
                            @endforeach
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