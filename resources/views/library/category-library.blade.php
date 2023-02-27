@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection
@section('content-title')
<div style="font-weight: bold;">Category Library</div> 
@endsection

@section('content')
    <input id="auth" type="hidden" class="form-control" name="auth" value="{{ Auth::user()->user_type }}">
    <input id="staffname" type="hidden" class="form-control" name="staffname" value="{{ Auth::user()->fullname }}">
    <div class="add-category-row">
        <button style="width:140px; border-radius:4px;"class="btn btn-primary" data-toggle="modal" data-target="#newCategoryModal">+ Add Category</button>
    </div>
        <div class = card-body>
            <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; font-size:14px; ">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
 <!-- Create New Category -->
    <div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add a Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="createNewCategoryForm" method="POST" action="{{ url('save/ppe-category') }}">
                            @csrf
                               <div class="row">
                                        <div class="col-sm-4">
                                            <b>Category Description</b>
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
<!-- Create New Category-->

 <!-- Update Category -->   
      <div class="modal fade" id="categoryLibraryModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Update Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ url('update/ppe-category') }}">
                            @csrf
                             <input type="hidden" name="update_category_id" id="update_category_id" value="">
                                  <div class="row">
                                        <div class="col-sm-4">
                                            <b>Description</b>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="update_category_description" id="update_category_description" value="">
                                        </div>
                                    </div>
                                    <br/>
                                  </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                </div>

<!-- Update Category -->
@endsection

@section('addJS')
@if(session('save-success-ppe-category'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Category Successfully Saved!",
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
    text: "Category Successfully Updated!",
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
    text: "Category Successfully Deleted!",
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
                url: "{{ url('get/library/ppe-category') }}"
              },
              columns: [
                {
                  data:null
                },
                {
                  data: "type", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                    "data" : null,
                    "defaultContent" : "<center><div class='uk-inline'> <button style='border-radius:4px; height:40px;width:120px;' class='uk-button uk-button-primary' type='button' aria-expanded='false'><i class='fa fa-caret-down'></i> <span style='font-size:10px;'>Action</span></button><div uk-dropdown='mode: click' class='uk-dropdown uk-dropdown-bottom-right' style='left: -102.953px; top: 40px;'> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-edit-category'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-edit'></i> Edit Category</div></a> </li><li> <a href='#' class='row-delete-category'> <div style='font-size:18px; font-weight:normal;'><i style='color:red!important;' class='menu-icon fa fa-trash'></i> Delete Category </div></a> </li></ul> </div></div></center>"
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
            editCategory(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-delete-category', function(e) {
            let varID = getRowID(e.target);
            deleteCategory(varID);
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

   
       function deleteCategory(id)
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
   
     function editCategory(id)
      {
        $.getJSON( "{{ url('get/ppe-category') }}/"+ id, function( datajson ) {
                    }).done(function(datajson){
                        jQuery.each(datajson,function(i,obj){
                        $("#update_category_id").val(obj.id);
                        $("#update_category_description").val(obj.type);
                        });
                    }).fail(function() {
                        alert("Error loading data! Page reloading, please wait...")
                        location.reload();
        });
        $("#categoryLibraryModal").modal("toggle");
      }
    </script>
@endsection