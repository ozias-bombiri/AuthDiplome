@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            Formulaires
                        </div>
                        <div class="card-body">
                            
                            <form>
                                <div class="form-group row">
                                    <label for="intitule" class="col-auto col-form-label col-form-label">Intitule</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control" id="intitule" placeholder="Intitule">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="debut" class="col-auto col-form-label">Début</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="debut" placeholder="Début">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fin" class="col-auto col-form-label col-form-label">Fin</label>
                                    <div class="col">
                                        <input type="text" class="form-control form-control" id="fin" placeholder="Fin">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">

                        </div>

                    </div>

                    <i class="fa fa-trash"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('costum-scripts')

@endpush