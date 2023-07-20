@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h1>
                Roles
            </h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif



    </div>
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="permissionTable" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Assign Permission</th>
                                </tr>
                                @foreach ($roles as $role )
                                    <tr>
                                        <th>{{ucfirst($role->name)}}</th>
                                        @if($role->name != 'admin')
                                        <th><a href="{{route('assign.permission',['id'=>$role->id])}}" class="btn btn-primary" >Assign Permission</a></th>
                                        @else
                                        <th><a href="#" class="btn btn-success" style="cursor: not-allowed;">All Permissions Assigned</a></th>
                                        @endif
                                    </tr>                                       
                                @endforeach
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


@endsection