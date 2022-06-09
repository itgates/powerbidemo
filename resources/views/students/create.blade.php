@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if ( session('status') )
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Student
                        <a href="{{url('students')}}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('add-student') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name"></input>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">email</label>
                            <input type="text" class="form-control" name="email"></input>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">course</label>
                            <input type="text" class="form-control" name="course"></input>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image"></input>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection