@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un timbre') }}</div>

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
                    <form method="post" action="{{ route('timbres.update', $timbre->id) }}">
                        @method('PUT')
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
                                <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $timbre->intitule }}"  required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="ministere" class="col-sm-2 col-form-label">Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control" id="ministere" name="ministere" value="{{ $timbre->ministere }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="denomMinistere" class="col-sm-2 col-form-label">Denomination du Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="denomMinistere" name="denomMinistere" value="{{ $timbre->denomMinistere }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50" value="{{ $timbre->description }}" required></textarea>
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
</div>
@endsection

@push('costum-scripts')

@endpush