const permissionTable = $('#permissionTable');
const permissionDeleteFormId = $('#permissionId');
const deletePermissionForm = $('#deletePermissionForm');
const btnSubmit = $('.btn-submit');
const btnUpdate = $('.btnUpdate');
const addPermission = $('#addPermission');
const formSubmit = $('#formSubmit');
const updatePermission = $('#updatePermission');
const deleteButtonColor = 'red'
const cancelButtonColor = 'blue'
var editPermissionId;


btnSubmit.on('click', function () {

    btnLoading(true, btnSubmit);
    formSubmit.submit();
});


$('.btnUpdate').on('click', function () {
    btnLoading(true, btnUpdate);
    updateUser.submit();
});



var optionsDateTime = {
    year: 'numeric',
    month: 'short',
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit"
};



$(document).ready(function () {

    permissionTable.DataTable({
        lenghtMenu: [[10, 25, 50, -1], ['10', '25', '50', 'All']],
        order: [[0, "desc"]],
        language: {
            searchPlaceholder: "Search Permission",
            // processing: spinner,
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: permissionRoute,
            /* data: function data() {
                d.status = 'all';
                if(filterStatus){
                    d.status = filterStatus;
                }
            }, */
            error: function (xhr, error, thrown) {
                // console.log('xhr: ', xhr, 'error : ', error, ' thrown :', thrown);
                if (thrown == 'Unauthorized') {
                  alert('Your session has been expired');
                  window.location.reload()
                }
              }
        },
        columns: [
            // {   data: 'DT_RowIndex',
            //     name: 'DT_RowIndex',
            //     render: function render(data) {
            
            //         return data;}},
            {
                data: 'name',
                name: 'name',
                render: function render(data) {
                    return data;
                }
             },
            {
                data: 'action',
                name: 'action',
                render: function render(data) {
                    return data;
                },
                orderable: true,
                searchable: true,

            }]
    });
});

function destroy(id) {
    Swal.fire({
        title: 'Are you sure? ',
        text: 'Do you want to delete this Permission!',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: deleteButtonColor,
        cancelButtonColor: cancelButtonColor,
        confirmButtonText: "Delete",
        reverseButtons: true,

    }).then((result) => {
        if (result.value === true) {
            console.log(id);
            permissionDeleteFormId.val(id);
            deletePermissionForm.submit();
        }

    });
}

//   submit button loader
 

// getting value of delete record button
$(document).on('click', '.delete-permission', function () {
    console.log($(this).data('id'))
    destroy($(this).data('id'));
});

// Add New Investor
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 
$(document).ready(function(){
    $('#submitBtn').click(function(){

        var name = $('#name').val();
        
        $.ajax({
            url: newPermission,
            method: 'POST',
            data: {
                name : name
            },
            success: function(response) {
                alert(response);
                console.log(response)
                // $('#permissionModal').modal('hide');
                $('#permissionModal').modal('hide');
                permissionTable.DataTable().ajax.reload();

            },
            error: function(xhr) {
                // Handle the error response here
                var errors = JSON.parse(xhr.responseText)
                console.log(errors);

                console.log(xhr.responseJSON);
                if(xhr.responseJSON.errors.name)
                {
                    $('.error-name').html(xhr.responseJSON.errors.name[0])
                    $('.error-name').show()
                }
            }
        })
        $('#permissionModal').modal('hide');

    })
})

// Modal Close
$('#modalClose, .close').click(function(e){
    $('#newPermission').trigger("reset")
    hideErrorMessage('.error-name')
       
})
function hideErrorMessage( errorId) {
      $( errorId).hide();
  }
  $(document).ready(function(){
    $('#name').keypress(function(e) {
        hideErrorMessage('.error-name')
      });
  })


//Edit Modal

$(document).ready(function () {

    $('body').on('click', '.edit-permission', function () {

        editPermissionId = $(this).data('id');
        console.log(editPermissionId);
        const permissionUrl = '/permission/' + editPermissionId + '/edit';
        // var userURL = $(this).attr('href', '/investor/' + editInvestorId + '/edit');

        $.ajax({
            url: permissionUrl,
            type: 'GET',
            success: function(data) {
                // alert('check console')
                // console.log(data)
                $('#edit-name').val(data.name);
                $('#permissionEditModal').modal('show');
                },
            error: function(xhr, status, error) {
                // Handle error response
                console.log(error);
            }
        });
        
   });
  
    $('body').on('click', '#permission-update', function () {
         console.log(editPermissionId);
        // var editPermissionId = $('.edit-permission').data('id');
        // console.log(editPermissionId);
        // return ;
        const permissionUrl = '/permission/' + editPermissionId;
        var name =  $('#edit-name').val();
            
        $.ajax({
            url: permissionUrl,
            type: 'PUT',
            dataType: 'json',
            data: { name: name},
            success: function(data) {
                console.log(data);
                $('#permissionEditModal').modal('hide');
                permissionTable.DataTable().ajax.reload();
                alert(data.success);
            }
        });

   });
     
});

// 
