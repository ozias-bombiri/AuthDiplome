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
                <h3 class="box-title mb-0">{{ __('Ajouter une academiques') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('annee_academiques.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="Intitule" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="debut" class="col-sm-2 col-form-label">Début</label>
                        <div class="col">
                            <input type="date" class="form-control" id="debut" name="debut" placeholder="Début" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="fin" class="col-sm-2 col-form-label">Fin</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="fin" name="fin" placeholder="Fin" required>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('annee_academiques.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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