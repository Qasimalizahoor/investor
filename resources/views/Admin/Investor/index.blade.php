@extends('layouts.app')

@section('content')
    


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h1>
                Investor Records
            </h1>
        </div>

        <div class="col-sm-6 text-right ">

            {{-- <label><strong>Status :</strong></label> --}}
            <select  id='statusChange' class="form-control selectpicker float-end ms-1 bg-primary text-white" style="width: 180px" >
                <option   data-key='0' class="bg-white  text-dark">Filter By Status</option>
                {{-- Here will be Statuses --}}
                @foreach ($statuses as $status )


                <option  data-key="{{ $status->id }}" class="bg-white  text-dark">{{ ucfirst($status->status) }}</option>

                @endforeach
            </select>
            {{-- @if(auth()->user()->can('add-user'))
                <a href="{{ route('users.create') }}" class=" btn btn-success float-end addNewUser">Add New User</a>
            @endif --}}
            @can('add-investor')
            <button type="button" class="btn btn-success float-end addNewUser" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal">Add New User</button>
            @endcan
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="investorTable" width="100%">
                            <thead>
                                <tr>
                                    {{-- <th>Sr. No </th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone </th>
                                    <th>BEP20 Address</th>
                                    <th>Status</th>
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
<form id="deleteInvestorForm" method="post" action="{{ route('investor.destroy',['investor'=>0]) }}">
    @csrf
    @method('delete')
    <input type="hidden" name="user_id" id="investorId" value="0">
</form>

{{-- <form id="restoreUserForm" method="post" action="{{ route('users.restore',['id'=>0]) }}">
    @csrf
    <input type="hidden" name="user_restore" id="userRestore" value="0">
</form> --}}


{{-- Modal for Create User --}}


<!-- The Modal -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Investor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your input fields here -->
                <form id="newInvestor" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="field1">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <small class="form-text text-danger error-name"></small>
                        
                    </div>
                    <div class="form-group">
                        <label for="field1">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                        <small class="form-text text-danger error-email"></small>
                        
                    </div>
                    <div class="form-group">
                        <label for="field2">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                        <small class="form-text text-danger error-phone"></small>
                        
                    </div>
                    <div class="form-group">
                        <label for="field3">BEP20 Address</label>
                        <input type="text" id="address" name="address" class="form-control">
                        <small class="form-text text-danger error-address"></small>
                        
                    </div>
                    {{-- <div class="form-group">
                        <label for="field4">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <small class="form-text text-danger error-password"></small>
                        
                    </div> --}}
                    {{-- <button class="btn btn-success" id="submitBtn"> Submit</button> --}}
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

<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
        </div>
    
        <div class="modal-body">
            <form id="editInvestor" method="POST" >
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="field1">Name</label>
                    <input type="text" id="edit-name" name="name" class="form-control">
                    <small class="form-text text-danger error-name"></small>
                    
                </div>
                <div class="form-group">
                    <label for="field1">Email</label>
                    <input type="text" id="edit-email" name="email" class="form-control">
                    <small class="form-text text-danger error-email"></small>
                    
                </div>
                <div class="form-group">
                    <label for="field2">Phone</label>
                    <input type="text" id="edit-phone" name="phone" class="form-control">
                    <small class="form-text text-danger error-phone"></small>
                    
                </div>
                <div class="form-group">
                    <label for="field3">BEP20 Address</label>
                    <input type="text" id="edit-address" name="address" class="form-control">
                    <small class="form-text text-danger error-address"></small>
                    
                </div>
                {{-- <div class="form-group">
                    <label for="field4">Password</label>
                    <input type="password" id="edit-password" name="password" class="form-control">
                    <small class="form-text text-danger error-password"></small>
                     --}}
                {{-- </div> --}}
                {{-- <button class="btn btn-success" id="submitBtn"> Submit</button> --}}
            </form>
        </div>
    
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="user-update">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




@endsection
@section('script')

<script>
    const investorRoute = "{{ route('ajax.investor') }}"
    const newInvestor = "{{ route('investor.store') }}"

</script>
<script src="{{ asset('js/pages/investor.js') }}"></script>
@endsection