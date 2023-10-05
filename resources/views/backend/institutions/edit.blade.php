@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Modifier une institution') }}</h4>
            </div>

            <div class="card-body">
                <div class="row my-3">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <form method="post"  action="{{ route('institutions.update', $institution->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <!--<input type="hidden" name="_method" value="PUT"> -->
                            <div class="form-group row py-2">
                                <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="sigle" name="sigle" value="{{ $institution->sigle }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="denomination" class="col-sm-2 col-form-label">Dénomination</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="denomination" name="denomination" value="{{ $institution->denomination }}" required>
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
                                    <select class="form-control" id="parent" name="parent_id">
                                        <option value="">Aucun</option>
                                        @foreach( $iesrs as $iesr)
                                        <option value="{{ $iesr->id}}">{{ $iesr->sigle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                                <div class="col">
                                    <input type="number" class="form-control form-control" id="telephone" name="telephone" value="{{ $institution->telephone }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col">
                                    <input type="email" class="form-control form-control" id="email" name="email" value="{{ $institution->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="adresse" class="col-sm-2 col-form-label">Adresse postale</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="adresse" name="adresse" value="{{ $institution->adresse }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="siteweb" class="col-sm-2 col-form-label">Adresse site web</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control" id="siteweb" name="siteWeb" value="{{ $institution->siteWeb }}" required>
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
                                    <input type="text" class="form-control form-control" id="description" name="description" value="{{ $institution->description }}" required>
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
<script type="module">
    $('#type').change(function(){
        if(this.selectedIndex != 0){
            $('#parent').required = true;
            console.log('ok');
        }
    });
</script>
@endpush
