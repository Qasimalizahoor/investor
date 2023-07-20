const investorTable = $('#investorTable');
const investorDeleteFormId = $('#investorId');
const userRestore = $('#investorRestore');
const deleteInvestorForm = $('#deleteInvestorForm');
const btnSubmit = $('.btn-submit');
const btnUpdate = $('.btnUpdate');
const addUser = $('#addInvestor');
const formSubmit = $('#formSubmit');
const updateUser = $('#updateInvestor');
const deleteButtonColor = 'red'
const cancelButtonColor = 'blue'
var i = 1;
var filterStatus;
var selected;



// $(document).on('click','.restore-user',function(){
//     restore($(this).data('id'));
// })
btnSubmit.on('click', function () {

    btnLoading(true, btnSubmit);
    formSubmit.submit();
});
// */
// $("#addUser").submit(function () {
//     if ($(this).valid()) {  //<<< I was missing this check
//         $("#loading").show();
//     }
// });

$('.btnUpdate').on('click', function () {
    btnLoading(true, btnUpdate);
    updateUser.submit();
});

$(document).ready(function (){
    
    $('#statusChange').on('change', function () {
        filterStatus =  $(this).find('option:selected').data('key');
        // console.log(filterStatus);
        // console.log(hotelTable);
        try{
            investorTable.draw();
        }
        catch(err){
            console.log(err);
            try {
                investorTable.DataTable().ajax.reload();
            }
            catch(err){
                console.log(err);
                investorTable.reload();
            }
        }
    });
});


var optionsDateTime = {
    year: 'numeric',
    month: 'short',
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit"
};



$(document).ready(function () {

    investorTable.DataTable({
        lenghtMenu: [[10, 25, 50, -1], ['10', '25', '50', 'All']],
        order: [[0, "desc"]],
        language: {
            searchPlaceholder: "Search Investor",
            // processing: spinner,
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: investorRoute,
            data: function data(d) {
                d.status = 'all';
                if(filterStatus){
                    d.status = filterStatus;
                }
            },
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

                data: 'user.name',
                name: 'user.name',
                render: function render(data) {
                    return data;
                }
            },
            {

                data: 'user.email',
                name: 'user.email',
                render: function render(data) {
                    return data;
                }
            },
            {

                data: 'phone',
                name: 'phone',
                render: function render(data) {
                    return data;
                }
            },

            {
                data: 'address',
                name: 'address',
                render: function render(data) {
                    return data;
                }
            },
            {
                data: 'status.status',
                name: 'status.status',
                render: function render(data) {
                    // var statusName = data.translations[0].name
                    var statusName = data;
                    var status;
                    switch(statusName) {
                        case 'pending':
                        status = statusName;
                        className = 'badge bg-warning';
                          break;
                        case 'in_progress':
                            status = statusName;
                            className = 'badge bg-warning';
                          break;
                        case 'not_approved':
                            status = statusName;
                            className = 'badge bg-danger';
                          break;
                        case 'approved':
                            status = statusName;
                            className = 'badge bg-success';
                          break;
                        default:
                            status = statusName;
                            className = 'badge bg-info';
                      }

                    return `<span class="${className} text-capitalize">${status}</span>`;


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
        text: 'Do you want to delete this Investor!',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: deleteButtonColor,
        cancelButtonColor: cancelButtonColor,
        confirmButtonText: "Delete",
        reverseButtons: true,

    }).then((result) => {
        if (result.value === true) {
            console.log(id);
            investorDeleteFormId.val(id);
            deleteInvestorForm.submit();
        }

    });
}
// function restore(id) {
//     Swal.fire({
//         title: 'Are you sure? ',
//         text: 'Do you want to Restore this User!',
//         icon: "question",
//         showCancelButton: true,
//         confirmButtonColor: deleteButtonColor,
//         cancelButtonColor: cancelButtonColor,
//         confirmButtonText: "Restore",
//         reverseButtons: true,

//     }).then((result) => {
//         if (result.value === true) {
//             userRestore.val(id);
//             restoreUserForm.submit();
//         }

//     });
// }

//   submit button loader

$(".btnSubmit").on('click', function () {

    btnLoading(true, btnSubmit);
    addUser.submit();
});
  

// getting value of delete record button
$(document).on('click', '.delete-investor', function () {
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
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var password = $('#password').val();
        
        $.ajax({
            url: newInvestor,
            method: 'POST',
            data: {
                name : name,
                email : email,
                phone : phone,
                address : address,
                password : password,
            },
            success: function(response) {
                // $('#myModal').hide();
                // $('#myModal').addClass('hidden');
                // $('#myModal').modal('hide');
                console.log($('#myModal').modal('hide'));
                investorTable.DataTable().ajax.reload();

            },
            error: function(xhr) {
                // Handle the error response here
                var errors = JSON.parse(xhr.responseText)
                console.log(errors);

                console.log(xhr.responseJSON);
                    
                if(xhr.responseJSON.errors.address)
                {
                    $('.error-address').html(xhr.responseJSON.errors.address[0])
                    $('.error-address').show()
                }

                if(xhr.responseJSON.errors.phone)
                {
                    $('.error-phone').html(xhr.responseJSON.errors.phone[0])
                    $('.error-phone').show()
                }
                if(xhr.responseJSON.errors.email)
                {
                    $('.error-email').html(xhr.responseJSON.errors.email[0])
                    $('.error-email').show()
                }
                if(xhr.responseJSON.errors.name)
                {
                    $('.error-name').html(xhr.responseJSON.errors.name[0])
                    $('.error-name').show()
                }
            }
        })
        // $('#myModal').hide();

    })
})

// Modal Close
$('#modalClose, .close').click(function(e){
    $('#newInvestor').trigger("reset")
    hideErrorMessage('.error-name')
    hideErrorMessage('.error-email')
    hideErrorMessage('.error-phone')
    hideErrorMessage('.error-address')
    hideErrorMessage('.error-password')
       
})
function hideErrorMessage( errorId) {
      $( errorId).hide();
  }
  $(document).ready(function(){
    $('#name').keypress(function(e) {
        hideErrorMessage('.error-name')
      });
      $('#email').keypress(function(e) {
        hideErrorMessage('.error-email')
      });
      $('#phone').keypress(function(e) {
        hideErrorMessage('.error-phone')
      });
      $('#address').keypress(function(e) {
        hideErrorMessage('.error-address')
      });
      $('#password').keypress(function(e) {
        hideErrorMessage('.error-password')
      });
  })


//Edit Modal

$(document).ready(function () {

    $('body').on('click', '.edit-investor', function () {

        var editInvestorId = $(this).data('id');
        const userUrl = '/investor/' + editInvestorId + '/edit';
        // var userURL = $(this).attr('href', '/investor/' + editInvestorId + '/edit');

        $.ajax({
            url: userUrl,
            type: 'GET',
            success: function(data) {
                $('#edit-name').val(data.user.name);
                $('#edit-email').val(data.user.email);
                $('#edit-phone').val(data.phone);
                $('#edit-address').val(data.address);
                // $('#edit-name').val(data.user.name);

                $('#userEditModal').modal('show');
                },
            error: function(xhr, status, error) {
                // Handle error response
                console.log(error);
            }
        });
        
        // $('#user-id').val($(this).parents("tr").find("td:nth-child(1)").text());
        // $('#user-name').val($(this).parents("tr").find("td:nth-child(2)").text());
        // $('#user-email').val($(this).parents("tr").find("td:nth-child(3)").text());

   });
  
    $('body').on('click', '#user-update', function () {
        var editInvestorId = $('.edit-investor').data('id');
        const userUrl = '/investor/' + editInvestorId;
        var name =  $('#edit-name').val();
        var email = $('#edit-email').val();
        var phone = $('#edit-phone').val();
        var address = $('#edit-address').val();
       

        $.ajax({
            url: userUrl,
            type: 'PUT',
            dataType: 'json',
            data: { name: name, email: email, phone: phone, address: address},
            success: function(data) {
                $('#userEditModal').modal('hide');
                investorTable.DataTable().ajax.reload();
                alert(data.success);
            }
        });

   });
     
});

// 
