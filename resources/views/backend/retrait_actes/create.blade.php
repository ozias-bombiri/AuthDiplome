@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un rétrait d\'acte') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un rétrait d\'acte') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('retrait_actes.store') }}">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="acteAcademique" class="col-sm-2 col-form-label">Acte academique</label>
                        <div class="col">
                            <select class="form-control" id="acteAcademique_id" name="acteAcademique_id" required>
                                @foreach( $acteAcademiques as $acteAcademique)
                                <option value="{{ $acteAcademique->id}}">{{ $acteAcademique->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="reference" class="col-sm-2 col-form-label">Reference</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="reference" name="reference" placeholder="Reference" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="dateRetrait" class="col-sm-2 col-form-label">Date de retrait</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateRetrait" name="dateRetrait" required>
                        </div>
                    </div>
                

                    <div class="form-group row py-2">
                        <label for="retirant" class="col-sm-2 col-form-label">Retirant</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="retirant" name="retirant" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col">
                            <textarea name="description" class="form-control" id="" cols="5" rows="3"></textarea>
                        </div>
                    </div>

                  
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('retrait_actes.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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