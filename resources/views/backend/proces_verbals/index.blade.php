@extends('layouts.ample')

@push('custom-styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
    {{ __('Procès verbaux') }}
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
            @if (session('reponse'))
                <div class="alert alert-danger">
                    {{ session('reponse') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">{{ __('Procès verbaux') }} @if (isset($parcours))
                        du parcours : {{ $parcours->intitule }}
                    @endif
                </h3>
                <div class="col-2 offset-10 mb-5">
                @if (isset($parcours))
                    <a class="btn btn-success" href="{{ route('proces_verbaux.create', ['parcours_id' => $parcours->id]) }}"> Ajouter </a>
                @else 
                    <a class="btn btn-success" href="{{ route('proces_verbals.create') }}"> Ajouter </a>
                @endif
                </div>
                <div class="table-responsive">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Parcours</th>
                                <th>Année</th>
                                <th>Intitule</th>
                                <th>Session</th>
                                <th>Date deliberation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proces_verbals as $proces_verbal)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $proces_verbal->parcours->intitule }}</td>
                                    <td>{{ $proces_verbal->anneeAcademique->intitule }}</td>
                                    <td>{{ $proces_verbal->intitule }}</td>
                                    <td>{{ $proces_verbal->session }}</td>
                                    <td>{{ $proces_verbal->dateDeliberation }}</td>


                                    <td>
                                        <form action="{{ route('proces_verbals.destroy', $proces_verbal->id) }}"
                                            method="POST">
                                            <a class="btn btn-info" title="voir pdf"
                                                href="{{ route('proces_verbals.show', $proces_verbal->id) }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            <a class="btn btn-primary" title="Résultats academiques"
                                                href="{{ route('proces_verbaux.resultats.index', $proces_verbal->id) }}">
                                                <i class="bi bi-card-list"></i>
                                            </a>

                                            <a class="{{ $proces_verbal->actesEnregistres($proces_verbal->id, "PROVISOIRE") ? 'btn btn-secondary' : 'btn btn-warning' }}"
                                                title="Etablir des attestations provisoires"
                                                href="{{ $proces_verbal->actesEnregistres($proces_verbal->id, "PROVISOIRE") ? '#' : route('proces_verbaux.provisoires.create2', $proces_verbal->id) }}">
                                                <i class="bi bi-clipboard-minus-fill"></i>
                                            </a>

                                            <a class="{{ $proces_verbal->actesEnregistres($proces_verbal->id, "DEFINITIVE") ? 'btn btn-secondary' : 'btn btn-warning' }}"
                                                title="Etablir des attestations définitives"
                                                href="{{ $proces_verbal->actesEnregistres($proces_verbal->id, "DEFINITIVE") ? '#' : route('proces_verbaux.definitives.create2', $proces_verbal->id) }}">
                                                <i class="bi bi-clipboard-plus-fill"></i>
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
        });
    </script>
@endpush
