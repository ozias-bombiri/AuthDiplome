@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter une academiques') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un ministère') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('ministeres.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="sigle" name="sigle"  required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="denomination" class="col-sm-2 col-form-label">Dénomination</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="denomination" name="denomination" required>
                        </div>
                    </div>
                   
                   
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('ministeres.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>8

@endsection

@push('costum-scripts')

@endpush