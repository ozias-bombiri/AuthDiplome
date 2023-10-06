@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Modifier role') }}</h4>
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
                    <div class="col-3 offset-1">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                    <form method="post" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">Nom du role</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="name" name="name" value="{{ $role->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="debut" class="col-sm-2 col-form-label">Permissions</label>
                            <div class="col">
                                @foreach($permissions as $permission)
                                    <input type="checkbox" id="name" name="permissions" value="{{ $permission->id}}">
                                    <label> {{ $permission->name }}</label> 
                                    
                                    @endforeach
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
</div>

@endsection
@push('costum-scripts')

@endpush


