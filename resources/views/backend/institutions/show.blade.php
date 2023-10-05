@extends('includes.master')
@push('custom-styles')
<style>
    #logo {
        width: 50px;
        height: 50px;
    }
</style>
@endpush
@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header">
                <h4>{{ __(' Informations institution') }}</h4>
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
                    <div class="col-6 offset-1">
                        {{ $institution->sigle }} {{ ($institution->denomination)}}
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">
                    <table id="data" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> 
                                    <td>Sigle</td> 
                                    <td> {{ $institution->sigle }}</td>
                                </tr>
                                <tr> 
                                    <td>Dénomination</td> 
                                    <td> {{ $institution->denomination }}</td>
                                </tr>
                                <tr> 
                                    <td>Type</td> 
                                    <td> {{ $institution->type }}</td>
                                </tr>
                                <tr> 
                                    <td>Contact</td> 
                                    <td> {{ $institution->telephone }}</td>
                                </tr>
                                <tr> 
                                    <td>Adresse postale</td> 
                                    <td> {{ $institution->adresse }}</td>
                                </tr>
                                <tr> 
                                    <td>Email</td> 
                                    <td> {{ $institution->email }}</td>
                                </tr>
                                <tr> 
                                    <td>Logo</td> 
                                    <td> <img id="logo" src="{{ $logo_base64 }}" alt="{{ $institution->logo }}"> </td>
                                </tr>
                                <tr> 
                                    <td>Adresse de site web</td> 
                                    <td> {{ $institution->siteWeb }}</td>
                                </tr>
                                <tr> 
                                    <td>Détails</td> 
                                    <td> {{ $institution->description }}</td>
                                </tr>
                                <tr> 
                                    <td>Actions</td> 
                                    <td> 
                                    <form action="{{ route('institutions.destroy',$institution->id) }}" method="POST">
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

@endpush
