@extends('includes.master')

@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Années academiques') }}</div>

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