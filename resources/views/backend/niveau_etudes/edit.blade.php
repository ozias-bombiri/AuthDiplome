@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un niveau d\'étude') }}</div>

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

                    <form action=" {{ route('niveau_etudes.update',$niveau->id) }} " method="POST"> 
                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="intitule" name="intitule" value=" {{ old('intitule') ?? $niveau->intitule }}">
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="description" name="description" value=" {{ old('description') ?? $niveau->description }}">
                            </div>
                        </div>

                   
                        
                </div>

                </div>

               
                    <div class="col-md-0 offset-md-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Modifier') }}
                        </button>
                        <a href=" {{route('niveau_etudes.index')}} "><button type="button" class="btn btn-primary">Annuler</button></a> 

                    </div>
                
            </form>
        </div>

            
    </div>
        </div>
    </div>
</div>


@endsection