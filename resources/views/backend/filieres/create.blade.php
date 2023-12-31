@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter une filière') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter une filière') }}</h3>
                <div class="">

                </div>   
            </div>
            <div class="">
                <form method="post" action="{{ route('filieres.store') }}">
                    @csrf
                    
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution </label>                        
                        <div class="col">
                            @if(isset($etablissement))
                            <input type="hidden"  id="institution_id" name="institution_id" value="{{ $etablissement->id }}">
                        
                            <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $etablissement->sigle.' | '.$etablissement->parent->sigle }}" disabled>
                        
                            @else
                                <select class="form-control" id="institution" name="institution_id" required>
                                    <option value="" selected disabled hidden> Choisir</option>
                                    @foreach( $etablissements as $institution)
                                        <option value="{{ $institution->id}}">{{ $institution->sigle.' | '.$institution->parent->sigle }}</option>
                                    @endforeach
                                </select>
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                        <div class="col">
                            <input type="text" class="form-control" id="intitule" name="intitule" placeholder="Intitulé" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                        <div class="col">
                            <input type="text" class="form-control" id="sigle" name="sigle" placeholder="UTS" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="code" class="col-sm-2 col-form-label">Code</label>
                        <div class="col">
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                    </div>


                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('filieres.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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