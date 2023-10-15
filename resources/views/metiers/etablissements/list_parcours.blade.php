@extends('includes.master')

@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Parcours de formation') }}</div>

    <div class="card-body">

        <div class="table-responsive">

        <a href=" {{route('metiers.etablissements.parcours-add')}} "> 
            <button type="button" class="btn btn-primary">          
            Ajouter
            </button>
        </a>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Institution</th>
                <th>Niveau</th>
                <th>Intitulé</th>
                <th>Credit</th>
                <th>Domaine</th>
                <th>Mention</th>
                <th>Specialité</th>
                <th>Description</th>
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
          ajax: "{{ route('metiers.etablissements.parcours-list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'institution_id', name: 'institution_id'},
              {data: 'niveauEtude_id', name: 'niveauEtude_id'},
              {data: 'intitule', name: 'intitule'},
              {data: 'credit', name: 'credit'},
              {data: 'domaine', name: 'domaine'},
              {data: 'mention', name: 'mention'},
              {data: 'specialite', name: 'specialite'},
              {data: 'description', name: 'description'},
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
