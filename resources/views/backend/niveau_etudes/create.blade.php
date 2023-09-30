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
                    <form method="post" action="{{ route('niveau_etudes.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitule</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="Intitule" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="debut" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <input type="text" class="form-control" id="description" name="description" placeholder="description" required>
                            </div>
                        </div>
                        
                        <div class="row py-4">
                           
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
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