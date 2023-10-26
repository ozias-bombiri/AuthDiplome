@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header bg-info">
                <h4>{{ __('Ajouter une institution') }}</h4>
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
                    <div class="col-10 offset-1">
                    <form method="post" action="{{ route('parcours.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="etablissement" class="col-sm-2 col-form-label">Institution</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="institution_id" required>
                                    @foreach( $etablissements as $etablissement)
                                        <option value="{{ $etablissement->id}}">{{ $etablissement->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitulé du parcours</label>
                            <div class="col">
                                <input type="text" class="form-control" id="intitule" name="intitule" placeholder="Lettres modernes" required>
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
                                <input type="text" class="form-control" id="mention" name="mention" placeholder="..." required>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="specialite" class="col-sm-2 col-form-label">Spécialité</label>
                            <div class="col">
                                <input type="text" class="form-control" id="specialite" name="specialite" placeholder="..." required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="soutenance" class="col-sm-2 col-form-label">Parcours avec soutenance ?</label>
                            <div class="col-sm-1">
                                <input type="checkbox" class="" id="soutenance" name="soutenance">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="niveau" class="col-sm-2 col-form-label">Niveau d'étude</label>
                            <div class="col">
                                <select  class="form-control" id="niveauEtude_id" name="niveauEtude_id" required>
                                    @foreach( $niveaux as $niveau)
                                        <option value="{{ $niveau->id}}">{{ $niveau->intitule }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" required> </textarea>
                            </div>
                        </div>
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('parcours.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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
<script type="module">
    

</script>
@endpush


@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un parcours de formation') }}</div>

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
                    <form method="post" action="{{ route('parcours.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="etablissement" class="col-sm-2 col-form-label">Institution</label>
                            <div class="col">
                                <select  class="form-control" id="institution" name="institution_id" required>
                                    @foreach( $etablissements as $etablissement)
                                        <option value="{{ $etablissement->id}}">{{ $etablissement->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitulé du parcours</label>
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
                            <label for="soutenance" class="col-sm-2 col-form-label">Parcours avec soutenance ?</label>
                            <div class="col-sm-1">
                                <input type="checkbox" class="" id="soutenance" name="soutenance">
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="niveau" class="col-sm-2 col-form-label">Niveau d'étude</label>
                            <div class="col">
                                <select  class="form-control" id="niveauEtude_id" name="niveauEtude_id" required>
                                    @foreach( $niveaux as $niveau)
                                        <option value="{{ $niveau->id}}">{{ $niveau->intitule }}</option>                                    
                                    @endforeach
                                </select>
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
                                <a href="{{ route('parcours.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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