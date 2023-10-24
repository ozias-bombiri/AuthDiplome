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
                        <form method="post" action="{{ route('institutions.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row py-2">
                                <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="sigle" name="sigle" placeholder="UTS" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="denomination" class="col-sm-2 col-form-label">Dénomination</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="denomination" name="denomination" placeholder="Université ..." required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="type" class="col-sm-2 col-form-label">Type </label>
                                <div class="col">
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="IESR">Université</option>
                                        <option value="UFR">UFR</option>
                                        <option value="Institut">Institut</option>
                                        <option value="Ecole">Ecole</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="parent" class="col-sm-2 col-form-label">IESR parent </label>
                                <div class="col">
                                    <select class="form-control" id="parent" name="parent_id" required>
                                        <option>Aucun</option>
                                        @foreach( $iesrs as $iesr)
                                        <option value="{{ $iesr->id}}">{{ $iesr->sigle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                                <div class="col">
                                    <input type="number" class="form-control form-control" id="telephone" name="telephone" placeholder="700000" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col">
                                    <input type="email" class="form-control form-control" id="email" name="email" placeholder="email" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="adresse" class="col-sm-2 col-form-label">Adresse postale</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="adresse" name="adresse" placeholder="BP" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="siteweb" class="col-sm-2 col-form-label">Adresse site web</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="siteWeb" name="siteWeb" placeholder="Adresse site web" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col">
                                    <input type="file" class="form-control form-control" id="logo" name="logo">
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
                                    <a href="{{ route('institutions.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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