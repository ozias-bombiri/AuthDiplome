@extends('includes.master')

@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Institutions d\'enseignements et de recherche') }}</div>

    <div class="card-body">

        <div class="table-responsive">
            {{$dataTable->table()}}
        </div>

    </div>
</div>
@endsection

@push('costum-scripts')
{{$dataTable->scripts()}}
@endpush
