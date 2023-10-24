@extends('includes.master')

@push('custom-styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">  
@endpush

@section('contenu')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mt-3">
            <div class="card-header bg-info">
                <h4>{{ __('Rechercher') }}</h4>
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

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-10 offset-1">                      
                            
                        
                    </div>
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


<script type="module">
    $(document).ready(function(){

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