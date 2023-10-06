@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">{{ __('Modifier une academiques') }}</div>

            <div class="card-body">

                <div class="table-responsive">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post"  action="{{ route('annee_academiques.update' ,$annee->id) }}">
                    @method('PUT')
                    @csrf
                    
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="intitule" name="intitule" value="{{ $annee->intitule }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="debut" class="col-sm-2 col-form-label">Début</label>
                            <div class="col">
                                <input type="date" class="form-control" id="debut" name="debut" value="{{ $annee->debut }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="fin" class="col-sm-2 col-form-label">Fin</label>
                            <div class="col">
                                <input type="date" class="form-control form-control" id="fin" name="fin" value="{{ $annee->fin }}" required>
                            </div>
                        </div>
                        <div class="row py-4">
                            <label  class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success" >Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('annee_academiques.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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