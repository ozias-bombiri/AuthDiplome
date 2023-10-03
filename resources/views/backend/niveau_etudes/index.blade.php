@extends('includes.master')

@section('contenu')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
               
                <a class="btn btn-success" href="{{ route('niveau_etudes.create') }}"> Ajouter</a>
             
            </div>
        </div>

    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($niveaux as $niveau)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $niveau->intitule }}</td>
	        <td>{{ $niveau->description }}</td>
	        <td>
                <form action="{{ route('niveau_etudes.destroy',$niveau->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('niveau_etudes.show',$niveau->id) }}">Show</a>  
                    <a class="btn btn-primary" href="{{ route('niveau_etudes.edit',$niveau->id) }}">Edit</a>
                   
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                  
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


   


@endsection