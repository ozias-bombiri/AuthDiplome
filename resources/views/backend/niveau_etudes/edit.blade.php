@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Ajouter un niveau d\'étude') }}</h4>

                </div>

            <div class="card-body">

                <div class="row my-3">
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

                <div class="row my-3">
                    <form method="post" action="{{ route('niveau_etudes.update', $niveau->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                            <div class="col">
                                <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $niveau->intitule }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="credit" class="col-sm-2 col-form-label">Nombre de crédit</label>
                            <div class="col">
                                <input type="number" class="form-control" id="credit" name="credit" value="{{ $niveau->credit }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="debut" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" value="{{ $niveau->description }}" required> </textarea>
                            </div>
                        </div>
                        
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('niveau_etudes.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                            </div>

                        </div>
    
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('costum-scripts')

@endpush