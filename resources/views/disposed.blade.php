@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-title')
		Disposed
@endsection

@section('content')
	 <table id="bootstrap-data-table" class="table table-striped table-bordered" style="font-size: 14px;background-color: #FFF">
                    <thead  class="thead-dark">
                      <tr>
                        <th style="width: 2%">#</th>
                        <th>DESCRIPTION</th>
                        <th>PROPERTY NUMBER</th>
                        <th>SERIAL NUMBER</th>
                        <th>REMARKS</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
@endsection

@section('addJS')
	<script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/data-table/datatables-init.js') }}"></script>

    <script type="text/javascript">
    	$(document).ready(function() {
          var t = $('#bootstrap-data-table').DataTable();
         


    	$.getJSON( "{{ url('json/viewequipemp') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                        if(obj.equip_status == 4)
                        {

	                          t.row.add( [
	                                    "",
	                                    obj.prop_desc,
	                                    obj.prop_num,
	                                    obj.equip_serial_num,
	                                   	obj.equip_remarks
	                            ] ).draw( false );      
	                        
                    	}
                  }); 
            });

        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    	});
    </script>
@endsection
