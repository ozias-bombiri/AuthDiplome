@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">{{ __('Ajouter un timbre iesr') }}</div>

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
                    <form method="post" action="{{ route('timbre_iesrs.store') }}">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="iesr" class="col-sm-2 col-form-label">Iesr</label>
                            <div class="col">
                                <select  class="form-control" id="iesr" name="iesr_id" required>
                                    @foreach( $iesrs as $iesr)
                                        <option value="{{ $iesr->id}}">{{ $iesr->sigle }}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col">
                                <select class="form-control" id="type" name="type">
                                    <option value="" disabled selected>choisir ...</option>
                                    <option value="iesr">iesr</option>
                                    <option value="etablissement">etablissement</option>
                                </select>                            
                            </div>
                        </div>


                        <div class="form-group row py-2">
                            <label for="ministere" class="col-sm-2 col-form-label">Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control" id="ministere" name="ministere" placeholder=" ..." required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="denomMinistere" class="col-sm-2 col-form-label">Denomination du Ministere</label>
                            <div class="col">
                                <input type="text" class="form-control form-control" id="denomMinistere" name="denomMinistere" placeholder="..." required>
                            </div>
                        </div>
                        
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50" placeholder="..." required></textarea>
                            </div>
                        </div>
                       
                        <div class="row py-4">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col">
                                <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                            </div>
                            <div class="col">
                                <a href="{{ route('timbre_iesrs.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
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