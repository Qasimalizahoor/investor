@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-sm-6">
            <h1>
                Assign Permission
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
                                    <th>Permission</th>
                                    <th>Assign Permission</th>
                                </tr>
                            </thead>
                            <form action="{{route('assing.permission-to-role')}}" method="POST">
                                @csrf
                                @method('POST')
                                <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{$permission->name}}</td>
                                            <td data-id="{{$permission->id}}"><input type="checkbox" id="{{$permission->id}}" name="permission[]" value="{{$permission->id}}"></td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                {{-- <tfoot> --}}
                                    <div class=" float-right">
                                        <button type="submit" class="btn btn-primary btn-lg mb-3">Submit</button>
                                    </div>
                                {{-- </tfoot> --}}
                                
                        </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection