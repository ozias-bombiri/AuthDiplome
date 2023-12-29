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
                <h3 class="box-title mb-0">{{ __('Visas pour ').$visaInstitution->institution->sigle }}</h3>
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
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('visa_institutions.configvisas', $visaInstitution->id) }}"> Ajouter des visas</a>
            </div>
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Ordre</th>
                            <th>Intitule</th>
                            <th>Texte</th>                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visasDiplomes as $visasDiplome)
                        <tr>  
                            <td>{{ $visasDiplome->ordre }}</td>
                            <td>{{ $visasDiplome->visa->intitule }}</td>
                            <td>{{ $visasDiplome->visa->texte }}</td>
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')

@endpush