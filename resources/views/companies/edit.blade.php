@extends('companies.layout')
     
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h2>Edit Company</h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
                </div>
            </div>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('companies.update', $companies->id) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" value="{{ $companies->name }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="text" name="email" value="{{ $companies->email }}" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Logo</strong>
                        <input type="file" name="image" class="form-control" placeholder="image">
                        <img src="{{ url('public/storage/images/'.$companies->logo) }}" width="100">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Website</strong>
                        <input type="text" name="website" value="{{ $companies->website }}" class="form-control" placeholder="Website">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        
        </form>
    </div>
@endsection