@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card mt-3">
      <div class="card-header">
        <h4>{{ __('Utilisateurs') }}</h4>
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
          <div class="col-3 offset-1">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a> <br />
          </div>
        </div>
        <div class="row my-3">
          <div class="col-10 offset-1">
            <table id="data" class="table table-bordered">
              
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