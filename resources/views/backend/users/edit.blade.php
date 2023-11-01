@extends('layouts.ample')

@section('page-title')
{{ __('Modifier un utilisateur') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier un utilisateur') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}


                    <div class="form-group row py-2">
                        <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom}}" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom}}" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col">
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone}}" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Email</label>
                        <div class="col">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="roles" class="col-sm-2 col-form-label">Role</label>
                        <div class="col">
                        <select class="form-control" name="roles" required disabled>
                        <option value="" selected hidden disabled>Choisir un rôle</option>
                            @foreach($roles as $role)
                            @if(count($user->roles)>0)
                            <option value="{{ $role }}" @if($role==$user->roles[0]->name) selected @endif> {{ $role }}</option>
                            @else
                            <option value="{{ $role }}"> {{ $role }}</option>
                            @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('users.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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