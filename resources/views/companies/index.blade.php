@extends('companies.layout')
     
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 margin-tb">
                <div class="float-left">
                    <h2>Company List</h2>
                </div>
            </div>
            <div class="col-lg-6 margin-tb">
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
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
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($companies as $company)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td><img src="{{ url('public/storage/images/'.$company->logo) }}" width="100px"></td>
                <td>{{ $company->website }}</td>
                <td>
                    <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        
        {!! $companies->links() !!}
    </div>
@endsection