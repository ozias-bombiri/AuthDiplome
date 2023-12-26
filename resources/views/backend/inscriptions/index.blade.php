@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
{{ __('Incriptions au parcours') }}
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
            <h3 class="box-title">{{ __('Etudiants inscrits au parcours').' '.$parcours->intitule }} </h3>
            <div class="col-2 offset-10 mb-5">
                <a class="btn btn-success" href="{{ route('parcours.inscriptions.create', $parcours->id) }}"> Ajouter </a>
            </div>
            <div class="table-responsive">
                <div class="form-group row py-2">
                    <input type="hidden" id="parcours" value="{{ $parcours->id }}">
                        <label for="anneeAcademique" class="col-sm-2 col-form-label">Année académique</label>
                        <div class="col">
                            @foreach( $annees as $annee)
                                <a class="btn btn-link btn-secondary" href="{{ route('parcours.inscriptions.index', ['id'=>$parcours->id, 'annee' =>$annee->id]) }}">{{ $annee->intitule }}</a>
                            @endforeach                            
                        </div>
                        
                    </div>
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Annee</th>
                            <th>Identifiant</th>                                
                            <th>Etudiant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscriptions as $inscription)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $inscription->anneeAcademique->intitule }}</td>
                            <td>{{ $inscription->etudiant->identifiant }}</td>                            
                            <td>{{ $inscription->etudiant->nom.' '.$inscription->etudiant->prenom }}</td>

                            <td>
                                <form action="{{ route('parcours.inscriptions.destroy',$inscription->id) }}" method="POST">
                                    <a class="btn btn-info" title="Détails" href="{{ route('parcours.inscriptions.show',[$parcours->id, $inscription->id]) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@push('costum-scripts')
<!-- SCRIPT FOR DATATABLE-->
<script type="module" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="module" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script type="module">
    $(document).ready(function() {
        $('#data').DataTable();

        $(document).on('change', '#annee', function() {
            var selectedAnnee = this.options[this.selectedIndex].value;
            var parcours = $('#parcours').attr('value');
            console.log(selectedAnnee+'  '+parcours);
            
            
            
        });
    });
</script>
@endpush