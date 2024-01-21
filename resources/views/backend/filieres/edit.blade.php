@extends('layouts.ample')

@section('page-title')
{{ __('Modifier une filière') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier une filière') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('filieres.update', $filiere->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden"  id="institution_id" name="institution_id" value="{{ $filiere->institution->id }}">
                        
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution </label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="institution" name="institution" value="{{ $filiere->institution->sigle.' | '.$filiere->institution->parent->sigle  }}" disabled>                        
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="intitule" name="intitule" value="{{ $filiere->intitule }}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                        <div class="col">
                            <input type="text" class="form-control" id="sigle" name="sigle" value="{{ $filiere->sigle }}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="code" class="col-sm-2 col-form-label">Code</label>
                        <div class="col">
                            <input type="text" class="form-control" id="code" name="code" value="{{ $filiere->code }}" required>
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