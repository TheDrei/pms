@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection
@section('content-title')
<div style="font-weight: bold;">Users Management - Project Staff</div> 
@endsection

@section('content')
    <input id="auth" type="hidden" class="form-control" name="auth" value="{{ Auth::user()->user_type }}">
    <input id="staffname" type="hidden" class="form-control" name="staffname" value="{{ Auth::user()->fullname }}">
    <div class="add-category-row">
        <button style="width:140px; border-radius:4px;"class="btn btn-primary" data-toggle="modal" data-target="#newProjectStaffModal"><i class="fa fa-plus"></i> Add a User</button>
    </div>
        <div class = card-body>
            <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; font-size:14px; ">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Employee ID</th>
                        <th>Full Name</th>
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
<div class="modal fade" id="newProjectStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProjectStaffModalLabel">Add a Project Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ url('add/projectstaff') }}">
        @csrf
      <div class="modal-body">
          <div class="col-sm-4">
            <b>Employee ID</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="employee_id" id="employee_id" value=""  style="text-transform:uppercase"  required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Full Name</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="full_name" id="full_name" value=""  style="text-transform:uppercase"  required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Account Type</b>
          </div>
          <div class="col-sm-8">
          <select class="form-control"  name="account_type" id="account_type" required>
             <option disabled>Select Account Type</option>
             <option selected value="Staff">Staff</option>
          </select>
          <br/>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Division</b>
          </div>
          <div class="col-sm-8">
          <select class="form-control"  name="division" id="division" required>
          <option selected disabled>Select Division</option>
          </select>
          <br/>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Position</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="position" id="position"  value="Contractual" required>
          <br/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Create New User-->

 <!-- View User -->   
 <div class="modal fade" id="updateProjectStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProjectStaffModalLabel">Update Project Staff Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ url('update/projectstaff') }}">
        @csrf
      <div class="modal-body">
      <input type="hidden" class="form-control" name="update_projectstaff_id" id="update_projectstaff_id" value="" s required>
          <div class="col-sm-4">
            <b>Employee ID</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="update_employee_id" id="update_employee_id" value=""  style="text-transform:uppercase"  required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Full Name</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="update_full_name" id="update_full_name" value=""  style="text-transform:uppercase"  required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Account Type</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="update_account_type" id="update_account_type"  value="" required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Division</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="update_division" id="update_division"   value="" required>
          <br/>
          </div>

          <div class="col-sm-4">
            <b>Position</b>
          </div>
          <div class="col-sm-8">
          <input type="text" class="form-control" name="update_position" id="update_position"    value="" required>
          <br/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-dismiss="modal">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- View User -->
@endsection

@section('addJS')
@if(session('save-success-projectstaff'))
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

@if(session('update-success-projectstaff'))
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

@if(session('delete-success-projectstaff'))
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
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            showData();
            $('#account_type').select2({
            theme: "classic", 
            dropdownParent: "#newProjectStaffModal",
            closeOnSelect: true,
            width: '100%',
            });

            $('#division').select2({
            theme: "classic", 
            dropdownParent: "#newProjectStaffModal",
            closeOnSelect: true,
            width: '100%',
            });

            $.getJSON("{{ url('json/division/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
              $("#division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
              $("#update_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
            });
          });

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
                url: "{{ url('projectstaff-management-table') }}"
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
                  data: "fullname", render: function (data) {
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
                    "defaultContent" : "<center><div class='uk-inline'> <button style='border-radius:4px; height:40px;width:120px;' class='uk-button uk-button-primary' type='button' aria-expanded='false'><i class='fa fa-caret-down'></i> <span style='font-size:10px;'>Action</span></button><div uk-dropdown='mode: click' class='uk-dropdown uk-dropdown-bottom-right' style='left: -102.953px; top: 40px;'> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-edit-user'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-edit'></i> Edit User</div></a></ul> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-delete-user'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-times'></i> Delete User</div></a></ul> </div></div></center>"
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
        $('#bootstrap-data-table').on('click', '.row-edit-user', function(e) {
            let varID = getRowID(e.target);
            editUser(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-delete-user', function(e) {
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
            window.location.href = "{{ url('delete/projectstaff') }}/"+id;
            }
        
        })
      }
   
     function editUser(id)
      {
        $.getJSON( "{{ url('get/projectstaff') }}/"+ id, function( datajson ) {
                    }).done(function(datajson){
                        jQuery.each(datajson,function(i,obj){
                        $("#update_projectstaff_id").val(obj.id);
                        $("#update_employee_id").val(obj.username);
                        $("#update_full_name").val(obj.fullname);
                        $("#update_account_type").val(obj.usertype);
                        $("#update_division").val(obj.division_acro);
                        $("#update_position").val(obj.position_desc_current);
                        });
                    }).fail(function() {
                        alert("Error loading data! Page reloading, please wait...")
                        location.reload();
        });
        $("#updateProjectStaffModal").modal("toggle");
      }
    </script>
@endsection