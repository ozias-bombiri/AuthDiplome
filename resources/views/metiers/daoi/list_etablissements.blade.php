@extends('layouts.ample')

@push('custom-styles')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('page-title')
Etablissements d'enseignement
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
            <h3 class="box-title">Etablissements d'enseignement </h3>
            <div class="col-2 offset-10 mb-5">
                <button class="btn btn-primary" id="add"> Ajouter un établissement <i class="bi bi-plus-circle"></i></button>

            </div>
            <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sigle</th>
                            <th>Dénomination</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etablissements as $institution)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $institution->sigle }}</td>
                            <td>{{ $institution->denomination }}</td>
                            <td>{{ $institution->type }}</td>
                            <td>
                                
                                <button class="btn btn-success detail" id= "{{ $institution->id }}" title="Détails" href="{{ route('institutions.show',$institution->id) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button class="btn btn-success edit" id= "{{ $institution->id }}" title="Modifier" href="{{ route('institutions.edit',$institution->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </button>                                   

                                <a  class="btn btn-success" title="Filieres" href="{{ route('metiers.daoi.parcours-list',$institution->id) }}">
                                    <i class="bi bi-folder"></i>
                                </a>

                                <a  class="btn btn-success" title="Signataires" href="{{ route('metiers.daoi.signataires-list',$institution->id) }}">
                                    <i class="bi bi-patch-check"></i>
                                </a>

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


<!-- Modal ajouter-->
<div class="row my-3">

    <div class="modal fade" id="exampleModal1" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="exampleModalLabel1">Informations établissement</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route('metiers.daoi.etablissement-store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  id="parent" name="parent_id" value="{{ Auth::user()->institution->id }}">
                    <div class="form-group row py-2">
                        <label for="code" class="col-sm-2 col-form-label">Code</label>
                        <div class="col">
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="sigle" class="col-sm-2 col-form-label">Sigle</label>
                        <div class="col">
                            <input type="text" class="form-control" id="sigle" name="sigle" placeholder="UFR-" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="denomination" class="col-sm-2 col-form-label">Dénomination</label>
                        <div class="col">
                            <input type="text" class="form-control" id="denomination" name="denomination" placeholder="..." required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="type" class="col-sm-2 col-form-label">Type </label>
                        <div class="col">
                            <select class="form-control" id="type" name="type" required>
                                <option value="" selected disabled hidden>Chosir</option>
                                <option value="UFR">UFR</option>
                                <option value="Institut">Institut</option>
                                <option value="Ecole">Ecole</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row py-2">
                        <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col">
                            <input type="number" class="form-control" id="telephone" name="telephone" placeholder="700000" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="adresse" class="col-sm-2 col-form-label">Adresse postale</label>
                        <div class="col">
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="BP" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="siteweb" class="col-sm-2 col-form-label">Adresse site web</label>
                        <div class="col">
                            <input type="text" class="form-control" id="siteWeb" name="siteWeb" placeholder="Adresse site web" required>
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col">
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                    </div>
                    <div class="form-group row py-2">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col">
                            <textarea class="form-control" id="description" name="description" required> </textarea>
                        </div>
                    </div>
                    <div class="row py-4">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col">
                            <button type=" submit button" class="btn btn-success">Enregsitrer</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('institutions.index') }}"> <button type="button" class="btn btn-danger">Annuler</button> </a>
                        </div>

                    </div>

                </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal détails-->
<div class="row">
<div class="modal fade" id="exampleModal2" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel1">Informations établissement</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <table id="data" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> 
                                    <td>Sigle</td> 
                                    <td id="sigle2"> </td>
                                </tr>
                                <tr> 
                                    <td>Dénomination</td> 
                                    <td id="denomination2"> </td>
                                </tr>
                                <tr> 
                                    <td>Type</td> 
                                    <td id="type2"> </td>
                                </tr>
                                <tr> 
                                    <td>Contact</td> 
                                    <td id="contact2"> </td>
                                </tr>
                                <tr> 
                                    <td>Adresse postale</td> 
                                    <td id="adresse2"> </td>
                                </tr>
                                <tr> 
                                    <td>Email</td> 
                                    <td id="email2"> </td>
                                </tr>
                                <tr> 
                                    <td>Logo</td> 
                                    <td id="logo2"> <img id="logo"> </td>
                                </tr>
                                <tr> 
                                    <td>Adresse de site web</td> 
                                    <td id="siteweb2"> </td>
                                </tr>
                                <tr> 
                                    <td>Détails</td> 
                                    <td id="description2"> </td>
                                </tr>
                                <tr> 
                                    <td>Actions</td> 
                                    <td> 
                                    
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal éditer-->
<div class="row">
<div class="modal fade" id="exampleModal3" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel1">Informations établissement</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                

                formulaire ici
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
    $(document).ready(function() {
        //Formulaire d'ajout d'établissement
        $(document).on('click', '#add', function() {
            var myModal = new bootstrap.Modal($("#exampleModal1"), {});
            myModal.show();

        });
        //Lancer modal details
        $(document).on('click', '.detail', function() {
            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                }
            });
            var id = $(this).attr('id');
            $.ajax({
                // 
                url: "/etablissements/view/" + id,
                method: "GET",
                dataType: "json",

                // Function to call when to
                // request is ok 
                success: function(data) {
                    $("#sigle2").text(data.result.sigle);
                    $("#denomination2").text(data.result.denomination);
                    $("#type2").text(data.result.type);
                    $("#contact2").text(data.result.contact);
                    $("#adresse2").text(data.result.adresse);
                    $("#email2").text(data.result.email);
                    $("#logo2").text(data.result.logo);
                    $("#siteweb2").text(data.result.siteweb);
                    $("#description2").text(data.result.description);
                    var myModal = new bootstrap.Modal($("#exampleModal2"), {});
                    myModal.show();
                },

                // Error handling 
                error: function(error) {
                    console.log("Error ${error}");
                }
            });

        });

        //Lancer modal editer
        $(document).on('click', '.edit', function() {
            
            var myModal = new bootstrap.Modal($("#exampleModal3"), {});
            myModal.show();

        });
    });


</script>
@endpush