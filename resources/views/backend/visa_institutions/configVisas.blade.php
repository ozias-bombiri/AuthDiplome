@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter des visas') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter des visas') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">

                <div class="form-group row py-2">
                    <label for="institution" class="col-sm-2 col-form-label">Institution </label>
                    <div class="col">
                        <input type="text" class="form-control form-control" id="categorie" name="categorie" value="{{ $visaInstitution->institution->sigle }}" disabled>
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="categorie" class="col-sm-2 col-form-label">Categorie acte</label>
                    <div class="col">
                        <input type="text" class="form-control form-control" id="categorie" name="categorie" value="{{ $visaInstitution->categorieActe->intitule }}" disabled>
                    </div>
                </div>

                <div class="form-group row py-2">
                    <label for="intitule" class="col-sm-2 col-form-label">Visas</label>
                </div>
            </div>

            <div class="table-responsive">
                <form method="post" action="{{ route('visa_institutions.storeconfigvisas') }}">
                    @csrf
                    <input type="hidden" id="visaInstitution" name="visaInstitution_id" value="{{ $visaInstitution->id }}">


                    <table id="example1" class="table table-head-fixed text-nowrap table-bordered
                            table-hover">
                        <thead>
                            <tr style="background-color:gainsboro">
                                <th style="text-align: center">Texte</th>
                                <th style="text-align: center; width:20%" ;>Cochez</th>
                                <th style="text-align: center; width:10%">Ordre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visas as $visa)
                            <tr>
                                <td> {{ $visa->texte }} </td>
                                <td style=" width:20%">
                                    <input type="checkbox" class="col-sm-5 mb-3 Visacheckbox" name="visas[]" value="{{ $visa->id }}">
                                </td>
                                <td style="text-align: center; width:10%">
                                    <input type="number" class="form-control form-control" id="{{ 'ordre'.$visa->id }}" name="ordres[]" step="1" max="20" min="1" disabled>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('visa_institutions.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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
    $(document).ready(function() {
        $('.Visacheckbox').on('change', function(){
            if(this.checked === true) {
                
                $("#ordre"+this.value).prop("disabled", false);
                $("#ordre"+this.value).prop("required", true);
            }
            else {
                $("#ordre"+this.value).prop("disabled", true);
                $("#ordre"+this.value).prop("required", false);
            }
        });
    });
</script>

@endpush