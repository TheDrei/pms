@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection
@section('content-title')
<div style="font-weight: bold;">Last Used Series Library</div> <br/>
<small>These values update when new data is inputted in both Supplies and Equipment modules.</small>
@endsection

@section('content')
    <input id="auth" type="hidden" class="form-control" name="auth" value="{{ Auth::user()->user_type }}">
    <input id="staffname" type="hidden" class="form-control" name="staffname" value="{{ Auth::user()->fullname }}">
        <div class = card-body>
            <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; font-size:14px; ">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Last Used Series</th>
                        <th>Type</th>
                        <th style="text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
            </table>
        </div>

 <!-- Update LastUsedSeries -->   
 <div class="modal fade" id="lastUsedSeriesLibraryModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Update Last Used Series</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ url('update/last-used-series') }}">
                            @csrf
                             <input type="hidden" name="update_last_used_series_id" id="update_last_used_series_id" value="">
                                    <div class="row">
                                          <div class="col-sm-4">
                                              <b>Last Used Series</b>
                                          </div>
                                          <div class="col-sm-8">
                                              <input type="number" class="form-control" name="update_last_used_series" id="update_last_used_series" value="">
                                          </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                          <div class="col-sm-4">
                                              <b>Type</b>
                                          </div>
                                          <div class="col-sm-8">
                                              <select class="form-control" name="update_type" id="update_type" value="">
                                                <option value="" disabled selected">Select a Type</option>
                                                <option value="PAR">PAR</option>
                                                <option value="ICS">ICS</option> 
                                              </select>
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
<!-- Update LastUsedSeries -->

@endsection

@section('addJS')
@if(session('save-success-last-used-series'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Data Successfully Saved!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('update-success-last-used-series'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Data Successfully Updated!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('delete-success-ppe-last-used-series'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Data Successfully Deleted!",
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
                url: "{{ url('last-used-series-table') }}"
              },
              columns: [
                {
                  data:null
                },
                {
                  data: "last_used_series", render: function (data) {
                     if (data == 0) {return '-';}
                     return data;
                  }
                },
                {
                  data: "type", 
                },
                {
                    "data" : null,
                    "defaultContent" : "<center><div class='uk-inline'> <button style='border-radius:4px; height:40px;width:120px;' class='uk-button uk-button-primary' type='button' aria-expanded='false'><i class='fa fa-caret-down'></i> <span style='font-size:10px;'>Action</span></button><div uk-dropdown='mode: click' class='uk-dropdown uk-dropdown-bottom-right' style='left: -102.953px; top: 40px;'> <ul class='uk-nav uk-dropdown-nav'> <li> <a href='#' class='row-edit-last-used-series'> <div style='font-size:18px; font-weight:normal;'><i style='color:#0077bb!important;' class='menu-icon fa fa-edit'></i> Edit</div></a> </li></ul> </div></div></center>"
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
        $('#bootstrap-data-table').on('click', '.row-edit-last-used-series', function(e) {
            let varID = getRowID(e.target);
            editLastUsedSeries(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-delete-last-used-series', function(e) {
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
            window.location.href = "{{ url('delete/ppe-last-used-series') }}/"+id;
            }
        
        })
      }
   
     function editLastUsedSeries(id)
      {
        $.getJSON( "{{ url('get/last-used-series') }}/"+ id, function( datajson ) {
                    }).done(function(datajson){
                        jQuery.each(datajson,function(i,obj){
                        $("#update_last_used_series_id").val(obj.id);
                        $("#update_last_used_series").val(obj.last_used_series);
                        $("#update_last_used_series_number").val(obj.type);
                        });
                    }).fail(function() {
                        alert("Error loading data! Page reloading, please wait...")
                        location.reload();
        });
        $("#lastUsedSeriesLibraryModal").modal("toggle");
      }
    </script>
@endsection