@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un visa pour diplôme') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un visa pour diplôme') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('visa_diplomes.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="etudiant" class="col-sm-2 col-form-label">Visa</label>
                        <div class="col">
                            <select class="form-control" id="visa" name="visa_id" required>
                                @foreach( $visas as $visa)
                                <option value="{{ $visa->id}}">{{ $visa->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="visaInstitution" class="col-sm-2 col-form-label">Visa institution</label>
                        <div class="col">
                            <select class="form-control" id="visaInstitution" name="visaInstitution_id" required>
                                @foreach( $visaInstitutions as $visaInstitution)
                                <option value="{{ $visaInstitution->id}}">{{ $visaInstitution->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                   

                    <div class="form-group row py-2">
                        <label for="ordre" class="col-sm-2 col-form-label">Ordre</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="ordre" name="ordre" required>
                        </div>
                    </div>
                   
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('visa_diplomes.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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