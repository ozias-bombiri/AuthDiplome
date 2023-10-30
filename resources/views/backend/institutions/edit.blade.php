@extends('layouts.ample')

@section('page-title')
{{ __('Modifier une institution') }}
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
                <h3 class="box-title mb-0">{{ __('Modifier une institution') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
            <form method="post"  action="{{ route('institutions.update', $institution->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row py-2">
                                <label for="code" class="col-sm-2 col-form-label">Code</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="code" name="code" value="{{ $institution->code }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="sigle" name="sigle" value="{{ $institution->sigle }}" required>
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
                                    <input type="number" class="form-control" id="telephone" name="telephone" value="{{ $institution->telephone }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $institution->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="adresse" class="col-sm-2 col-form-label">Adresse postale</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $institution->adresse }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="siteweb" class="col-sm-2 col-form-label">Adresse site web</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="siteweb" name="siteWeb" value="{{ $institution->siteWeb }}" required>
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col">
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                            </div>
                            <div class="form-group row py-2">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col">
                                    <textarea  class="form-control" id="description" name="description" required> {{ $institution->description }} </textarea>
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

@endsection

@push('costum-scripts')
<script type="module">
    $(document).on('change', '#type', function parent_type() {
        var selecthtml = $('#type');
        var selected = this.options[this.selectedIndex].value;
        if (selected == 'IESR') {
            $('#parent').val = "";
            $('#parent').prop('disabled', true)
        } else {
            $('#parent').prop('disabled', false);
            $('#parent').prop('required', true);
        }

    });
</script>
@endpush

