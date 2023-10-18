@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un visa') }}</div>

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
                    <form method="post" action="{{ route('visas.store') }}">
                        @csrf

                        <div class="form-group row py-2">
                            <label for="numero" class="col-sm-2 col-form-label">Numéro</label>
                            <div class="col">
                                <input type="text" class="form-control" id="numero" name="numero" placeholder=" ..." required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="intitule" class="col-sm-2 col-form-label">Intitulé</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="intitule" name="intitule" placeholder="..." required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="dateSignature" class="col-sm-2 col-form-label">Date de signature</label>
                            <div class="col">
                                <input type="date" class="form-control form-control" id="dateSignature" name="dateSignature" placeholder="..." required>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="texte" class="col-sm-2 col-form-label">Texte</label>
                            <div class="col">
                                <textarea class="form-control" id="texte" name="texte" rows="4" cols="50" placeholder="..." required></textarea>
                            </div>
                        </div>
                       
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('visas.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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