@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Ajouter un utilisateur') }}</h4>
            </div>

            <div class="card-body">
                <div class="row my-3">

                    @if (count($errors) > 0)
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
                    <div class="col-10 offset-1">
                        <form method="post" action="{{ route('users.store') }}">
                            @csrf
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
                                    <input type="text" class="form-control" id="nom" name="name" placeholder=" ..." required>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="prenom" class="col-sm-2 col-form-label">Email</label>
                                <div class="col">
                                    <input type="email" class="form-control" id="email" name="email" placeholder=" ..." required>
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
                                    <input type="password" class="form-control" id="confirm-password" name="password" required>
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
                                    <!--
                                    <select class="form-control" id="role" name="role">
                                        <option value="" disabled selected>choisir ...</option>
                                        @foreach( $roles as $role)
                                            <option value="{{ $role}}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                  -->
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
    </div>
</div>

@endsection
@push('costum-scripts')

@endpush