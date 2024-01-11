@extends('layouts.ample')

@section('page-title')
{{ __('Ajouter un procès verbal') }}
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
                <h3 class="box-title mb-0">{{ __('Ajouter un procès verbal') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">
                <form method="post" action="{{ route('proces_verbals.store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group row py-2">
                        <label for="parcours" class="col-sm-2 col-form-label">Parcours</label>
                        <div class="col">
                            @if(isset($parcour))
                                <input type="hidden"  id="parcours_id" name="parcours_id" value="{{ $parcour->id }}">
                            
                                <input type="text" class="form-control" id="parcour" name="parcour" value="{{ '('.$parcour->filiere->institution->sigle.') | '.$parcour->filiere->sigle.' | '.$parcour->intitule }}" disabled>

                            @else                            
                                <select class="form-control" id="parcour" name="parcours_id" required>
                                    @foreach( $parcours as $par)
                                    <option value="{{ $par->id}}">{{ '('.$par->filiere->institution->sigle.') | '.$par->filiere->sigle.' | '.$par->intitule }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="anneeAcademiques" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            <select class="form-control" id="parcour" name="anneeAcademique_id" required>
                                @foreach( $anneeAcademiques as $anneeAcademique)
                                <option value="{{ $anneeAcademique->id}}">{{ $anneeAcademique->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="nomFichierPdf" class="col-sm-2 col-form-label">Fichier PDF</label>
                        <div class="col">
                            <input type="file" class="form-control" id="nomFichierPdf" name="nomFichierPdf" accept="application/pdf">
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="type" class="col-sm-2 col-form-label">Type (EXEMEN/ SOUTENANCE)</label>
                        <div class="col">
                        <select class="form-control" id="type" name="type" required>
                            <option value="" selected disabled hidden>Choisir </option>                            
                            <option value="EXAMEN">EXAMEN</option> 
                            <option value="SOUTENANCE">SOUTENANCE</option>                               
                            </select>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="session" class="col-sm-2 col-form-label">La session</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="session" name="session" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="dateDeliberation" class="col-sm-2 col-form-label">Date de deliberation</label>
                        <div class="col">
                            <input type="date" class="form-control form-control" id="dateDeliberation" name="dateDeliberation" required>
                        </div>
                    </div>

                 
                    <div class="form-group row py-2">
                        <label for="nombreEtudiants" class="col-sm-2 col-form-label">Nombre d'étudiants</label>
                        <div class="col">
                            <input type="number" class="form-control form-control" id="nombreEtudiants" name="nombreEtudiants"  required>
                        </div>
                    </div>

                
                    
                    <div class="form-group row py-2">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col">
                            <textarea name="description" class="form-control" id="" cols="5" rows="3"></textarea>
                        </div>
                    </div>    
                    

                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('proces_verbals.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')

@endpush