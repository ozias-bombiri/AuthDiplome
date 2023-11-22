@extends('layout.ample')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Ajouter un parcours') }}</h4>
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
                        <a class="btn btn-success" href="#"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <form method="post" action="{{ route('metiers.etablissements.parcours-store') }}">
                            @csrf
                            <input type="hidden" id="institution" name="institution_id" value="{{ $institution->id }}">
                            <div class="form-group row py-2">
                                <label for="niveau" class="col-sm-2 col-form-label">Niveau</label>
                                <div class="col">
                                    <select class="form-control" id="institution" name="niveauEtude_id" required>
                                        <option value="" selected disabled hidden> Choisir le niveau</option>
                                        @foreach( $niveaux as $niveau)
                                        <option value="{{ $niveau->id}}">{{ $niveau->intitule }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="intitule" class="col-sm-2 col-form-label">Parcours</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="Lettres modernes" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="domaine" class="col-sm-2 col-form-label">Domaine</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="domaine" name="domaine" placeholder=" ..." required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="mention" class="col-sm-2 col-form-label">Mention</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="mention" name="mention" placeholder="..." required>
                                </div>
                            </div>

                            <div class="form-group row py-2">
                                <label for="specialite" class="col-sm-2 col-form-label">Spécialité</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="specialite" name="specialite" placeholder="..." required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="credit" class="col-sm-2 col-form-label">Nombre de crédit</label>
                                <div class="col">
                                    <input type="number" class="form-control form-control" id="credit" name="credit" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="description" name="description" required>
                                </div>
                            </div>
                            <div class="row py-4">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col">
                                    <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                                </div>
                                <div class="col">
                                    <a href="{{ route('metiers.etablissements.parcours-list', $institution->id) }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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