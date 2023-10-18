@extends('includes.master')

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __('Visas') }}</h4>
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
                        <a class="btn btn-success" href="{{ route('visas.create') }}"> Ajouter</a> <br />
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Numéro</th>
                                    <th>Intitulé</th>
                                    <th> Date de signature </th>
                                    <th>Texte</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visas as $visa)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $visa->numero }}</td>
                                    <td>{{ $visa->intitule }}</td>
                                    <td> {{ $visa->dateSignature->format('d m Y') }}</td>
                                    <td> {{ $visa->texte }}</td>
                                    <td>
                                        <form action="{{ route('visas.destroy',$visa->id) }}" method="POST">
                                            <a class="btn btn-info" title="Détails" href="{{ route('visas.show',$visa->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-primary" title="Modifier" href="{{ route('visas.edit',$visa->id) }}">
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