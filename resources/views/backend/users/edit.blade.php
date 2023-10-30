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
                        <label for="iesr" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            <select class="form-control" id="iesr" name="institution_id" required>
                                <option value="">Choisir</option>
                                @foreach( $institutions as $institution)
                                <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="nom" class="col-sm-2 col-form-label">Name</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="name" value="{{ $user->name}}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Email</label>
                        <div class="col">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                        <div class="col">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="password" class="col-sm-2 col-form-label">Confimer mot de passe</label>
                        <div class="col">
                            <input type="password" class="form-control" id="confirm-password" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="type" class="col-sm-2 col-form-label">Role</label>
                        <div class="col">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">

                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>


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