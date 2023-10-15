@extends('includes.master')

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
    
            
 
