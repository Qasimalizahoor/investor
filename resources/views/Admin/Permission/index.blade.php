@extends('layouts.app')

@section('content')
    


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h1>
                Permissions
            </h1>
        </div>

        <div class="col-sm-6 text-right ">

            {{-- <label><strong>Status :</strong></label> --}}
            {{-- <select  id='statusChange' class="form-control selectpicker float-end ms-1 bg-primary text-white" style="width: 180px" >
                <option   data-key='0' class="bg-white  text-dark">Filter By Status</option>
                {{-- Here will be Statuses --}}
                {{-- @foreach ($statuses as $status )


                <option  data-key="{{ $status->id }}" class="bg-white  text-dark">{{ ucfirst($status->status) }}</option>

                @endforeach 
            </select> --}}
            {{-- @if(auth()->user()->can('add-user'))
                <a href="{{ route('users.create') }}" class=" btn btn-success float-end addNewUser">Add New User</a>
            @endif --}}
            <button type="button" class="btn btn-success float-end addNewPermission" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#permissionModal">Add New Pemission</button>
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
                                    {{-- <th>Sr. No </th> --}}
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<!-- Delete Permission Form -->
<form id="deletePermissionForm" method="post" action="{{ route('permission.destroy',['permission'=>0]) }}">
    @csrf
    @method('delete')
    <input type="hidden" name="permission_id" id="permissionId" value="0">
</form>

{{-- <form id="restoreUserForm" method="post" action="{{ route('users.restore',['id'=>0]) }}">
    @csrf
    <input type="hidden" name="user_restore" id="userRestore" value="0">
</form> --}}


{{-- Modal for Create User --}}


<!-- The Modal -->

<div class="modal fade" id="permissionModal">
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Permission</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          
            <div class="modal-body">
                <!-- Your input fields here -->
                <form id="newPermission" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="field1">Permission Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <small class="form-text text-danger error-name"></small>
                        
                    </div>
                </form>
            </div>
          
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button class="btn btn-success" id="submitBtn"> Submit</button>
                <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal">Close</button>
            </div>
      
        </div>
    </div>
</div>


{{-- Edit User --}}

<div class="modal fade" id="permissionEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
        </div>
    
        <div class="modal-body">
            <form id="editPermission" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="field1">Name</label>
                    <input type="text" id="edit-name" name="name" class="form-control">
                    <small class="form-text text-danger error-name"></small>
                    
                </div>
            </form>
        </div>
    
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="permission-update">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




@endsection
@section('script')

<script>
    const permissionRoute = "{{ route('ajax.permission') }}"
    const newPermission = "{{ route('permission.store') }}"

</script>
<script src="{{ asset('js/pages/permission.js') }}"></script>
@endsection