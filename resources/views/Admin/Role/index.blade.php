@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h1>
                Roles
            </h1>
        </div>

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
                                        <th><a href="{{route('assign.permission')}}" class="btn btn-primary">Assign Permission</a></th>
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