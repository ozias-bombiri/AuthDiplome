@extends('layouts.ample')

@section('page-title')
{{ __('Modifier une attestation définitive') }}
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
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="d-md-flex mb-3">
                <h3 class="box-title mb-0">{{ __('Modifier une attestation définitive') }}</h3>
                <div class="">

                </div>
            </div>
            <div class="">


            </div>
        </div>
    </div>
</div>

@endsection

@push('costum-scripts')

@endpush