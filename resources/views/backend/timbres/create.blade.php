@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un timbre') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un timbre') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
            <form method="post" action="{{ route('timbres.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="institution_id" required>
                                    @foreach( $institutions as $institution)
                                        <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                            <div class="col">
                                <input type="text" class="form-control" id="intitule" name="intitule"  required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="ministere" class="col-sm-2 col-form-label">Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control" id="ministere" name="ministere" placeholder=" ..." required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="denomMinistere" class="col-sm-2 col-form-label">Denomination du Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="denomMinistere" name="denomMinistere" placeholder="..." required>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50" placeholder="..." required></textarea>
                            </div>
                        </div>
                       
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('timbres.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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
