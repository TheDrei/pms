@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('sweetalert2/src/sweetalert2.scss') }}">
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

    .spinner {
    opacity: 100%;  
    width: 100px;  
    position: fixed;
    z-index: 1;
    top: 40%;
    left: 50%;
    margin-left: -2em;
    }

    .custom {
        height: 90vh;
        overflow-y: auto;
    }
</style>
@endsection
@section('content-title')
INVENTORY - Property, Plant, and Equipment (PPE)
@endsection
@section('content')

<!-- START ADD NEW EQUIPMENT MODAL  -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="width:1500px; padding-right:1100px; padding-left: 300px;">
        <div class="modal-content custom" style="width:900px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModal">Add New Equipment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <div class="modal-body">
               <form method="POST" action="{{ url('save-equipment') }}" enctype="multipart/form-data">
                        @csrf
                        @include('form-view/par-view')
                        <div class="modal-footer" style="width:100%;  position: sticky;">
                            <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END ADD EQUIPMENT MODAL -->

<!-- START UPDATE EQUIPMENT MODAL  -->
<div class="modal fade" id="editEquipment" tabindex="-1" role="dialog" aria-labelledby="editEquipment" aria-hidden="true">
<div class="modal-dialog modal-md" role="document" style="width:1500px; padding-right:1100px; padding-left: 300px;">
<div class="modal-content custom" style="width:900px; overflow-x:hidden;">
                <div class="modal-header">
                <h5 class="modal-title">Update Equipment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <div class="modal-body">
                     <form method="POST" action="{{ url('update-equipment') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_equipment_id" id="update_equipment_id" value="">
                            <input type="hidden" name="update_set_id" id="update_set_id" value="">
                   
                            @include('form-view/par-view-edit')
                            <div class="modal-footer" style="width:100%;  position: sticky;">
                                <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                    </form>
              </div>
        </div>
    </div>
</div>
<!-- END UPDATE EQUIPMENT MODAL -->


<!-- START TRANSFER -->
<div class="modal fade" id="transferEquipment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top: 10px;">
            <div class="modal-header">
                <h5 class="modal-title">
                    Transfer Equipment</h4>
            </div>
            <form method="POST" action="{{ url('transfer-equipment') }}" enctype="multipart/form-data">
                @csrf <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
                <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
                <input type="hidden" name="transfer_division" id="transfer_division" value="">
                <input type="hidden" name="transfer_position" id="transfer_position" value="">

                <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card">
                            <br />
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
                                        <option value="" selected>Select a Staff</option>
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    </div>
                </div>
                <br>
                <p align="right" style="padding-right:300px;">
                    <button style="border-radius:4px;" type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Transfer</button>
                    <a style="border-radius:4px;" href="" data-dismiss="modal" class="btn btn-secondary btn-md">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>
<!-- END TRANSFER -->

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
                                    <th>STAFF</th>
                                    <th>DIVISION</th>
                                    <th>ACTION</th>
                                    <th>DATE/TIME CREATED</th>                              
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

<!-- START DISPOSAL -->
<div class="modal fade" id="disposeEquipment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top: 10px;">
            <div class="modal-header">
                <h5 class="modal-title">
                    Dispose Equipment</h4>
            </div>
            <form id="disposeEquipmentForm" method="POST" action="{{ url('dispose-equipment') }}" enctype="multipart/form-data">
                @csrf <input type="hidden" name="dispose_equipment_id" id="dispose_equipment_id" value="">
                <input type="hidden" name="dispose_fullname" id="dispose_fullname" value="">
                <input type="hidden" name="dispose_division" id="dispose_division" value="">
         
                <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card">
                            <br />
                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Remarks</label></div>
                                <div class="col-12 col-md-6">
                                    <textarea class="form-control" name='dispose_remarks' id="dispose_remarks" required></textarea>
                                </div>
                            </div>
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
                <br>
                <p align="right" style="padding-right:300px;">
                    <button style="border-radius:4px;" type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Dispose</button>
                    <a style="border-radius:4px;" href="" data-dismiss="modal" class="btn btn-danger btn-md">Cancel</a>
                </p>
            </form>
        </div>
    </div>
</div>
<!-- END DISPOSAL -->

<!-- START PPE DETAILS -->
<div class="modal fade" id="ppe_details_modal" tabindex="-1" role="dialog" aria-labelledby="ppe_details_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ppe_details_title">PPE Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="ppe-details">

                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END PPE DETAILS -->

<p align="left"><button id="equipmentButton" type="button" style="border-radius: 4px" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Add Equipment</button></p>

<div class="card-body">
    <table id="bootstrap-data-table" class="table table-striped table-hover" style="background-color:#FFF;width: 100%;">
        <thead class="thead-light">
            <tr>
                <th style="width: 2%">#</th>
                <th>DIVISION</th>
                <th style="width: 20%">ITEM DESCRIPTION</th>
                <th>PAR NO.</th>
                <th>PURCHASED FROM</th>
                <th>ISSUED TO</th>
                <th>QTY</th>
                <th>SERIAL NUMBER</th>
                <th>STATUS</th>
                <th>DATE ACQUIRED</th>
                <th width="10%">ACTION</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br/>
</div>
@endsection

@section('addJS')
@if(session('message'))
<script type="text/javascript">
Swal.fire({
    title: "Success",
    text: "PPE Supply Successfully Saved!",
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
    text: "PPE Supply Successfully Updated!",
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
    text: "PPE Successfully Transferred!",
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
    text: "PPE Supply Successfully Disposed!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-accepted'))
<script type="text/javascript">
 
Swal.fire({
    title: "Success",
    text: "PPE Supply Successfully Accepted!",
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
    text: "PPE Supply Successfully Deleted!",
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
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>

<script type="text/javascript">
    var subcattext = $("option:selected", "#prop_subcat").text();
    var initial_staff = 0;
    var initial_components = 0;
    var initial_tab = 0;
    var propassign_formvar = $("#propassign_form_1").val();
    var prop_umeasure = $('#prop_umeasure').val();
    $(document).ready(function() {

    $("#date_par").change(function() {
      var date_ics = moment(this.value).format('LL');
      $('#issued-by-date').html(date_ics);
    });

    $( "#date_acquired" ).change(function() {
      var date_acquired = moment(this.value).format('LL');
      $('#received-by-date').html(date_acquired);
    });

    $("#update_date_par").change(function() {
      var date_ics = moment(this.value).format('LL');
      $('#update-issued-by-date').html(date_ics);
    });

    $( "#update_date_acquired" ).change(function() {
      var date_acquired = moment(this.value).format('LL');
      $('#update-received-by-date').html(date_acquired);
    });

        $('#par_number_check').change(function() {
            var ischecked= $(this).is(':checked');
            $('#par_number').val('No PAR No. Data');
            if(!ischecked)
            $('#par_number').val('');
        });

        $('#fund_cluster_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#fund_cluster").append("<option selected value='No Fund Cluster Data'>No Fund Cluster Data</option>");
            if(!ischecked)
            $("#fund_cluster option[value='No Fund Cluster Data']").each(function() {
                    $(this).remove();
                })
        });

        $('#date_par_check').change(function() {
            var ischecked= $(this).is(':checked');
            $("#date_par").val('');
            $('#date_par').removeAttr('required');
            if(!ischecked)
            $("#date_par").prop('required',true);
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


        $('#ppe_type').select2({
        dropdownParent: "#largeModal",
        closeOnSelect: true,
        theme: "classic",
        width: '100%',
        });

        $('#update_ppe_type').select2({
        dropdownParent: "#editEquipment",
        closeOnSelect: true,
        theme: "classic",
        width: '100%',
        });

        $('#propassign_form_1').select2({
            dropdownParent: "#largeModal",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
        });
        $('#transfer_propassign_form').select2({
            dropdownParent: "#transferEquipment",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
        });
        $('#select_division').select2({
            dropdownParent: "#largeModal",
            theme: 'classic',
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

        $('#division').select2({
            dropdownParent: "#largeModal",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
        });
        $('#transfer_select_division').select2({
            dropdownParent: "#transferEquipment",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
        });

        $.getJSON("{{ route('ppe-getprevious-id') }}", function(datajson) {
                var current_date = new Date();
                var type = "P"; 
                var current_month=('0'+(current_date.getMonth()+1)).slice(-2)
                var current_year  = new Date().getFullYear();
                var previous_id = datajson.previous_id+1;
                $("#par_number").val(type+'-'+current_year+'-'+current_month+'-'+previous_id);
         });

        $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
            });
         });

         
        $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#update_fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
            });
         });
        
        $.getJSON("{{ url('json/ppe-type/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#ppe_type").append("<option value='" + obj.type + "'>" + obj.type + "</option>");
            });
         });

        $.getJSON("{{ url('json/ppe-type/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#update_ppe_type").append("<option value='" + obj.type + "'>" + obj.type + "</option>");
            });

            });
        //FILTER DIVISION ON ISSUED TO DROP-DOWN
        $("#select_division").on('change', function() {
            $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {
                $("#propassign_form_1").empty();
                jQuery.each(datajson, function(i, obj) {
                    $("#propassign_form_1").append("<option value=''>Select a Staff</option>");
                    $("#propassign_form_1").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                });
              
            });
        });
        //FILTER DIVISION ON ISSUED TO DROP-DOWN

        // Display Position on Change
        $("#propassign_form_1").on('change', function() {
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
                });
            });
        });

        // Done Display Position.

        $("#update_select_division").on('change', function() {
            $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {
                // $("#update_select_staff").empty();
                jQuery.each(datajson, function(i, obj) {
                    $("#update_select_staff").append("<option value=''>Select a Staff</option>");
                    $("#update_select_staff").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                });
              
            });
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
        $("#propassign_form_1").on('change', function() {
            var staffname = $("#propassign_form_1 option:selected").text();
            $("#getstaffemployeecode").val(this.value);
            $("#getstaffname").val(staffname);
        });

        //Division Drop-Down
        $.getJSON("{{ url('json/division/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
                $("#transfer_select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
                $("#update_select_division").append("<option value='"+obj.division_acro+"'>"+obj.division_acro+"</option>");
            });
        });
        //DELETE ROW in the DataTable
        window.deleteRow = function(id) {
            var table = $('#bootstrap-data-table').DataTable();
            $('#bootstrap-data-table tbody').on('click', 'deleterow', function() {
                table.row($(this).parents('tr')).remove().draw();
            });
        }
        //START INDIVIDUAL COMPONENT CLASSIFICATION
        var ctr = 0;
        $('#addComponents').click(function() {
            ctr += 1;
            // console.log(ctr);
            //ADD CLASS
            window.getClass = function(id) {
                var subcattext = $("option:selected", "#equip_subcat_1").text();
                $.getJSON("{{ url('get/categories') }}/" + id, function(datajson) {}).done(function(datajson) {
                    //LOAD JSON CLASS
                    jQuery.each(datajson, function(i, obj) {
                        $("#category").text(obj.type);
                        $("#category_" + ctr).val(obj.type);
                        $("#getSubcategory_" + ctr).val(obj.sub_type);
                        $("#categoryHidden").val(obj.type);
                        $("#subcategoryHidden").val(subcattext);
                    });
                }).fail(function() {
                    alert(Error);
                });
                //END LOAD JSON SUB-CLASS
            }
        });
        //ADD CLASS
        //END INDIVIDUAL COMPONENT CLASSIFICATION
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
            var propassign_formvar = $("#propassign_form_1").val();
            var totalval = $("#prop_total_val").val();
            $("#prop_component").val(totalval);
            var prop_subcat = $("#prop_subcat").val();
            var proctr = 1 + ($(".prop_component_ctr").length);
            var proassignctr = 1 + ($(".prop_assign_ctr").length);
            console.log(proctr);
            //END GET PROPERTY NUMBER WITH INCREMENTAL ID
            //CHECK EMPTY FIELDS
            if ($('#propassign_form_1').val() != '') {
                var propassign_formvar = $("#propassign_form_1 option:selected").text();
            }

            $("#property-table tr:last").after("<tr class='solid-borders'><td class='solid-borders'><select onchange='getClass(this.value)' style='font-size:12px; width:300px;' name='equip_subcat[]' id='equip_subcat_" + proctr + "' class='form-control prop_assign_ctr' required><option value='' selected>Select a Sub-Category</option></select></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equipment_category[]' id='equipment_category_" + proctr + "' required></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_" + proctr + "' required></textarea></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_" + proctr + "'></td><td class='solid-borders'><input style='font-size:12px; width:50px;' type='text' class='form-control' name='equip_subprop_num[]' value='" + proctr + "'></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + proctr + "' value='' required></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='number' class='form-control' name='estimated_useful_life[]' id='estimated_useful_life_" + proctr + "' value=''></td><td class='solid-borders'><input style='font-size:12px; width:200px;' step='any' type='number' class='form-control unit-cost' name='equip_unit_cost[]' id='equip_unit_cost_" + proctr + "' value='' required></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;' step='any' type='text' class='form-control' name='remarks[]' id='remarks_" + proctr + "' value=''></textarea></td><td class='solid-borders'>" + del_btn + "</td></tr>");


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
                theme: 'classic',
                dropdownParent: "#property-table",
                closeOnSelect: true,
                width: '280px',
            });

            //DELEGATE ON CHANGE 
            var ctr = 0;
            $(document).on("change", "#equip_subcat_" + proctr + "", function() {
                $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
                    //LOAD JSON CLASS
                    jQuery.each(datajson, function(i, obj) {
                        $("#category").text(obj.type);
                        $("#equipment_category_" + proctr +"").val(obj.type);
                        $("#estimated_useful_life_" + proctr +"").val(obj.estimated_useful_life);
                        $("#getSubcategory_" + proctr + "").val(obj.sub_type);
                        $("#categoryHidden").val(obj.type);
                        $("#subcategoryHidden").val(subcattext);
                    });
                }).fail(function() {
                    alert(Error);
                });
            });
            //DELEGATE ON CHANGE 


            $("#tbl_components_" + id + " tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control prop_assign_ctr'>");

            $("#property-table tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control prop_assign_ctr'>");
        
            $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                    $("#equip_subcat_" + proctr).append("<option value='" + obj.id + "'>" + obj.sub_type + "</option>");
                });
            });


        }

    // PROPERTY NUMBER Add and Remove Script
        //Add Property Number
        var ctrPropNumber = 0;
        $('#addPropertyNumber').click(function() {
            ctrPropNumber += 1;
            $(".property_numbers").append("<section> <div class='font-weight-bold'>Property No. <a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delPropertyNumber(this)'><i class='fa fa-close'></i></a></div><div style='width:300px;'><input class='property_number form-control' placeholder='Property No.' name='property_number_array[]' id='property_number_array_"+ctrPropNumber+"' required></div></section>");
        });

        $('#editAddPropertyNumber').click(function() {
            ctrPropNumber += 1;
            $(".update_property_numbers").append("<section> <div class='font-weight-bold'>Property No. <a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delPropertyNumber(this)'><i class='fa fa-close'></i></a></div><div style='width:300px;'><input class='property_number form-control' placeholder='Property No.' name='update_property_number_array[]' id='update_property_number_array_"+ctrPropNumber+"' required></div></section>");
        });

         //Delete Property Number
         window.delPropertyNumber = function(id) {
           $(id).closest("section").remove();
           ctrPropNumber -= 1;
        }

        //Edit - Delete Property Number
             window.editdelPropertyNumber = function(id) {
           $(id).closest("section").remove();
           ctrPropNumber -= 1;
        }
     //END PROPERTY NUMBER CRUD 

        //GET DIVISION
        window.getDivision = function(empcode) {
            $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
                //LOAD JSON CLASS
                jQuery.each(datajson, function(i, obj) {
                    $("#fullname").val(obj.fullname);
                    $("#division").val(obj.division_acro);
                    $("#position").val(obj.position_desc_current);
                    $("#update_fullname").val(obj.fullname);
                    $("#update_division").val(obj.division_acro);
                    $("#update_position").val(obj.position_desc_current);
                    $("#transfer_fullname").val(obj.fullname);
                    $("#transfer_division").val(obj.division_acro);
                    $("#transfer_position").val(obj.position_desc_current);
                });
            }).fail(function() {
                alert(Error);
            });
            //END LOAD JSON SUB-CLASS
        }

        //GET DIVISION2
        window.getDivision2 = function(empcode) {
            // var getemp = empcode;
            $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
                //LOAD JSON CLASS
                jQuery.each(datajson, function(i, obj) {
                    $("#division").val(obj.division_acro);
                    $("#position").val(obj.position_desc_current);
                    $("#fullname").val(obj.fullname);
                    $("#update_position").val(obj.position_desc_current);
                    $("#update_employee_position").html(obj.position_desc_current);
                    $("#update_fullname").val(obj.fullname);
                    $("#update_division").val(obj.division_acro);
                    $("#transfer_fullname").val(obj.fullname);
                    $("#transfer_division").val(obj.division_acro);
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
            //Drei
            var propassign_formvar = $("#propassign_form_1").val();
            $("#nav-tab").empty().append('<a class="replace-tab-text nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#sub-item-1" role="tab" aria-controls="nav-home" aria-selected="false">Set 1</a>');
            $("#nav-tabContent").append('<div class="tab-pane fade show" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab"><div class="card"><div class="card-body"><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div><div class="col-12 col-md-6"><input type="text" name="prop_num[]" id="prop_num_1" class="form-control propassignformctr" value="" required></div></div><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div><div class="col-12 col-md-6"><input type="text" name="prop_total_val[]" id="prop_total_val_1" class="form-control" value="" required></div></div><div class="row form-group"><div class="col-12 col-md-2 "><label for="text-input" class="form-control-label">Issued To</label></div><div class="col-12 col-md-6"><select name="propassign_form[]" id="propassign_form_1" data-placeholder="Select a Staff" class="form-control propassign_ctr" required><option value="' + propassign_formvar + '" selected>' + propassign_formvar + '</option></select></div></div><div class="hide-label"><h7>Add Components <a href="#" class="btn btn-primary btn-sm" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br/><br/><table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px"><thead><th style="width:20%">Component Name</th><th style="width:50%">Serial No.</th><th style="width:2%">Date Issued</th><th style="width:100%">Issued To</th><th style="width:2%"></th></thead></table></div></div></div>');
            // hideElements(); 
        }

        var t = $('#bootstrap-data-table').DataTable({
            "processing": true,
            // "serverSide": false,
            "filter": true,
            "lengthMenu": [ [10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "All"] ],
            "order": [ [0, 'asc'] ],
            "iDisplayLength": 10,
            "ordering": true,
            "select": true,
            "responsive": false,
            "stateSave": true,
            "search": {
            "return": true,
             },
            "paging": true,
            "data": {
				'_token': '{{ csrf_token() }}'
			},
            "ajax": {
                "url": "{{ url('json/componentsmain/all') }}",
                "method": "GET"
              },
            "columns": [
                {
                "data": "id",
                },
                {
                    "data": "division"
                },
                {
                    "data": "component_name"
                },
                {
                   
                    "data": "par_number"                
                },

                { 
                    "data": "remarks_from"
                },
                { 
                    "data": "fullname"
                },
               
                {
                    "data": "quantity"
                },
                {
                    "data": "serial_num"
                },
            
                { "data" : "status_html" },
                {
                    "data": "date_acquired"
                },
                {
                    "data": null,
                    "defaultContent": "<div class='uk-inline'> <button style='border-radius:4px;' class='uk-button uk-button-primary' type='button'><i class='menu-icon fa fa-caret-down'></i> Action</button> <div uk-dropdown='mode: click'> <ul class='uk-nav uk-dropdown-nav'  style='height:200px; overflow-x: scroll; overflow-x:hidden;'> <li> <a href='#' class='row-edit-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-edit'></i> Edit Equipment</div></a> </li><li> <a href='#' class='row-accept-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-check-square'></i> Accept Equipment </div></a> </li><li> <a href='#' class='row-revert-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-undo'></i> Revert Status </div></a> </li><li> <a href='#' class='row-dispose-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-trash'></i> Dispose Equipment </div></a> </li><li> <a href='#' class='row-transfer-equipment'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-exchange'></i> Transfer Equipment </div></a> </li><li><a href='#' class='row-view-history'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-book'></i> View History </div></a> </li><li><a href='#' class='row-generate-card'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-clipboard'></i> Generate Card </div></a></li><li><a href='#' class='row-generate-par'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-clipboard'></i> Generate PAR </div></a></li><li><a href='#' class='row-delete-ppe'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-times'></i> Delete PPE </div></a></li></ul> </div></div>"
                }
            ],
            "language": {
                search: ''
            },
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
          t.on('order.dt search.dt', function() {
                    t.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                    }).draw();
                //COUNTER

        $('#bootstrap-data-table').on('click', '.row-edit-equipment', function(e) {
            let varID = getRowID(e.target);
            editEquipmentdetails(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-accept-equipment', function(e) {
            let varID = getRowID(e.target);
            acceptEquipment(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-revert-equipment', function(e) {
            let varID = getRowID(e.target);
            revertEquipment(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-dispose-equipment', function(e) {
            let varID = getRowID(e.target);
            disposeEquipment(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-transfer-equipment', function(e) {
            let varID = getRowID(e.target);
            transferEquipment(varID);
        });

        $('#bootstrap-data-table').on('click', '.row-view-history', function(e) {
           let varID = getRowID(e.target);
                $.getJSON("{{ url('get/parcomponents-components') }}/" + varID, function(datajson) {
                viewHistory(datajson[0].set_id);
                }).done(function(datajson) {
                })
        });

        $('#bootstrap-data-table').on('click', '.row-generate-par', function(e) {
            let varID = getRowID(e.target);
            generatePAR(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-generate-card', function(e) {
            let varID = getRowID(e.target);
            generatePropertyCard(varID);

        });

        $('#bootstrap-data-table').on('click', '.row-delete-ppe', function(e) {
            let varID = getRowID(e.target);
            deletePPE(varID);

        });

        //TODO
        //See more displays full PPE details
        $('#bootstrap-data-table').on('click', '.display-ppe-details', function(e) {
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
         var selectlength = ($(".selectlength").length);
  
         window.updategetClass = function(id) {
            var subcattext = $("option:selected", "#update_prop_subcat").text();
            $.getJSON("{{ url('json/showcategory') }}/" + id, function(datajson) {}).done(function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                    $("#update_category").text(obj.class_description);
                    $("#update_subcategoryHidden").val(subcattext);
                    $("#update_categoryHidden").val(obj.type);
                });
            }).fail(function() {
                alert(Error);
            });
         };

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


        $.getJSON("{{ url('get/components') }}/" + id, function(datajson) {

            var del_btn = "";
            var proctr = 1 + ($(".selectlength").length);

            if (id != 0) {
                var proctr = 0;
                del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
                proctr -= 1;
            }

            $.getJSON("{{ url('get/viewppecomponents-components') }}/" + datajson[0].id, function(datajson) {

            }).done(function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                    var selectlength = ($(".selectlength").length);
                    $("#edit-property-table tr:last").after("<tr class='solid-borders'><td class='solid-borders'><select onchange='updategetClass(this.value)'  style='font-size:12px; width: 200px;' name='update_comp_equip_subcat[]' id='update_comp_equip_subcat_" + i + "' class='form-control prop_assign_ctr' ><option value='" + obj.component_subclass + "' selected>" + obj.component_subclass + "</option></select></td><td class='solid-borders'><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_comp_prop_class[]' id='update_comp_prop_class_" + i + "' value='" + obj.classification + "'></td><td class='solid-borders'><textarea style='font-size:12px; overflow:auto; height:100px;width:320px; word-wrap: break-word;' type='text' class='form-control prop_component_ctr' name='update_comp_prop_component[" + i + "]' id='update_comp_prop_component_" + i + "' value='" + obj.component_name + "'>" + obj.component_name + "</textarea></td><td class='solid-borders'><input style='font-size:12px; width: 200px;' type='number' class='form-control' value='" + obj.quantity + "' name='update_component_quantity[]' id='update_component_quantity_" + i + "'></td><td class='solid-borders'><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_subproperty_number[]' id='update_subproperty_number_" + i + "' value='" + obj.component_subpropertynumber + "'></td>	<td class='solid-borders'><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + i + "' value='" + obj.serial_num + "'></td><td class='solid-borders'><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_estimated_useful_life[]' id='update_estimated_useful_life_" + i + "' value='" + obj.estimated_useful_life + "'></td><td class='solid-borders selectlength'><select name='update_component_issued_to[" + i + "]' id='update_component_issued_to_" + i + "' onchange='getDivision2(this.value)' data-placeholder='Select a Staff' class='form-control'><option value='" + obj.issued_to + "' selected>" + obj.fullname + "</option></select></td><td class='solid-borders'><input style='font-size:12px; width:200px;' type='number' step='any' class='form-control update-unit-cost' name='update_equip_unit_cost[]' id='update_equip_unit_cost_" + proctr + "' value='" + obj.amount + "' required></td><td class='solid-borders'><textarea style='font-size:12px; width:200px;'class='form-control' name='update_remarks[]' id='update_remarks_" + proctr + "'  value='" + obj.remarks + "'>" + obj.remarks + "</textarea></td><td class='solid-borders'><input type='hidden' name='update_comp_equip_subcat_get[]' id='update_comp_equip_subcat_get_" + i + "' value='" + obj.component_subclass + "'  class='item-details'><input type='hidden' name='update_comp_icsnumber[]' id='update_comp_icsnumber_" + i + "' value='" + obj.component_subclass + "'  class='item-details'><input type='hidden' name='update_comp_division[]' id='update_comp_division_" + i + "' value='" + obj.division + "'  class='update-employee-details'><input type='hidden' name='update_comp_employeecode[]' id='update_comp_employeecode_" + i + "' value='" + obj.employee_code + "'  class='update-employee-details'><input type='hidden' name='update_comp_position[]' id='update_comp_position_" + i + "' value='" + obj.position + "'  class='update-employee-details'><input type='hidden' name='trigger_set_id_change[]' id='trigger_set_id_change_" + i + "' value='" + obj.set_id + "'  class='update-employee-details'>");

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
                            width: '280px',
                        });


                        $('#update_component_issued_to_'+ i).select2({
                            theme: "classic", 
                            dropdownParent: "#editEquipment",
                            closeOnSelect: true,
                            width: '230px',
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


                    $.getJSON("{{ url('json/users/all') }}", function(datajson) {
                    
                        jQuery.each(datajson, function(i, obj) {
                        $("#update_component_issued_to_" + selectlength)
                        .append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                            // $("#update_component_issued_to_" + selectlength).select2();

                            //DELEGATE ON CHANGE 
                            var ctr = 0;

                            $(document).on("change", "#update_component_issued_to_" + 1 + "", function() {
                                ctr++;
                                $.getJSON("{{ url('get/users') }}/" + this.value, function(datajson) {

                                }).done(function(datajson) {
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
                $("#update_equipment_id").val(obj.id);
                $("#update_set_id").val(obj.id);
                $("#update_prop_umeasure").val(obj.component_umeasure);
                $("#update_select_staff").append("<option value='" + obj.issued_to + "' selected>" + obj.fullname + "</option>");
                $("#update_employee_division").html(obj.division);
                $("#update_employee_position").html(obj.position);
                // $("#update_select_staff").val(obj.issued_to);
                $("#update_ppe_type").val(obj.ppe_type).change();
                $("#update_categoryHidden").val(obj.component_classification);
                $("#update_subcategoryHidden").val(obj.component_subclass);
                $("#update_category").text(obj.component_classification);
                $("#update_prop_subcat").val(obj.subclass_id);
                $("#update_par_number").val(obj.par_number);
                $("#update_prop_desc").val(obj.component_name);
                $("#update_serial_num").val(obj.serial_num);
                $("#update_division").val(obj.division);
                $("#update_position").val(obj.position);
                $("#update_fullname").val(obj.fullname);
                $("#update_prop_quantity").val(obj.quantity);
                $("#update_subprop_num").val(obj.component_subpropertynumber);
                $("#update_fund_cluster").val(obj.fund_cluster);
                $("#update_date_par").val(obj.date_par);
                $("#update_date_acquired").val(obj.date_acquired);
                $("#update_property_number").val(obj.property_number);
               
                if((typeof(obj.property_number_1) != "undefined" && obj.property_number_1 !== null) && (typeof(obj.property_number_2) != "undefined" && obj.property_number_2 !==null)) {
                    $(".update_property_numbers").append("<section><div class='font-weight-bold'>Property No. <a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='editdelPropertyNumber(this)'><i class='fa fa-close'></i></a></div><input class='form-control' placeholder='Property No.' name='update_property_number_array[]' id='update_property_number_1' value='"+obj.property_number_1+"'></section><section><div class='font-weight-bold'>Property No. <a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='editdelPropertyNumber(this)'><i class='fa fa-close'></i></a></div><input class='form-control' placeholder='Property No.' name='update_property_number_array[]' id='update_property_number_2' value='"+obj.property_number_2+"'></section>");
                }
                else if(typeof(obj.property_number_1) != "undefined" && obj.property_number_1 !== null ) {
                    $(".update_property_numbers").append("<section><div class='font-weight-bold'>Property No. <a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='editdelPropertyNumber(this)'><i class='fa fa-close'></i></a></div><input class='form-control' placeholder='Property No.' name='update_property_number_array[]' id='update_property_number_1' value='"+obj.property_number_1+"'></section>");
                }

            
                $("#update_prop_total_val_1").val(obj.value);
                $("#update_propassign_form").text(obj.staff_fullname);
                $("#update_select_division").val(obj.division).change();
                $("#update_remarks").val(obj.remarks);
                $("#update_remarks_from").val(obj.remarks_from);
                $("#update_remarks_sales").val(obj.remarks_sales);
                $("#update_remarks_sales_date").val(obj.remarks_sales_date);
                $("#update_remarks_po_num").val(obj.remarks_po_num);
                $("#update_remarks_po_date").val(obj.remarks_po_date);
                $("#update_remarks_pr_num").val(obj.remarks_pr_num);
                $("#update_remarks_pr_date").val(obj.remarks_pr_date);
                $("#update_remarks_charged").val(obj.remarks_charged);
                $('#update-issued-by-date').html(moment(obj.date_par).format('LL'));
                $('#update-received-by-date').html(moment(obj.date_acquired).format('LL'));
            });
        }).fail(function() {
            alert("Error loading data! Page reloading, please wait...")
            location.reload();
        });
        $("#editEquipment").modal("toggle");
    }

    function transferEquipment(id) {
        $.getJSON("{{ url('get/components') }}/" + id, function(datajson) {}).done(function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#transfer_equipment_id").val(obj.id);
            });
        }).fail(function() {
            alert("Error loading data! Page reloading, please wait...")
            location.reload();
        });
        $("#transferEquipment").modal("toggle");
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
                window.location.href = "{{ url('ppe/accept-equipment') }}/" + id;
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
                window.location.href = "{{ url('revert-equipment') }}/" + id;
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
                $.getJSON("{{ url('get/components') }}/" + id, function(datajson) {}).done(function(datajson) {
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
    
    function deletePPE(id) {
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
               
                window.location.href = "{{ url('ppe/delete') }}/" + id;
            }
        })
    }

    function viewHistory(varID) {
          var historyDataTable = $('#history-datatable').DataTable({
              "processing": true,
              "serverSide": false,
              "searching": false,
              "destroy": true,
              "bInfo": false,
              "paging": false,
              "ajax": {
                "type": "GET",
                "url": "{{ url('get/view_history_ppe') }}" + "/" + varID
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

    function generatePAR(id) {
        window.open("{{ url('pdf/par') }}/" + id, '_blank');
    }

    function generatePropertyCard(id) {
        window.open("{{ url('pdf/propcard') }}/" + id, '_blank');
    }
</script>
@endsection