@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection
@section('content-title')
<div style="font-weight: bold;">Users Management - ICOS and Regular Staff</div> 
@endsection

@section('content')
    <input id="auth" type="hidden" class="form-control" name="auth" value="{{ Auth::user()->user_type }}">
    <input id="staffname" type="hidden" class="form-control" name="staffname" value="{{ Auth::user()->fullname }}">
    <div class="add-category-row" style="display:none;">
        <button style="width:140px; border-radius:4px;"class="btn btn-primary" data-toggle="modal" data-target="#newUserModal">+ Add a User</button>
    </div>
        <div class = card-body>
            <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; font-size:14px; ">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Account Type</th>
                        <th>Division</th>
                        <th>Position</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
 <!-- Create New User -->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add a User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="createNewUserForm" method="POST" action="{{ url('save/ppe-category') }}">
                            @csrf
                               <div class="row">
                                        <div class="col-sm-4">
                                            <b>User Description</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="category_description" id="category_description" value="" required>
                                        </div>
                                    </div>
                                    <br/>
                        
                           
                            <div class="modal-footer">
                                <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>
<!-- Create New User-->

 <!-- View User -->   
      <div class="modal fade" id="userLibraryModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">View User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ url('update/users') }}">
                            @csrf
                             <input type="hidden" name="update_user_id" id="update_user_id" value="">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>Username</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="username" id="username" value="" disabled>
                                        </div>
                                   </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>Full Name</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="full_name" id="full_name" value="" disabled>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>Account Type</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="usertype" id="usertype" value="" disabled>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>Division</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="division" id="division" value="" disabled>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <b>Position</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="position" id="position" value="" disabled>
                                        </div>
                                    </div>
                                    <br/>
                              </div>
                            <div class="modal-footer">
                                <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>
<!-- View User -->
@endsection

@section('addJS')
@if(session('save-success-ppe-category'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "User Successfully Saved!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('update-success-ppe-category'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "User Successfully Updated!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('delete-success-ppe-category'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "User Successfully Deleted!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif
        <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('sufee-admin-dashboard-master/assets/json5/index.min.js') }}"></script>
        <script src="https://unpkg.com/json5@^2.0.0/dist/index.min.js"></script>
        <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            showData();
            
        });

        function showData(t)
        {
          var auth = $('#auth').val();
          $('#bootstrap-data-table').DataTable().destroy();
           //DATA TABLE INITIALIZE
           var t = $('#bootstrap-data-table').DataTable({
              lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
              buttons: [],
              select: true,
              dom: 'flBrtip',
              responsive: false,
              processing: true,
              serverSide: false,
              searching: true,
              paging: true,
              ajax: {
                type: "GET",
                url: "{{ url('users-management-table') }}"
              },
              columns: [
                {
                  data:null
                },
                {
                  data: "username", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "fname", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "lname", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "usertype", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "division_acro", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "position_desc_current", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                    "data" : null,
                    "defaultContent" : "<center><div class='uk-inline'> <button style='border-radius:4px; height:40px;width:120px;' class='uk-button uk-button-primary' type='button' aria-expanded='false'><i class='fa fa-caret-down'></i> <span style='font-size:10px;'>Action</span></button><div uk-dropdown='mode: click' class='uk-dropdown uk-dropdown-bottom-right' style='left: -102.953px; top: 40px;'> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-edit-category'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-eye'></i> View User</div></a></ul> </div></div></center>"
                }
              ],
              columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
              }],
              createdRow: function(row, data, dataIndex) {
                $(row).attr('data-id', data.id)
              }
            });
            t.on('order.dt search.dt', function() {
              t.column(0, {
                search: 'applied',
                order: 'applied'
              }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
              });
            }).draw();
        $('#bootstrap-data-table').on('click', '.row-edit-category', function(e) {
            let varID = getRowID(e.target);
            editUser(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-delete-category', function(e) {
            let varID = getRowID(e.target);
            deleteUser(varID);
        });

       function getRowID(element) {
       return $(element).parents('tr').attr('data-id')
       }
       t.clear().draw();
       }

       window.deleteRow = function(id){
       var table = $('#bootstrap-data-table').DataTable();
 
       $('#bootstrap-data-table tbody').on( 'click', 'deleterow', function () {
         table.row( $(this).parents('tr')).remove().draw();} );
        }

   
       function deleteUser(id)
       {
        Swal.fire({
            type: 'warning',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
            window.location.href = "{{ url('delete/ppe-category') }}/"+id;
            }
        
        })
      }
   
     function editUser(id)
      {
        $.getJSON( "{{ url('user/details') }}/"+ id, function( datajson ) {
                    }).done(function(datajson){
                        jQuery.each(datajson,function(i,obj){
                        $("#full_name").val(obj.fullname);
                        $("#username").val(obj.username);
                        $("#usertype").val(obj.usertype);
                        $("#division").val(obj.division_acro);
                        $("#position").val(obj.position_desc_current);
                        });
                    }).fail(function() {
                        alert("Error loading data! Page reloading, please wait...")
                        location.reload();
        });
        $("#userLibraryModal").modal("toggle");
      }
    </script>
@endsection