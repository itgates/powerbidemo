@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Students
                        <a href="{{ url('add-student') }}" class="btn btn-primary float-end">Add Studnet</a>
                    </h4>
                </div>
                <div class="card-body">
                    Card Body.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection