@extends('includes.master')

<<<<<<< HEAD
@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Parcours de formation') }}</div>

    <div class="card-body">

        <div class="table-responsive">

            <a href=" {{route('metiers.etablissements.etudiant-add')}} "> 
                <button type="button" class="btn btn-primary">          
                Ajouter
                </button>
            </a>
    
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Identifiant</th>
                    <th>Type</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Date naissance</th>
                    <th>Lieu naissance</th>
                    <th>Pays naissance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        {{ csrf_field() }}
    
    
    
    
    
            </div>
    
        </div>
    </div>
    @endsection
    
    @push('costum-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(function () {
          
          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              pageLength: 5,
              ajax: "{{ route('metiers.etablissements.etudiant-list') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'identifiant', name: 'identifiant'},
                  {data: 'typeIdentifiant', name: 'typeIdentifiant'},
                  {data: 'nom', name: 'nom'},
                  {data: 'prenom', name: 'prenom'},
                  {data: 'sexe', name: 'sexe'},
                  {data: 'dateNaissance', name: 'dateNaissance'},
                  {data: 'lieuNaissance', name: 'lieuNaissance'},
                  {data: 'paysNaissance', name: 'paysNaissance'},
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: false
                  },
              ]
          });
          
        });
      </script>
      
    
    @endpush
    
            
 
=======
@push('custom-styles')
    <link href="{{ URL::asset('/assets/css/datatables.min.css')}}" rel="stylesheet">    
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Etudiants') }}</h4>
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
                    <div class="col-3 offset-1">
                        <a class="btn btn-success" href="{{ route('metiers.etablissements.etudiant-add') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Identifiant</th>
                                    <th>Nom Prénom(s)</th>
                                    <th>Date de naissance</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $etudiant->identifiant }}</td>
                                    <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->dateNaissance }}</td>
                                    
                                    <td>
                                        <a class="btn btn-info" title="Voir attestations provisoire" href="{{ route('impetrants.show',$etudiant->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a class="btn btn-primary" title="Ajouter une attestation" href="{{ route('metiers.etablissements.attestation-add',['etudiant_id' => $etudiant->id]) }}">
                                            <i class="bi bi-plus"></i>
                                        </a>

                                            
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
</div>

@endsection
@push('costum-scripts')

<!-- Core theme JS-->
<script type="module" src="{{URL::asset('/assets/datatables.js/datatable.min.js')}}"></script>

<script type="module">
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>
@endpush
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
