@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Structures d\'enseignement') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('institutions.create') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dénomination</th>
                                    <th>Sigle</th>
                                    <th>Type</th>
                                    <th>Parent</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($institutions as $institution)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $institution->denomination }}</td>
                                    <td>{{ $institution->sigle }}</td>
                                    <td>{{ $institution->type }}</td>
            
                                    <td>
                                        @if($institution->parent) 
                                            {{ $institution->parent->sigle }} 
                                        @else - 
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('institutions.destroy',$institution->id) }}" method="POST">
                                            <a class="btn btn-info" title="Détails" href="{{ route('institutions.show',$institution->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('institutions.edit',$institution->id) }}">
                                                <i class="bi bi-pencil"></i>
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
