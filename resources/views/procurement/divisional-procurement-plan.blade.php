@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<style>
  .table td {
    font-size: 14px;
  }

  .table th {
    font-size: 12px;
  }

  .modal-dialog {
    overflow-y: initial !important
  }

  .custom {
  height: 90vh;
  overflow-y: auto;
  }  

  .spinner {
  opacity: 100%;  
  width: 100px;  
  position: fixed;
  z-index: 1;
  top: 40%;
  left: 50%;
  margin-left: -2em;
}
</style>
@endsection


@section('content-title')
Divisional Project Procurement Management Plan
@endsection
@section('content')

 <!-- START ADD NEW DPPMP MODAL  -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document" style="width:1000px; padding-right:1100px; padding-left: 600px;">
          <div class="modal-content" style="width:600px;">
            <div class="modal-header">
              <h5 class="modal-title" id="dppmpModal">Divisional Project Management Procurement Plan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="saveICS" method="POST" action="{{ url('save/dppmp') }}">
                @csrf
                <div class="card">
                  <div class="card-body">
                      @include('form-view/dppmp-view')
                        <div class="modal-footer" style="width:100%;  position: sticky;">
                          <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" onclick="generateDPPMP()" style="border-radius:4px;" type="button" class="btn btn-primary">Generate</button>
                        </div>
                   </div>
                 </div>
              </form>
           </div>
     </div>
   </div>
</div>
<!-- END ADD EQUIPMENT MODAL -->

<!-- START MODAL -->
<div class="modal fade" id="editEquipment">
  <div class="modal-dialog modal-md" role="document" style="width:1500px; padding-right:1100px; padding-left: 300px;">
  <div class="modal-content custom" style="width:900px; overflow-x:hidden;">
      <div class="modal-header">
        <h5 class="modal-title">Update Supply</h4>
      </div>
      <form id="saveICS" method="POST" action="{{ url('update-ics') }}">
                @csrf
                <div class="card">
                  <div class="card-body">
                     <input type="hidden" name="update_equipment_id" id="update_equipment_id" value="">
                     <input type="hidden" name="update_set_id" id="update_set_id" value="">
                     <input type="hidden" name="equipment_sets" id="equipment_sets" value="">
                     <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value="">
                      @include('form-view/ics-view-edit')
                      
                        <div class="modal-footer" style="width:100%;  position: sticky;">
                          <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                   </div>
                 </div>
              </form>
    </div>
  </div>
</div>
<!-- END MODAL -->

<!-- START TRANSFER -->
<div class="modal fade" id="transferEquipment">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 10px;">
      <div class="modal-header">
        <h5 class="modal-title">Transfer Equipment</h4>
      </div>

      <form method="POST" action="{{ url('transfer-ics') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
        <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
        <input type="hidden" name="transfer_division" id="transfer_division" value="">
        <input type="hidden" name="transfer_position" id="transfer_position" value="">
        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">
            <br/>
              <div class="row form-group" style="padding-left:10px;">
                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Division</label></div>
                <div class="col-12 col-md-4">
                  <select name="transfer_select_division" id="transfer_select_division" data-placeholder="Select a Division" class="form-control" required>
                    <option value="" disabled selected>----Select Division----</option>
                  </select>
                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Transfer To</label></div>
                <div class="col-12 col-md-6">
                  <select name="transfer_propassign_form" id="transfer_propassign_form" data-placeholder="Select a Staff" class="form-control" onchange="getDivision(this.value)" required>
                    <option value="" selected></option>
                  </select>
                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Remarks</label></div>
                <div class="col-12 col-md-6">
                  <textarea class="form-control" name='transfer_remarks' id="transfer_remarks" required></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="hide-label">

                  </thead>
                    
                 </div>
                </div>
                </div>
              </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

          </div>
        </div>
        <br>
        <p align="right" style="padding-right:300px;">
          <button type="submit" style="border-radius:4px;" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Transfer</button>
          <a href="" data-dismiss="modal" class="btn btn-danger btn-md">Cancel</a>
        </p>
      </form>
    </div>
  </div>
</div>
<!-- END TRANSFER -->

<!-- START TRANSFER REPORT -->
<div class="modal fade" id="transferReport">
<div class="modal-dialog modal-md" role="document" style="width:1000px; padding-right:1200px; padding-left: 330px;">
  <div class="modal-content custom" style="width:1000px; overflow-x:hidden;">
      <div class="modal-header">
        <h5 class="modal-title">Transfer Report</h4>
      </div>

      <form method="POST" action="{{ url('transfer-report') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
        <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
        <input type="hidden" name="transfer_division" id="transfer_division" value="">
        <input type="hidden" name="transfer_position" id="transfer_position" value="">
       
        <div id="inventoryTransferReportPrint">
          @include('form-view/inventory-transfer-view')
        </div>
     
        <br>
        <div class="modal-footer" style="width:100%;  position: sticky;">
        <p align="right" style="padding-right:100px;">
          <button type="submit" style="border-radius:4px;" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Generate</button>
          <a href="" data-dismiss="modal" class="btn btn-danger btn-md">Cancel</a>
        </p>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END TRANSFER REPORT-->

<!-- START VIEW HISTORY -->
<div class="modal fade" id="viewHistory">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 10px;">
      <div class="modal-header">
        <h5 class="modal-title">
          History</h4>
      </div>
      @csrf <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
      <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
      <input type="hidden" name="transfer_division" id="transfer_division" value="">
      <input type="hidden" name="transfer_position" id="transfer_position" value="">

      <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="card">
            <table id="history-datatable" class="table" style="background-color: #FFF;width: 100%; ">
              <thead class="thead-light">
                <tr>
                  <th style="width: 2%">#</th>
                  <th>Staff</th>
                  <th>Division</th>
                  <th>Action</th>
                  <th>Date/Time of Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="row form-group">
              <div class="hide-label">
                </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END VIEW HISTORY -->




    <button id="equipmentButton" type="button" style="border-radius:4px; float:right;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i>&nbsp; Filter</button>
    <p align="left"><button id="equipmentButton" type="button" style="border-radius:4px;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Generate Divisional Project Procurement Plan</button></p>
    <div class = "card-body">
    <table id="dppmp-data-table" class="table table-striped table-hover" style="background-color: #FFF;width: 100%; ">
      <thead class="thead-light">
        <tr>
          <th style="width: 2%">#</th>
          <th style="width: 10%">DIVISION</th>
          <th style="width: 30%">FUNDING</th>
          <th>CHARGING</th>
          <th>YEAR</th>
          <th>FROM</th>
          <th>TO</th>
          <th>DATE GENERATED</th>
          <th width="10%">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>

        <!-- START FILTER MODAL  -->
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModal" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="filterModal">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="filterICS" method="POST" action="">
                  @csrf
                  <div class="card">
                    <div class="card-body">
                      <div class="row form-group">
                          <div class="col col-md-2"><label for="text-input" class=" form-control-label">Division</label></div>
                          <div class="col-12 col-md-12">
                            <select class="form-control" name='filter_division' id="filter_division" placeholder="Division" required>
                            <option selected disabled>Select a Division</option>
                            </select>  
                          </div>
                        </div>

                      <div class="modal-footer">
                        <button type="button" style="border-radius:4px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" onclick="filterICS()"  data-dismiss="modal" style="border-radius:4px;" class="btn btn-primary">Confirm</button>
                        </form>
                      </div>
                      </div>
              </div>
              </div>
            </div>
          </div>
        </div>
<!-- END FILTER MODAL -->

     
@endsection
@section('addJS')
@if(session('message'))
<script type="text/javascript">
Swal.fire({
    title: "Success",
    text: "Report Successfully Generated!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-edited'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "ICS Supply Successfully Edited!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-transferred'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "ICS Supply Successfully Transferred!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-disposed'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "ICS Supply Successfully Disposed!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-deleted'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "DPPMP Report Successfully Deleted!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-accept'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "ICS Supply Successfully Accepted!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-ledgercard'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "Semi-Expendable Property Ledger Card Details Successfully Saved!",
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
  var subcattext = $("option:selected", "#prop_subcat").text();
  var initial_staff = 0;
  var initial_components = 0;
  var initial_tab = 0;

  var propassign_formvar = $("#select_staff").val();
  var prop_umeasure = $('#prop_umeasure').val();


  $(document).ready(function() {

    $( "#date_ics" ).change(function() {
      var date_ics = moment(this.value).format('LL');
      $('#issued-by-date').html(date_ics);
    });

    
    $( "#date_acquired" ).change(function() {
      var date_acquired = moment(this.value).format('LL');
      $('#received-by-date').html(date_acquired);
    });

    $("#update_date_ics").change(function() {
      var date_ics = moment(this.value).format('LL');
      $('#update-issued-by-date').html(date_ics);
    });

    $( "#update_date_acquired" ).change(function() {
      var date_acquired = moment(this.value).format('LL');
      $('#update-received-by-date').html(date_acquired);
    });

    $('#ics_number_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#ics_number').val('No ICS No. Data');
            if(!ischecked)
            $('#ics_number').val('');
        });

        $('#location_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#location').val('No Location Data');
            if(!ischecked)
            $('#location').val('');
        });

        $('#fund_cluster_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#fund_cluster").append("<option selected value='No Fund Cluster Data'>No Fund Cluster Data</option>");
            if(!ischecked)
            $("#fund_cluster option[value='No Fund Cluster Data']").each(function() {
                    $(this).remove();
                })
        });

        $('#date_ics_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#date_ics").val('');
            $('#date_ics').removeAttr('required');
            if(!ischecked)
            $("#date_ics").prop('required',true);
        });

        $('#date_acquired_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#date_acquired").val('');
            $('#date_acquired').removeAttr('required');
            if(!ischecked)
            $("#date_acquired").prop('required',true);
        });

        $('#remarks_from_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#remarks_from').val('No Purchased From Data');
            if(!ischecked)
            $('#remarks_from').val('');
        });

        $('#remarks_sales_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#remarks_sales').val('No Sales Invoice No. Data');
            if(!ischecked)
            $('#remarks_sales').val('');
        });

        $('#remarks_sales_date_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#remarks_sales_date").val('');
            $('#remarks_sales_date').removeAttr('required');
            if(!ischecked)
            $("#remarks_sales_date").prop('required',true);
        });

        $('#remarks_po_num_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#remarks_po_num').val('No PO/PCV No. Data');
            if(!ischecked)
            $('#remarks_po_num').val('');
        });

        $('#remarks_po_date_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#remarks_po_date").val('');
            $('#remarks_po_date').removeAttr('required');
            if(!ischecked)
            $("#remarks_po_date").prop('required',true);
        });

        $('#remarks_pr_num_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#remarks_pr_num").val('No PR No. Data');
            if(!ischecked)
            $('#remarks_pr_num').val('');
        });

        $('#remarks_pr_date_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#remarks_pr_date").val('');
            $('#remarks_pr_date').removeAttr('required');
            if(!ischecked)
            $("#remarks_pr_date").prop('required',true);
        });

        $('#remarks_charged_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#remarks_charged').val('No Charged to Data');
            if(!ischecked)
            $('#remarks_charged').val('');
        });


    $('.dppmp-select').select2({
      dropdownParent: "#dppmpModal",
      theme: "classic",
      closeOnSelect: true,
      width: '100%',
    });


    $('#filter_division').select2({
      theme: "classic", 
      dropdownParent: "#filterICS",
      closeOnSelect: true,
      width: '100%',
    });

    $('#update_select_division').select2({
            dropdownParent: "#editEquipment",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
    });

    $('#update_select_staff').select2({
            dropdownParent: "#editEquipment",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
    });
  

    $('#update_ics_category').select2({
      theme: "classic", 
      dropdownParent: "#editEquipment",
      closeOnSelect: true,
      width: '280px',

    });

    $('#ics_type').select2({
      theme: "classic", 
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      width: '280px',

    });

 
    $('#select_staff').select2({
      theme: "classic", 
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      width: '100%',

    });

    $('#update_propassign_form').select2({
      theme: "classic",
      dropdownParent: "#editEquipment",
      closeOnSelect: true,
      width: '100%',

    });

    $('#transfer_propassign_form').select2({
      theme: "classic",
      dropdownParent: "#transferEquipment",
      closeOnSelect: true,
      width: '100%',

    });

    $('#select_division').select2({
      theme: "classic",
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      width: '100%',

    });

    $('#transfer_select_division').select2({
      theme: "classic",
      dropdownParent: "#transferEquipment",
      closeOnSelect: true,
      width: '100%',

    });


    //FILTER DIVISION ON ISSUED TO DROP-DOWN
    $("#select_division").on('change', function() {
      $("#select_staff").empty();
      $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          $("#select_staff").append("<option value=''>Select a Staff</option>");
          $("#select_staff").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
        });

      });

    });
    //FILTER DIVISION ON ISSUED TO DROP-DOWN

    // Display Position on Change
    $("#select_staff").on('change', function() {
            $.getJSON("{{ url('get/position') }}/" + this.value, function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                $("#employee_position").html(obj.position_desc_current);
                $("#employee_position_get").val(obj.position_desc_current);
                $("#employee_division").html(obj.division_acro);
                $("#employee_division_get").val(obj.division_acro);
                });
            });
        });

        
        $("#update_select_staff").on('change', function() {
            $.getJSON("{{ url('get/position') }}/" + this.value, function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                 $("#update_employee_position").html(obj.position_desc_current);
                 $("#update_employee_division").html(obj.division_acro);
                });
            });
        });
     // Done Display Position.
 
     $("#update_select_division").on('change', function() {
            $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {
              //  $("#update_select_staff").empty();
                jQuery.each(datajson, function(i, obj) {
                    $("#update_select_staff").append("<option value=''>Select a Staff</option>");
                    $("#update_select_staff").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                 
                });
              
            });
        });
  
  
    //FILL DROP-DOWN
    $.getJSON("{{ url('json/users/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#update_propassign_form").append("<option value='" + obj.fullname + "'>" + obj.fullname + "</option>");

      });

    });
    //END FILL DROP-DOWN
    $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
        $("#dppmp_funding").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
        $("#update_fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
        $("#itr_fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
      });
    });

    $.getJSON("{{ url('json/charging/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#dppmp_charging").append("<option value='" + obj.charging + "'>" + obj.charging + "</option>");
      });
    });

    // $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
    //   jQuery.each(datajson, function(i, obj) {
       
    //   });
    // });

    // $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
    //   jQuery.each(datajson, function(i, obj) {
       
    //   });
    // });

    $(".show_pcv_by_list").hide();
    $("#ics_type").on('change', function() {
      if (this.value == "PCV") {
        $(".show_pcv_by_list").show();
      } else {
        $(".show_pcv_by_list").hide();
      }
    });



    //TRANSFER FILTER DIVISION ON ISSUED TO DROP-DOWN
    $("#transfer_select_division").on('change', function() {
      $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {

        $("#transfer_propassign_form").empty();

        jQuery.each(datajson, function(i, obj) {
          $("#transfer_propassign_form").append("<option value=''>Select a Staff</option>");
          $("#transfer_propassign_form").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
        });

      });

    });
    //TRANSFER DIVISION ON ISSUED TO DROP-DOWN


    $('.hidden_component').css('display', 'none');

    $('#editEquipment').on('hidden.bs.modal', function() {
      location.reload();
    });


    //propQuantityCheck();
    hideElements();

    //Hide Number Input
    $('#categoryHidden').hide();
    $('#subcategoryHidden').hide();

    $("#select_staff").on('change', function() {
      // alert(this.value);
      var staffname = $("#select_staff option:selected").text();
      $("#getstaffemployeecode").val(this.value);
      $("#getstaffname").val(staffname);
    });

    $.getJSON("{{ url('json/division/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#update_select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
        $("#select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
        $("#transfer_select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
        $("#filter_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
        $("#dppmp_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
      });
    });


    //DELETE ROW in the DataTable
    window.deleteRow = function(id) {

      var table = $('#dppmp-data-table').DataTable({
        ajax: '/test/0',
        'processing': true,
        "serverSide": true,
        'language': {
          'loadingRecords': '&nbsp;',
          'processing': '<div class="spinner"></div>'
        }
      });



      $('#dppmp-data-table tbody').on('click', 'deleterow', function() {
        table.row($(this).parents('tr')).remove().draw();
      });
    }

    //START INDIVIDUAL COMPONENT CLASSIFICATION
    var ctr = 0;
    $('#addComponents').click(function() {
      ctr += 1;
      // console.log(ctr);

    window.getCategory = function(category) {
        var subcattext = $("option:selected", "#equip_subcat_1").text();
        $.getJSON("{{ url('get/subcategories') }}/" + category, function(datajson) {
          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            $("#category").text(obj.type);
            $("#prop_class_" + ctr + "").val(obj.type);
            $("#getSubcategory_" + ctr + "").val(obj.sub_type);
            $("#categoryHidden").val(obj.type);
            $("#subcategoryHidden").val(subcattext);

          });

        }).fail(function() {
          alert(Error);
        });
        //END LOAD JSON SUB-CLASS
      }
    });


    //ADD COMPONENTS  
    window.addComponents = function(id) {
      var del_btn = "";

      if (id != 0) {
        var proctr = 0;
        del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        proctr -= 1;
      }

      //GET PROPERTY NUMBER WITH INCREMENTAL ID
      var propnum = $("#prop_num").val();
      var propassign_formvar = $("#select_staff").val();
      var totalval = $("#prop_total_val").val();
      $("#prop_component").val(totalval);
      var prop_subcat = $("#prop_subcat").val();
      var proctr = 1 + ($(".prop_component_ctr").length);
      var proassignctr = 1 + ($(".prop_assign_ctr").length);
      console.log(proctr);
      //END GET PROPERTY NUMBER WITH INCREMENTAL ID

      //CHECK EMPTY FIELDS
      if ($('#select_staff').val() != '') {
        var propassign_formvar = $("#select_staff option:selected").text();
      }
      //END CHECK

      //COMPONENT TEXT-INPUT NEWER
      $("#property-table tr:last").after("<tr><td class='solid-borders'><input style='font-size:12px; width:200px;' type='text' class='form-control' name='inventory_item_number[]' value=''></td><td class='solid-borders'><select onchange='getCategory(this.value)' style='font-size:12px;' name='equip_subcat[]' id='equip_subcat_" + proctr + "' class='form-control prop_assign_ctr' required><option value='' disabled selected>Select a Sub-Category</option></select></td><td class='solid-borders'><input style='font-size:11px; width:200px;' type='text' class='form-control' name='equipment_category[]' id='equipment_category_" + proctr + "' required></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_" + proctr + "' required></textarea></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_" + proctr + "' required></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='text' class='form-control' name='equip_subprop_num[]' value='" + proctr + "'></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + proctr + "' value='' required></td><td class='solid-borders'><input style='font-size:12px; width:90px;' type='number' class='form-control' name='estimated_useful_life[]' id='estimated_useful_life_" + proctr + "' value='' required></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='number' step='any' class='form-control unit-cost' name='unit_cost[]' id='unit_cost_" + proctr + "' value='' required></td><td class='solid-borders'>" + del_btn + "</td></tr>");

        $(".unit-cost").on("keydown keyup", function() {
            calculateSum();
        });

      function calculateSum() {
       var sum = 0;
        $(".unit-cost").each(function() {
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
            $(this).css("background-color", "#FEFFB0");
        }
        else if (this.value.length != 0){
            $(this).css("background-color", "red");
        }
        });
 
        $("#total_cost").html(sum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       }

      $("#equip_subcat_" + proctr + "").select2({
        theme: "classic",
        dropdownParent: "#property-table tr:last",
        closeOnSelect: true,
        width: '280px',

      });
      
      //DELEGATE ON CHANGE 
      $(document).on("change", "#equip_subcat_" + proctr + "", function() {
        $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            // $("#category").text(obj.type);
            $("#equipment_category_" + proctr + "").val(obj.type);
            $("#estimated_useful_life_" + proctr + "").val(obj.estimated_useful_life);
            $("#getSubcategory_" + proassignctr + "").val(obj.sub_type);
            $("#categoryHidden").val(obj.type);
            $("#subcategoryHidden").val(subcattext);
          });

        }).fail(function() {
          alert(Error);
        });
      });
      //DELEGATE ON CHANGE 

    //DELEGATE ON CHANGE 
         $(document).on("change", "#update_comp_equip_subcat_" + proctr + "", function() {
        $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            // $("#category").text(obj.type);
            $("#equipment_category_" + proctr + "").val(obj.type);
            $("#estimated_useful_life_" + proctr + "").val(obj.estimated_useful_life);
            $("#getSubcategory_" + proassignctr + "").val(obj.sub_type);
            $("#categoryHidden").val(obj.type);
            $("#subcategoryHidden").val(subcattext);
          });

        }).fail(function() {
          alert(Error);
        });
      });
      //DELEGATE ON CHANGE 

      $("#property-table tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control'>");
      $("#edit-property-table tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control'>");

      $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          $("#equip_subcat_" + proctr).append("<option value='" + obj.id + "'>" + obj.sub_type + "</option>");
        });
      });
      
    }

    //EDIT ADD COMPONENTS
    var ctr = 0;
    $('#editAddComponents').click(function() {
      ctr += 1;
      // console.log(ctr);

    window.getCategory = function(category) {
        var subcattext = $("option:selected", "#equip_subcat_1").text();
        $.getJSON("{{ url('get/subcategories') }}/" + category, function(datajson) {
          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            $("#category").text(obj.type);
            $("#prop_class_" + ctr + "").val(obj.type);
            $("#getSubcategory_" + ctr + "").val(obj.sub_type);
            $("#categoryHidden").val(obj.type);
            $("#subcategoryHidden").val(subcattext);

          });

        }).fail(function() {
          alert(Error);
        });
        //END LOAD JSON SUB-CLASS
      }
    });

    window.editAddComponents = function(id) {
      var del_btn = "";

      if (id != 0) {
        var proctr = 0;
        del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        proctr -= 1;
      }

      //GET PROPERTY NUMBER WITH INCREMENTAL ID
      var propnum = $("#prop_num").val();
      var propassign_formvar = $("#select_staff").val();
      var totalval = $("#prop_total_val").val();
      $("#prop_component").val(totalval);
      var prop_subcat = $("#prop_subcat").val();
      var proctr = 1 + ($(".prop_component_ctr").length);
      var proassignctr = 1 + ($(".prop_assign_ctr").length);
      // console.log(proctr);
      //END GET PROPERTY NUMBER WITH INCREMENTAL ID

      //CHECK EMPTY FIELDS
      if ($('#select_staff').val() != '') {
        var propassign_formvar = $("#select_staff option:selected").text();
      }
      //END CHECK

      //COMPONENT TEXT-INPUT NEWER
      $("#edit-property-table tr:last").after("<tr><td class='solid-borders'><input style='font-size:12px; width:300px;' type='text' class='form-control' name='inventory_item_number[]' value=''></td><td class='solid-borders'><select onchange='getCategory(this.value)' style='font-size:12px;' name='equip_subcat[]' id='equip_subcat_" + proctr + "' class='form-control prop_assign_ctr' required><option value='' disabled selected>Select a Sub-Category</option></select></td><td class='solid-borders'><input style='font-size:11px; width:200px;' type='text' class='form-control' name='equipment_category[]' id='equipment_category_" + proctr + "' required></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_" + proctr + "' required></textarea></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_" + proctr + "' required></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='text' class='form-control' name='equip_subprop_num[]' value='" + proctr + "'></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + proctr + "' value='' required></td><td class='solid-borders'><input style='font-size:12px; width:90px;' type='number' class='form-control' name='estimated_useful_life[]' id='estimated_useful_life_" + proctr + "' value='' required></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='number' step='any' class='form-control unit-cost' name='unit_cost[]' id='unit_cost_" + proctr + "' value='' required></td><td class='solid-borders'>" + del_btn + "</td></tr>");

        $(".unit-cost").on("keydown keyup", function() {
            calculateSum();
        });

      function calculateSum() {
       var sum = 0;
        $(".unit-cost").each(function() {
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
            $(this).css("background-color", "#FEFFB0");
        }
        else if (this.value.length != 0){
            $(this).css("background-color", "red");
        }
        });
 
        $("#total_cost").html(sum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       }

      $("#equip_subcat_" + proctr + "").select2({
        theme: "classic",
        dropdownParent: "#edit-property-table tr:last",
        closeOnSelect: true,
        width: '280px',

      });
      
      //DELEGATE ON CHANGE 
      $(document).on("change", "#equip_subcat_" + proctr + "", function() {
        $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            // $("#category").text(obj.type);
            $("#equipment_category_" + proctr + "").val(obj.type);
            $("#estimated_useful_life_" + proctr + "").val(obj.estimated_useful_life);
            $("#getSubcategory_" + proassignctr + "").val(obj.sub_type);
            $("#categoryHidden").val(obj.type);
            $("#subcategoryHidden").val(subcattext);
          });

        }).fail(function() {
          alert(Error);
        });
      });
      //DELEGATE ON CHANGE 

      $("#property-table tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control'>");

      $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          $("#equip_subcat_" + proctr).append("<option value='" + obj.id + "'>" + obj.sub_type + "</option>");
        });
      });
      
    }

    
    //EDIT ADD COMPONENTS 

    //GET DIVISION2
    window.getDivision2 = function(empcode) {
      $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
        //LOAD JSON CLASS
        jQuery.each(datajson, function(i, obj) {
          $("#division").val(obj.division_acro);
          $("#position").val(obj.position_desc_current);
          $("#fullname").val(obj.fullname);
          $("#update_fullname").val(obj.fullname);
          $("#update_position").val(obj.position_desc_current);
          $("#update_division").val(obj.division_acro);
          $("#transfer_fullname").val(obj.fullname);
          $("#transfer_division").val(obj.division_acro);
        });

      }).fail(function() {
        alert(Error);
      });
      //END LOAD JSON SUB-CLASS
    }

    //GET DIVISION
    window.getDivision = function(empcode) {
      $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
        //LOAD JSON CLASS
        jQuery.each(datajson, function(i, obj) {
          $("#division").val(obj.division_acro);
          $("#position").val(obj.position_desc_current);
          $("#fullname").val(obj.fullname);
          $("#update_fullname").val(obj.fullname);
          $("#update_position").val(obj.position_desc_current);
          $("#update_division").val(obj.division_acro);
          $("#transfer_fullname").val(obj.fullname);
          $("#transfer_division").val(obj.division_acro);
          $("#transfer_position").val(obj.position_desc_current);
        });

      }).fail(function() {
        alert(Error);
      });
      //END LOAD JSON SUB-CLASS
    }


    //DELETE COMPONENTS
    window.delComponents = function(id) {
      var whichtr = $(id).closest("tr");
      whichtr.remove();

    }

    function hideElements() {

      $("#prop_umeasure").change(function() {
        if ($("#prop_umeasure").val() == "unit") {
          //$(".replace-tab-text").text("Unit");
          $(".hide-label").show();

        } else if ($("#prop_umeasure").val() == "set") {
          /// $(".replace-tab-text").text("Set");
          $(".hide-label").show();
        }
      });

    }


    function resetTab() {
     
      var propassign_formvar = $("#select_staff").val();
      $("#nav-tab").empty().append('<a class="replace-tab-text nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#sub-item-1" role="tab" aria-controls="nav-home" aria-selected="false">Set 1</a>');

      $("#nav-tabContent").append('<div class="tab-pane fade show" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab"><div class="card"><div class="card-body"><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div><div class="col-12 col-md-6"><input type="text" name="prop_num[]" id="prop_num_1" class="form-control propassignformctr" value="" required></div></div><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div><div class="col-12 col-md-6"><input type="text" name="prop_total_val[]" id="prop_total_val_1" class="form-control" value="" required></div></div><div class="row form-group"><div class="col-12 col-md-2 "><label for="text-input" class="form-control-label">Issued To</label></div><div class="col-12 col-md-6"><select name="propassign_form[]" id="select_staff" data-placeholder="Select a Staff" class="form-control propassign_ctr" required><option value="' + propassign_formvar + '" selected>' + propassign_formvar + '</option></select></div></div><div class="hide-label"><h7>Add Components <a href="#" class="btn btn-primary btn-sm" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br/><br/><table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px"><thead class="thead-light"><th style="width:20%">Component Name</th><th style="width:50%">Serial No.</th><th style="width:2%">Date Issued</th><th style="width:100%">Issued To</th><th style="width:2%"></th></thead></table></div></div></div>');
    }

    var t = $('#dppmp-data-table').DataTable({
      "stateSave": true,
      "processing": true,
      "serverSide": false,
      "paging": true,
      "ajax": {
        "type": "GET",
        "url": "{{ url('json/dppmp-list/all') }}"
      },
      "columns": [{
          "data": "dppmp_division"
        },
        {
          "data": "dppmp_funding"
        },
        {
          "data": "dppmp_charging"
        },
        {
          "data": "dppmp_year"
        },
        {
            data: "months_from", render: function(data) {
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            if (data == null) { return '-'; }
            return months[data - 1];
            }
        },
        {
            data: "months_to", render: function(data) {
            var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            if (data == null) { return '-'; }
            return months[data - 1];
            }
        },
        {
          "data": "id"
        },
        {
          "data": "created_at"
        },

        {
          "data": null,
          "defaultContent": "<div class='uk-inline'> <button style='border-radius:4px;' class='uk-button uk-button-primary' type='button'><i class='menu-icon fa fa-caret-down'></i> Action</button> <div uk-dropdown='mode: click'> <ul class='uk-nav uk-dropdown-nav'  style='height:30px; overflow-x: scroll; overflow-x:hidden;'> <li> <a href='#' class='row-delete-report'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-trash'></i> Delete Report</div></a> </li></ul> </div></div>"
        }
      ],
      "columnDefs": [{
        "targets": 4,
        "render": function(data, type, row) {
          if (data != "" && data != null && data.length > 150) {
            return `<p>${data.substring(0, 150)}...<a href='#' class='text-primary display-ppe-details'><u> See more</u> <a/></p>`
          }
          return data;
        }
      }],
      "createdRow": function(row, data, dataIndex) {
        $(row).attr('data-id', data.id)
      }
    });

      // Add a createdCell callback to modify the month cells
     $.fn.dataTable.defaults.createdCell = function (td, cellData, rowData, row, col) {
    // Check if the cell is in the month column (assuming the month column is the second column)
    if (col == 4) {
      // Convert the numerical month value to a string month name
      const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      const monthName = monthNames[cellData - 1];

      // Update the cell contents with the string month name
      $(td).html(monthName);
    }
  };

    //COUNTER
    t.on('order.dt search.dt', function() {
      t.column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();
    //COUNTER

    // TODO
    //action button event listeners
    $('#dppmp-data-table').on('click', '.row-delete-report', function(e) {
      let varID = getRowID(e.target);
      deleteReport(varID);

    });

    $('#dppmp-data-table').on('click', '.row-accept-equipment', function(e) {
      let varID = getRowID(e.target);
      acceptEquipment(varID);

    });

    $('#dppmp-data-table').on('click', '.row-revert-equipment', function(e) {
      let varID = getRowID(e.target);
      revertEquipment(varID);

    });

    $('#dppmp-data-table').on('click', '.row-dispose-equipment', function(e) {
      let varID = getRowID(e.target);
      disposeEquipment(varID);

    });

    $('#dppmp-data-table').on('click', '.row-transfer-equipment', function(e) {
      let varID = getRowID(e.target);
      transferEquipment(varID);

    });

    $('#dppmp-data-table').on('click', '.row-transfer-report', function(e) {
      let varID = getRowID(e.target);
      transferReport(varID);

    });

    $('#dppmp-data-table').on('click', '.row-view-history', function(e) {    
      let varID = getRowID(e.target);
      $.getJSON("{{ url('get/icscomponents-components') }}/" + varID, function(datajson) {
        viewHistory(datajson[0].set_id);
        }).done(function(datajson) {
          // window.location.reload();
        })
    });

    $('#dppmp-data-table').on('click', '.row-generate-semiexpendable-card', function(e) {
      let varID = getRowID(e.target);
      generateSemiExpendablePropertyCard(varID);
    });


    $('#dppmp-data-table').on('click', '.row-generate-ics', function(e) {
      let varID = getRowID(e.target);
      generateICS(varID);

    });

    $('#dppmp-data-table').on('click', '.row-delete-ics', function(e) {
      let varID = getRowID(e.target);
      deleteICS(varID);

    });

    $('#dppmp-data-table').on('click', '.row-ledger-card', function(e) {
      let varID = getRowID(e.target);
      generateLedgerCard(varID);

    });

    //TODO
    //See more displays full PPE details
    $('#dppmp-data-table').on('click', '.display-ppe-details', function(e) {
      let varID = getRowID(e.target);
      $.getJSON("{{ url('json/viewppedetails') }}/" + varID, function(datajson) {
        console.log(datajson)
      }).done(function(datajson) {
        $('.ppe-details').html(datajson['data'])
        $("#ppe_details_modal").modal("toggle")
      })

    })
  });

  //helper
  function getRowID(element) {
    return $(element).parents('tr').attr('data-id')
  }

  function editEquipmentdetails(id) {
    var loading = function() {
              var over = '<div id="overlay" class="spinner">' +
                  '<center><p class="spinner"><img src="{{ asset("sufee-admin-dashboard-master/images/loading.gif") }}">Loading</p></center>' +
                  '</div>';
              $(over).appendTo('body');
              
              setTimeout(function(){        
                $('#overlay').remove();
              }, 3000);
						
          };
         loading();
   
    window.updategetClass = function(id) {
      var subcattext = $("option:selected", "#update_prop_subcat").text();
      $.getJSON("{{ url('json/showcategory') }}/" + id, function(datajson) {}).done(function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          $("#update_category").text(obj.class_description);
          $("#update_prop_class").val(obj.class_description);
          $("#update_subcategoryHidden").val(subcattext);
          $("#update_categoryHidden").val(obj.class_description);
        });

      }).fail(function() {
        alert(Error);
      });
    };

    $.getJSON("{{ url('get/icscomponents') }}/" + id, function(datajson) {

      //COMPONENT TEXT-INPUT NEWER

      var del_btn = "";


      if (id != 0) {
        var proctr = 0;
        del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        proctr -= 1;
      }

      $.getJSON("{{ url('get/viewicscomponents-components') }}/" + datajson[0].id, function(datajson) {


      }).done(function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          var selectlength = ($(".selectlength").length);
          //COMPONENT TABLE 2
          $("#edit-property-table tr:last").after("<tr><td class='solid-borders'><input style='font-size:12px; width:300px;' type='text' class='form-control' name='update_comp_property_number[]' value='" + obj.inventory_item_number + "'></td><td class='solid-borders'><select onchange='updategetClass(this.value)' style='font-size:12px; width: 500px;' name='update_comp_equip_subcat[]' id='update_comp_equip_subcat_" + i + "' class='form-control prop_assign_ctr'><option value='" + obj.component_subclass + "' selected>" + obj.component_subclass + "</option></select></td><td class='solid-borders'><input style='font-size:14px; width:200px;' type='text' class='form-control' name='update_comp_prop_class[]' id='update_comp_prop_class_" + i + "' value='" + obj.component_classification + "'></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;' type='text' class='form-control prop_component_ctr' name='update_comp_prop_component[" + i + "]' id='update_comp_prop_component_" + i + "' value='" + obj.component_name + "'>" + obj.component_name + "</textarea></td><td class='solid-borders'><input style='font-size:12px; width:80px;' type='number' class='form-control' value='" + obj.quantity + "' name='update_component_quantity[]' id='update_component_quantity_" + i + "'></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='text' class='form-control' name='update_comp_subprop[]' id='update_comp_subprop_" + i + "' value='" + obj.component_subpropertynumber + "'></td><td class='solid-borders'><input style='font-size:12px;  width:200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + i + "' value='" + obj.serial_num + "'></td><td class='solid-borders'><input style='font-size:12px; width:90px;' min='0' type='number' class='form-control' name='update_estimated_useful_life[]' id='update_estimated_useful_life_" + i + "' value='" + obj.lifespan + "'></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='number' step='any' class='form-control update-unit-cost' name='update_unit_cost[]' id='update_unit_cost_" + i + "' value='" + obj.unit_cost + "'></td><td class='solid-borders'  class='selectlength'><select style='width: 100%' name='update_component_issued_to[" + i + "]' id='update_component_issued_to_" + i + "' onchange='getDivision2(this.value)' data-placeholder='Select a Staff' class='form-control' value='" + obj.fullname + "'><option value='" + obj.issued_to + "' selected>" + obj.fullname + "</option></select></td><td class='solid-borders'><input type='hidden' name='update_comp_equip_subcat_get[]' id='update_comp_equip_subcat_get_" + i + "' value='" + obj.component_subclass + "'  class='item-details'><input type='hidden' name='update_comp_icsnumber[]' id='update_comp_icsnumber_" + i + "' value='" + obj.component_subclass + "'  class='item-details'><input type='hidden' name='update_comp_division[]' id='update_comp_division_" + i + "' value='" + obj.division + "'  class='update-employee-details'><input type='hidden' name='update_comp_employeecode[]' id='update_comp_employeecode_" + i + "' value='" + obj.employee_code + "'  class='update-employee-details'><input type='hidden' name='update_comp_position[]' id='update_comp_position_" + i + "' value='" + obj.position + "'  class='update-employee-details'><input type='hidden' name='trigger_set_id_change[]' id='trigger_set_id_change_" + i + "' value='" + obj.set_id + "'  class='update-employee-details'>");
          updatecalculateSum();
          function updatecalculateSum() {
            var sum = 0;
              $(".update-unit-cost").each(function() {
              if (!isNaN(this.value) && this.value.length != 0) {
                  sum += parseFloat(this.value);
                  $(this).css("background-color", "#FEFFB0");
              }
              else if (this.value.length != 0){
                  $(this).css("background-color", "red");
              }
              });
              $("#update_total_cost").html(sum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            }
   
              $('#update_comp_equip_subcat_'+ i).select2({
                theme: "classic", 
                dropdownParent: "#editEquipment",
                closeOnSelect: true,
                width: '300px',
              });

           
              

             $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
                jQuery.each(datajson, function(p, obj) {
                  $("#update_comp_equip_subcat_" + i).append("<option value='" + obj.id + "'>" + obj.sub_type + "</option>");
                });
              });

              //DELEGATE ON CHANGE - Update Subcategory
              $(document).on("change", "#update_comp_equip_subcat_" + i + "", function() {
                $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
                  jQuery.each(datajson, function(d, obj) {
                        $("#update_comp_prop_class_"+i).val(obj.type);
                        $("#update_comp_equip_subcat_get_" + i).val(obj.sub_type);
                        $("#update_estimated_useful_life_"+ i).val(obj.estimated_useful_life);
                      });
                
                }).fail(function() {
                  alert(Error);
                });
              });
              //DELEGATE ON CHANGE 
             
               //DELEGATE ON CHANGE - Update Issued To
               $(document).on("change", "#update_component_issued_to_" + i + "", function() {
                $.getJSON("{{ url('get/users') }}/" + this.value, function(datajson) {}).done(function(datajson) {
                  jQuery.each(datajson, function(d, obj) {
                        $("#update_comp_division_"+i).val(obj.division_acro);
                        $("#update_comp_employeecode_"+i).val(obj.username);
                        $("#update_comp_position_"+i).val(obj.position_desc_current);
                      });
                
                }).fail(function() {
                  alert(Error);
                });
              });
              //DELEGATE ON CHANGE 

               

              $.getJSON("{{ url('json/users/all') }}", function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                  $("#update_component_issued_to_" + selectlength).append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                
                  $('#update_component_issued_to_'+ selectlength).select2({
                    theme: "classic", 
                    dropdownParent: "#editEquipment",
                    closeOnSelect: true,
                    width: '200px',
                  });

              var ctr = 0;

              $(document).on("change", "#update_component_issued_to_" + 1 + "", function() {
                ctr++;
                $.getJSON("{{ url('get/users') }}/" + this.value, function(datajson) {

                }).done(function(datajson) {

                  // console.log(ctr);
                  //LOAD JSON CLASS
                  jQuery.each(datajson, function(i, obj) {

                    // $("#set_id_get_"+ctr).val(obj.username);
                    $("#transferred_" + ctr).val(obj.username);

                  });

                }).fail(function() {
                  alert(Error);
                });
              });
              //DELEGATE ON CHANGE 
            });
          });

        });
      }).fail(function() {
        alert(Error);
      });

    }).done(function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        var issued_date = moment(obj.date_ics).format('LL');
        var received_date = moment(obj.date_acquired).format('LL');
        $('#update-issued-by-date').html(issued_date);
        $('#update-received-by-date').html(received_date);
        $("#update_equipment_id").val(obj.id);
        $("#update_set_id").val(obj.id);
        $("#update_prop_umeasure").val(obj.ics_umeasure).change();
        $("#update_property_number").val(obj.property_number);
        $("#update_categoryHidden").val(obj.component_classification);
        $("#update_subcategoryHidden").val(obj.component_subclass);
        $("#update_category").text(obj.component_classification);
        $("#update_ics_category").val(obj.ics_category);
        $("#update_prop_subcat").val(obj.subclass_id);
        $("#update_prop_desc").val(obj.component_name);
        $("#update_serial_num").val(obj.serial_num);
        $("#update_division").val(obj.division);
        $("#update_fullname").val(obj.fullname);
        $("#update_position").val(obj.position);
        $("#update_prop_quantity").val(obj.quantity);
        $("#update_subprop_num").val(obj.component_subpropertynumber);
        $("#update_fund_cluster").val(obj.fund_cluster);
        $("#update_ics_number").val(obj.ics_number);
        $("#update_location").val(obj.location);
        $("#update_ics_type").val(obj.ics_type);
        $("#update_date_acquired").val(obj.date_acquired);
        $("#update_date_ics").val(obj.date_ics);
        $("#update_prop_num_1").val(obj.property_number);
        $("#update_prop_total_val_1").val(obj.value);
        $("#update_amount").val(obj.amount);
        $("#update_propassign_form_text").text(obj.issued_to);
        $("#update_propassign_form").val(obj.issued_to);
        $("#update_select_division").val(obj.division).change();
        $("#update_select_staff").append("<option value='" + obj.employee_code + "' selected>" + obj.fullname + "</option>");
        $("#update_employee_division").html(obj.division);
        $("#update_employee_position").html(obj.position);
        $("#update_remarks_from").val(obj.remarks_from);
        $("#update_remarks_sales").val(obj.remarks_sales);
        $("#update_remarks_sales_date").val(obj.remarks_sales_date);
        $("#update_remarks_po_num").val(obj.remarks_po_num);
        $("#update_remarks_po_date").val(obj.remarks_po_date);
        $("#update_remarks_pr_num").val(obj.remarks_pr_num);
        $("#update_remarks_pr_date").val(obj.remarks_pr_date);
        $("#update_remarks_charged").val(obj.remarks_charged);
        $('#update-issued-by-date').html(moment(obj.date_ics).format('LL'));
        $('#update-received-by-date').html(moment(obj.date_acquired).format('LL'));
      });
    }).fail(function() {
      alert("Error loading data! Page reloading, please wait...")
      location.reload();
    });

    $("#editEquipment").modal("toggle");

  }

  function transferEquipment(id) {
    $.getJSON("{{ url('get/icscomponents') }}/" + id, function(datajson) {

    }).done(function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#transfer_equipment_id").val(obj.id);

      });
    }).fail(function() {
      alert("Error loading data! Page reloading, please wait...")
      location.reload();
    });

    $("#transferEquipment").modal("toggle");
  }

  
  function transferReport(id) {
    $.getJSON("{{ url('get/icscomponents') }}/" + id, function(datajson) {

    }).done(function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#transfer_report_id").val(obj.id);

      });
    }).fail(function() {
      alert("Error loading data! Page reloading, please wait...")
      location.reload();
    });

    $("#transferReport").modal("toggle");

  }

  function acceptEquipment(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "The status of the item will be changed to accepted.",
      icon: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, accept the equipment.'
    }).then((result) => {
      if (result.value) {
        window.location.href = "{{ url('ics/accept-ics') }}/" + id;
      }
    })
  }

  function revertEquipment(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Revert the status of the item.",
      icon: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, revert the status.'
    }).then((result) => {
      if (result.value) {
        window.location.href = "{{ url('revert-ics') }}/" + id;
      }
    })
  }

  function disposeEquipment(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Dispose the equipment.",
      icon: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, dispose the equipment.'
    }).then((result) => {
      if (result.value) {
        //CODE IF CONFIRMED
        $.getJSON("{{ url('get/icscomponents') }}/" + id, function(datajson) {

        }).done(function(datajson) {
          jQuery.each(datajson, function(i, obj) {
            $("#dispose_equipment_id").val(obj.id);
            $("#dispose_fullname").val(obj.issued_to);
          });
        }).fail(function() {
          alert("Error loading data! Page reloading, please wait...")
          location.reload();
        });

        $("#disposeEquipment").modal("toggle");

        //CODE IFCONFIRMED
      }
    })
  }

  function deleteReport(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete the record.'
    }).then((result) => {
      if (result.value) {
        window.location.href = "{{ url('delete/dppmp') }}/" + id;
      }
    })
  }

  function viewHistory(set_id) {
          var historyDataTable = $('#history-datatable').DataTable({
              "processing": true,
              "serverSide": false,
              "searching": false,
              "destroy": true,
              "bInfo": false,
              "paging": false,
              "ajax": {
                "type": "GET",
                "url": "{{ url('get/view_history') }}" + "/" + set_id
              },
              "columns": [
                {
                  "data": null
                },
                {
                  "data": "staff"
                },
                {
                  "data": "division"
                },
                {
                  "data": "action"
                },
                {
                  "data": "created_at",  render: function(d){
                   return moment(d).format('LLL')
                }
                },
              ],
              "createdRow": function(row, data, dataIndex) {
                $(row).attr('data-id', data.id)
              }
            });

            //COUNTER
            historyDataTable.on('order.dt search.dt', function() {
              historyDataTable.column(0, {
                search: 'applied',
                order: 'applied'
              }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
              });
            }).draw();
            //COUNTER
    $("#viewHistory").modal("toggle");
  }

  function generateICS(set_id) {
    window.open("{{ url('pdf/ics') }}/" + set_id);
  }

  function generateSemiExpendablePropertyCard(set_id) {
    window.open("{{ url('pdf/semiexpendablecard') }}/" + set_id);
  }

  function generateLedgerCard(set_id) {
    $("#generateLedgerCard").modal("toggle");
    var today = moment().format('YYYY-MM-DD');
    $.getJSON("{{ url('get/viewicscomponents-components/') }}/" + set_id, function(datajson) {
  }).done(function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#generate_ledgercard_id").val(obj.id);
        $("#ledger_classification").val(obj.component_classification);
        $("#ledger_fundcluster").val(obj.fund_cluster);
        $("#ledger_property_number").val(obj.property_number);
        $("#ledger_description").val(obj.component_name);
        $("#ledger_unit_cost").val(obj.unit_cost);
        $("#ledger_total_cost").val(obj.unit_cost);
        $("#ledger_quantity").val(obj.quantity);
        $("#ledger_uacs_code").val(obj.ledger_uacs_code);
        $("#ledger_date").val(obj.ledger_date);
        $("#ledger_reference").val(obj.ledger_reference);
        $("#ledger_issues_transfer_adjustments").val(obj.ledger_issues_transfer_adjustments);
        $("#ledger_accumulated_impairment_losses").val(obj.ledger_accumulated_impairment_losses);
        $("#ledger_adjusted_cost").val(obj.ledger_adjusted_cost);
        $("#ledger_nature_of_repair").val(obj.ledger_nature_of_repair);
        $("#ledger_amount").val(obj.ledger_amount);
      });
    }).fail(function() {
      alert("Error loading data! Page reloading, please wait...")
      location.reload();
    });
    // window.open("{{ url('pdf/ledgercard/') }}/" + set_id);
  }

  function filterICS() {
  var division = $('#filter_division').val();
  var table = $('#dppmp-data-table').DataTable();
  table.destroy();

  var table = $('#dppmp-data-table').DataTable({
      "processing": true,
      "serverSide": false,
      "paging": true,
      "ajax": {
        "type": "GET",
        "url": "{{ url('filter/ics') }}" + "/" + division
      },
      "columns": [{
          "data": "id"
        },
        {
          "data": "division"
        },
        {
          "data": "remarks_charged"
        },
        {
          "data": "ics_number"
        },
        {
          "data": "property_number"
        },
       
        {
          "data": "remarks_from"
        },
        {
          "data": "status_html"
        },
        {
          "data": "date_acquired"
        },

        {
          "data": null,
          "defaultContent": "<div class='uk-inline'> <button style='border-radius:4px;' class='uk-button uk-button-primary' type='button'><i class='menu-icon fa fa-caret-down'></i> Action</button> <div uk-dropdown='mode: click'> <ul class='uk-nav uk-dropdown-nav'  style='height:200px; overflow-x: scroll; overflow-x:hidden;'> <li> <a href='#' class='row-edit-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-edit'></i> Edit Supply</div></a> </li><li> <a href='#' class='row-accept-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-check-square'></i> Accept Supply </div></a> </li><li> <a href='#' class='row-revert-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-undo'></i> Revert Supply </div></a> </li><li> <a href='#' class='row-dispose-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-trash'></i> Delete Plan </div></a> </li><li> <a href='#' class='row-transfer-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-exchange'></i> Transfer Supply </div></a></li><li><a href='#' class='row-view-history'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-book'></i> View History </div></a></li><li><a href='#' class='row-generate-semiexpendable-card'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-clipboard'></i> Generate Card </div></a></li><li><a href='#' class='row-generate-ics'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-clipboard'></i> Generate ICS </div></a></li><li><a href='#' class='row-delete-ics'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-times'></i> Delete ICS </div></a></li></ul> </div></div>"
        }
      ],
      "columnDefs": [{
        "targets": 4,
        "render": function(data, type, row) {
          if (data != "" && data != null && data.length > 150) {
            return `<p>${data.substring(0, 150)}...<a href='#' class='text-primary display-ppe-details'><u> See more</u> <a/></p>`
          }
          return data;
        }
      }],
      "createdRow": function(row, data, dataIndex) {
        $(row).attr('data-id', data.id)
      }
    });

    //COUNTER
    table.on('order.dt search.dt', function() {
      table.column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();
    //COUNTER  

  }

  function saveLedgerCard() 
  {
    $("form#generateLedgerCard").submit();
    $("#generateLedgerCard").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "generate-ledgercard",
            type: "POST",
            success: function (result) {
                console.log(result)
            }
        });
    })
  }

  function printLedgerCard() 
  {
    var set_id = $("#generate_ledgercard_id").val();
    window.open("{{ url('pdf/ledgercard/') }}/" + set_id);
  }

  function generateDPPMP(){
    var division  = $("#dppmp_division").val();  
    var charging  = $("#dppmp_charging").val();  
    window.open("{{ url('report/generateDPPMP') }}/" +division+"/"+charging);
  }


</script>

@endsection
