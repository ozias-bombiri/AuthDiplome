@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
    Recherche
@endsection

@section('content')

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

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <h3 class="box-title">{{ __('Rechercher') }}</h3>
            <div>
                <form method="post" action="{{ route('metiers.auth.recherche') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-4 col-form-label">Référence à chercher</label>
                        <div class="col">
                            <input type="text" class="form-control form-control" id="reference" name="reference" required>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-4 col-form-label">Catégorie</label>
                        <div class="col">
                            <select class="form-control" id="categorie" name="categorie" required>
                                <option value="provisoire">Attestation provisoire</option>
                                <option value="definitive">Attestation définitive</option>
                                <option value="diplome">Diplôme</option>

                            </select>
                        </div>
                    </div>

                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Rechercher</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('metiers.auth.index') }}"> <button type="button" class="btn btn-secondary">Retour</button> </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col-10 offset-1">
        @if(isset($message))
        <p class="text-danger"> {{ $message }}</p>
        @else
        --
        @endif
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


<script type="module">
    $(document).ready(function() {

        $(document).on('click', '.view', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            $.ajax({
                // Our sample url to make request 
                url: "/d/provisoires/view/" + id,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {


                    $("#reference").text(data.result.reference);
                    $("#intitule").text(data.result.intitule);
                    $("#identifiant").text(data.result.impetrant);
                    $("#parcours").text(data.result.parcours);
                    $("#niveau").text(data.result.niveau);
                    $("#institution").text(data.result.institution);
                    $("#sessionr").text(data.result.sessionr);
                    var myModal = new bootstrap.Modal($("#exampleModal"), {});
                    myModal.show();
                },

                // Error handling 
                error: function(error) {
                    console.log("Error ${error}");
                }
            });
        });
    });
</script>
@endpush