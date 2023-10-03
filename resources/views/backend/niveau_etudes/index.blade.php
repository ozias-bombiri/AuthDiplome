@extends('includes.master')

@section('contenu')

<div class="card">
    <div class="card-header">{{ __('Niveau d\'étude') }}</div>

    <div class="card-body">

        <div class="table-responsive">
            {{$dataTable->table()}}
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