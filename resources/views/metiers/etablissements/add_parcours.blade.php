@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
<<<<<<< HEAD
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un établissement') }}</div>

            <div class="card-body">

                <div class="table-responsive">
=======
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Ajouter un parcours') }}</h4>
            </div>

            <div class="card-body">
                <div class="row my-3">

>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
<<<<<<< HEAD
                    <form method="post" action="{{ route('metiers.etablissements.parcours-store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="institution_id" required>
                                    <option value="" selected disabled hidden> Choisir une institution</option>
                                    @foreach( $institutions as $institution)
                                        <option value="{{ $institution->id}}">{{ $institution->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="niveau" class="col-sm-2 col-form-label">Niveau</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="niveauEtude_id" required>
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
                                <input type="number" class="form-control form-control" id="credit" name="credit"  required>
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
                                <a href="{{ route('metiers.etablissements.parcours-list') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                            </div>

                        </div>
                        
                    </form>

                </div>
=======
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

>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)

            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection

=======

@endsection
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
@push('costum-scripts')

@endpush