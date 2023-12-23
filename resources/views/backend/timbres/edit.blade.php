@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un timbre') }}
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
                <h3 class="box-title mb-0">{{ __('Modfier un timbre') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
            <form method="post" action="{{ route('timbres.update', $timbre->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                            <div class="col">
                                <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $timbre->intitule }}" required />
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="type" name="type" value="{{ $timbre->type }}"  required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="ministere" class="col-sm-2 col-form-label">ministere</label>
                            <div class="col">
                                <select  class="form-control" id="ministere" name="ministere_id" required>
                                    <option value="" selected hidden disabled>Choisir</option>  
                                    @foreach( $ministeres as $ministere)
                                        <option value="{{ $ministere->id}}"  @if ($ministere->id == $timbre->ministere->id) selected @endif>
                                            {{ $ministere->sigle }}
                                        </option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row py-2">
                            <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="institution_id" required>
                                    @foreach( $institutions as $institution)
                                        <option value="{{ $institution->id}}" @if ($institution->id == $timbre->institution->id) selected @endif>
                                            {{ $institution->sigle }}
                                        </option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
      

                       
                       
                        
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50" value="" required>{{ $timbre->description }}</textarea>
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

@endsection

@push('costum-scripts')

@endpush

