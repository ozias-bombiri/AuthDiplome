@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un utilisateur') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un utilisateur') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group row py-2">
                        <label for="type" class="col-sm-2 col-form-label">Type d'utilisateur</label>
                        <div class="col">
                            <select class="form-control" id="type" name="type"  required>
                                <option value="" selected  hidden disabled>Choisir</option>
                                
                                <option value="1">Gestion d'attestations provisoires</option>
                                <option value="2">Gestion d'attestations définitives et diplomes</option>
                                <option value="3">Gestion des authentifications</option>
                                <option value="4">Administrateur</option>                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col">
                            <select class="form-control" id="institution" name="institution_id" required>
                                <option value="" selected hidden disabled>Choisir</option>
                                @foreach( $institutions as $institution)
                                <option value="{{ $institution->id}}" class="institutionOption {{ $institution->type}}">{{ $institution->sigle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder=" ..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder=" ..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col">
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder=" ..." required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="prenom" class="col-sm-2 col-form-label">Email</label>
                        <div class="col">
                            <input type="email" class="form-control" id="email" name="email" placeholder=" ..." required>
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

<script type="module">
    $(document).on('change', '#type', function () {
        var selecthtml = $('#type');
        var selected = this.options[this.selectedIndex].value;
        if (selected == '1') {
            $('#institution').val = "";
            $('#institution').prop('disabled', false) ;
            $('.institutionOption').prop('hidden', false) ;
            $('.IESR').prop('hidden', true);
            
        } else if (selected ==2)
        {
            $('.institutionOption').prop('hidden', false);
            
            $('.Ecole, .Institut, .UFR').prop('hidden', true);
        }
        else if (selected ==3)
        {
            $('.institutionOption').prop('hidden', false);
            $('.IESR').prop('hidden', false);
            $('#institution').prop('disabled', true);
            //$('#institution').prop('required', true);
        }
        else if (selected ==4)
        {
            $('.institutionOption').prop('hidden', false);
            $('.IESR').prop('hidden', false);
            $('#institution').prop('disabled', true);
            //$('#parent').prop('required', true);
        }

    });
</script>

@endpush