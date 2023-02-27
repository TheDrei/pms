@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection
@section('content-title')
<div style="font-weight: bold;">Fund Cluster Library</div> 
@endsection

@section('content')
    <input id="auth" type="hidden" class="form-control" name="auth" value="{{ Auth::user()->user_type }}">
    <input id="staffname" type="hidden" class="form-control" name="staffname" value="{{ Auth::user()->fullname }}">
    <div class="add-category-row">
        <button style="width:200px; border-radius:4px;"class="btn btn-primary" data-toggle="modal" data-target="#newFundClusterModal">+ Add Fund Cluster</button>
    </div>
        <div class = card-body>
            <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; font-size:14px; ">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Fund Cluster</th>
                        <th>Status</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>
 <!-- Create New Fund Cluster -->
    <div class="modal fade" id="newFundClusterModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add a Fund Cluster</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="createNewFundClusterForm" method="POST" action="{{ url('save/fund-cluster') }}">
                            @csrf
                            <div class="row">
                                       <div class="col-sm-4">
                                            <b>Fund Cluster</b>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="number" class="form-control" name="fund_cluster" id="fund_cluster" value="" required>
                                        </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                                    <div class="col-sm-4">
                                                        <b>Status</b>
                                                    </div>
                                                    <div class="col-sm-8">
                                                    <select class="form-control" data-placeholder="Select a Status" name="status" id="status" value="" required>
                                                        <option selected disabled>Select a Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        </select>
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
<!-- Create New Fund Cluster-->

 <!-- Update Fund Cluster -->   
      <div class="modal fade" id="updateFundClusterModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Update Sub-Fund Cluster</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ url('update/fund-cluster') }}"> 
                            @csrf
                            <div class="row">
                            <input type="hidden" class="form-control" name="update_fund_cluster_id" id="update_fund_cluster_id" value="" required>
                                       <div class="col-sm-4">
                                            <b>Fund Cluster</b>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="update_fund_cluster" id="update_fund_cluster" value="" required>
                                        </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                                    <div class="col-sm-4">
                                                        <b>Status</b>
                                                    </div>
                                                    <div class="col-sm-8">
                                                    <select class="form-control" data-placeholder="Select a Status" name="update_status" id="update_status" value="" required>
                                                        <option selected disabled>Select a Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        </select>
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

<!-- Update Fund Cluster -->
@endsection

@section('addJS')
@if(session('save-success-fund-cluster'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Fund Cluster Successfully Saved!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('update-success-fund-cluster'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Fund Cluster Successfully Updated!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('delete-success-ppe-subcategory'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Fund Cluster Successfully Deleted!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif
        <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datetime-moment.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            showData();
                $("#parent_category").select2({
                theme: "classic", 
                dropdownParent: "#newFundClusterModal",
                closeOnSelect: true,
                width: '100%',
                });

                $("#update_parent_category").select2({
                theme: "classic", 
                dropdownParent: "#updateFundClusterModal",
                closeOnSelect: true,
                width: '100%',
                });

                $.getJSON("{{ url('json/ppe-type/all') }}", function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                $("#parent_category").append("<option value='" + obj.type + "'>" + obj.type + "</option>");
                });
                });

                $.getJSON("{{ url('json/ppe-type/all') }}", function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                $("#update_parent_category").append("<option value='" + obj.type + "'>" + obj.type + "</option>");
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
                url: "{{ url('get/library/fund-cluster') }}"
              },
              columns: [
                {
                  data:null
                },
                {
                  data: "fund_cluster", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "status", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                    "data" : null,
                    "defaultContent" : "<center><div class='uk-inline'> <button style='border-radius:4px; height:40px;width:120px;' class='uk-button uk-button-primary' type='button' aria-expanded='false'><i class='fa fa-caret-down'></i> <span style='font-size:10px;'>Action</span></button><div uk-dropdown='mode: click' class='uk-dropdown uk-dropdown-bottom-right' style='left: -102.953px; top: 40px;'> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-edit-category'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-edit'></i> Edit Fund Cluster</div></a> </li><li> <a href='#' class='row-delete-category'> <div style='font-size:18px; font-weight:normal;'><i style='color:red!important;' class='menu-icon fa fa-trash'></i> Delete Fund Cluster </div></a> </li></ul> </div></div></center>"
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
            editFundCluster(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-delete-category', function(e) {
            let varID = getRowID(e.target);
            deleteFundCluster(varID);
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

   
       function deleteFundCluster(id)
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
            window.location.href = "{{ url('delete/fund-cluster') }}/"+id;
            }
        
        })
      }
   
     function editFundCluster(id)
      {
        $.getJSON( "{{ url('get/fund-cluster') }}/"+ id, function( datajson ) {
                    }).done(function(datajson){
                        jQuery.each(datajson,function(i,obj){
                        $("#update_fund_cluster_id").val(obj.id);
                        $("#update_status").val(obj.status).change();
                        $("#update_fund_cluster").val(obj.fund_cluster);
                        });
                    }).fail(function() {
                        alert("Error loading data! Page reloading, please wait...")
                        location.reload();
        });
        $("#updateFundClusterModal").modal("toggle");
      }
    </script>
@endsection