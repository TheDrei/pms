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
</style>
@endsection

@section('content-title')
REPORT - Report on Physical Count of PPE
@endsection

@section('content')

<!-- START MODAL -->
<div class="modal fade" id="editEquipment">
  <div class="modal-dialog modal-lg" style="margin-right:750px;">
    <div class="modal-content" style="width:1300px; ">
      <div class="modal-header">
        <h5 class="modal-title">View Equipment</h4>
      </div>

      <form method="POST" action="{{ url('update-ics') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="update_equipment_id" id="update_equipment_id" value="">
        <input type="hidden" name="update_set_id" id="update_set_id" value="">

        <input type="hidden" name="equipment_sets" id="equipment_sets" value="">
        <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value="">

        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Supply Details</a>

        </div>
        </nav>
        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card">


              <br />


              <div class="row form-group" style="padding-left:10px;">
                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Division</label></div>
                <div class="col-12 col-md-6">
                  <span id="update_select_division"> </span>
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Date of PAR</label></div>
                <div class="col-12 col-md-4">
                  <input type="date" name="update_date_par" id="update_date_par" class="form-control">
                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Fund Cluster</label></div>
                <div class="col-12 col-md-6">
                  <input type="text" name="update_fund_cluster" id="update_fund_cluster" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>



              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">PAR No.</label></div>
                <div class="col-12 col-md-6">
                  <input type="text" name="update_par_number" id="update_par_number" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Sub Property No.</label></div>
                <div class="col-12 col-md-6">
                  <input type="text" name="update_subprop_num" id="update_subprop_num" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>



              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Serial No.</label></div>
                <div class="col-12 col-md-6">
                  <input type="text" name="update_serial_num" id="update_serial_num" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class="form-control-label">Classification</label></div>
                <div class="col-12 col-md-6">
                  <b><span id="update_category" name="update_category" value=""></span></b>
                  <input type="hidden" id="update_division" name="update_division" value="">
                  <input type="hidden" id="update_fullname" name="update_fullname" value="">
                  <input type="hidden" id="update_categoryHidden" name="update_categoryHidden" value="">
                  <input type="hidden" id="update_subcategoryHidden" name="update_subcategoryHidden" value="">

                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Sub Property No.</label></div>
                <div class="col-12 col-md-6">
                  <input type="text" id="update_prop_subcat" name="update_prop_subcat" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Item Description</label></div>
                <div class="col-12 col-md-10">
                  <textarea style="width:400px; height:90px;" class="form-control" name='update_prop_desc' id="update_prop_desc" autocomplete="off"></textarea>
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Quantity</label></div>
                <div class="col-12 col-md-5">
                  <input style="width:100px;" type="number" value="" name="update_prop_quantity" min="1" max="10" id="update_prop_quantity" class="form-control">
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Unit of Measure</label></div>
                <div class="col-12 col-md-6">
                  <select name="update_prop_umeasure" id="update_prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="form-control">
                    <option value="unit">unit</option>
                    <option value="pc">piece</option>
                    <option value="set">set</option>
                  </select>
                </div>
              </div>


              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Acquired (Date of Invoice)</label></div>
                <div class="col-12 col-md-6">
                  <input type="date" name="update_date_acquired" id="update_date_acquired" class="form-control" value="">
                </div>
              </div>

              <div class="row form-group" style="padding-left:10px;">
                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div>
                <div class="col-12 col-md-6">
                  <input type="number" name="update_prop_total_val" id="update_prop_total_val_1" class="form-control" value="" autocomplete="off" required>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h4>Remarks</h4>
                </div>
                <div class="card-body">
                  <br />
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Purchased From </label></div>
                    <div class="col-12 col-md-6">
                      <input type="text" name="update_remarks_from" id="update_remarks_from" class="form-control">
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sales Invoice No.</label></div>

                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                    <div class="col-12 col-md-6">
                      <input type="text" name="update_remarks_sales" id="update_remarks_sales" class="form-control">
                    </div>
                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                    <div class="col-12 col-md-6">
                      <input type="date" name="update_remarks_sales_date" id="update_remarks_sales_date" class="form-control">
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">PO/PCV</label></div>

                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                    <div class="col-12 col-md-6">
                      <input type="text" name="update_remarks_po_num" id="update_remarks_po_num" class="form-control">
                    </div>
                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                    <div class="col-12 col-md-6">
                      <input type="date" name="update_remarks_po_date" id="update_remarks_po_date" class="form-control">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">PR</label></div>

                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                    <div class="col-12 col-md-6">
                      <input type="text" name="update_remarks_pr_num" id="update_remarks_pr_num" class="form-control">
                    </div>
                  </div>

                  <div class="row form-group" style="padding-left: 30px;">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                    <div class="col-12 col-md-6">
                      <input type="date" name="update_remarks_pr_date" id="update_remarks_pr_date" class="form-control">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Charged to</label></div>
                    <div class="col-12 col-md-6">
                      <input type="text" name="update_remarks_charged" id="update_remarks_charged" class="form-control">
                    </div>
                  </div>
                </div>
              </div>


              <div class="row form-group">


                <div class="hide-label">


                </div>


              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

          </div>
        </div>
        <br>
        <p align="right" style="padding-right:300px;">
          <button type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-lg">Update</button>
          <a href="" data-dismiss="modal" class="btn btn-danger btn-lg">Cancel</a>
        </p>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
      
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Equipment Details</a>

        </div>
        </nav>
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
          <button type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-lg">Transfer</button>
          <a href="" data-dismiss="modal" class="btn btn-danger btn-lg">Cancel</a>
        </p>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END TRANSFER -->

<!-- START DISPOSAL -->
<div class="modal fade" id="disposeEquipment">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 10px;">
      <div class="modal-header">
        <h5 class="modal-title">Dispose Equipment</h4>
      </div>

      <form id="disposeEquipmentForm" method="POST" action="{{ url('dispose-ics') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dispose_equipment_id" id="dispose_equipment_id" value="">
        <input type="hidden" name="dispose_fullname" id="dispose_fullname" value="">
        <input type="hidden" name="dispose_division" id="dispose_division" value="">


        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Equipment Details</a>

        </div>
        </nav>
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
          <button type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-lg">Dispose</button>
          <a href="" data-dismiss="modal" class="btn btn-danger btn-lg">Cancel</a>
        </p>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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

<p align="left"><button id="equipmentButton" style="border-radius:4px;" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Generate RPCPPE</button></p>
<div id="print-row">
  <p align="left" style="display:hidden;"><button id="printRPCPPE" style="border-radius:4px;" type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="printRPCPPE()"><i class="fa fa-print"></i>&nbsp; Print RPCPPE</button></p>
</div>

<table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; ">
  <thead class="thead-light">
    <tr>
      <th style="width: 2%">#</th>
      <th>ARTICLE</th>
      <th>DESCRIPTION</th>
      <th>PROPERTY NUMBER</th>
      <th>UNIT OF MEASURE</th>
      <th>UNIT VALUE</th>
      <th>QUANTITY (PER PROPERTY CARD)</th>
      <th width="10%">QUANTITY (PER PHYSICAL COUNT)</th>
      <th width="10%">SHORTAGE/OVERAGE (Quantity)</th>
      <th width="10%">SHORTAGE/OVERAGE (Value)</th>
      <th width="10%">REMARKS</th>
    </tr>
  </thead>
  <tbody>
    <tr id="toclear" style="">
      <td colspan="14">
        <center>Click <strong>Generate RPCPPE</strong> to Generate Report</center>
      </td>
    </tr>
  </tbody>
</table>

<!-- GENERATE RPCPPE  -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width:1950px;">
    <div class="modal-content" style="width:900px;">
      <div class="modal-header">
        <h5 class="modal-title" id="largeModal">Generate RPCPPE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="saveICS" method="POST" action="{{ url('save-ics2') }}">
          @csrf

          <div class="card-body">
            <input type="hidden" name="empcode" id="empcode" value="">
            <div class="row form-group">
              <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Year</label></div>
              <div class="col-12 col-md-4">
                <select class="form-control" id="select_year">
                  <?php
                  $yr = date('Y');
                  $yr2 = $yr - 5;
                  for ($i = $yr; $i >= $yr2; $i--) {
                    echo "<option value='$i'>$i</option>";
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">PPE Type</label></div>
              <div class="col-12 col-md-4">
                <select id="select_ppe_type" data-placeholder="Select a PPE Type" class="form-control">
                  <option value="" disabled selected></option>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button style="border-radius: 4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button style="border-radius: 4px;" id="generateics" type="button" data-dismiss="modal" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- END GENERATE RPCPPE -->


@endsection

@section('addJS')
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
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

    $("#print-row").hide();

    $('#select_year').select2({
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      theme: "classic",
      width: '100%',

    });

    $('#select_ppe_type').select2({
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      theme: "classic",
      width: '100%',
    });

    $('#select_staff').select2({
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      width: '100%',

    });

    $('#update_propassign_form').select2({
      dropdownParent: "#editEquipment",
      closeOnSelect: true,
      width: '100%',

    });

    $('#transfer_propassign_form').select2({
      dropdownParent: "#transferEquipment",
      closeOnSelect: true,
      width: '100%',

    });

    $('#transfer_select_division').select2({
      dropdownParent: "#transferEquipment",
      closeOnSelect: true,
      width: '100%',

    });
    //FILTER DIVISION ON ISSUED TO DROP-DOWN
    $("#select_division").on('change', function() {
      $.getJSON("{{ url('get/division') }}/" + this.value, function(datajson) {
        $("#select_staff").empty();
        jQuery.each(datajson, function(i, obj) {
          $("#select_staff").append("<option value=''>Select a Staff</option>");
          $("#select_staff").append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
        });

      });

    });
    //FILTER DIVISION ON ISSUED TO DROP-DOWN

    $.getJSON("{{ url('json/ppe-type/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#select_ppe_type").append("<option value='" + obj.type + "'>" + obj.type + "</option>");
      });

    });

    $.getJSON("{{ url('json/users/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#update_propassign_form").append("<option value='" + obj.fullname + "'>" + obj.fullname + "</option>");

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
      // location.reload();
    });


    //propQuantityCheck();
    hideElements();

    //Hide Number Input
    $('#categoryHidden').hide();
    $('#subcategoryHidden').hide();

    $("#select_staff").on('change', function() {
      $("#getstaffname").val(this.value);
    });


    $.getJSON("{{ url('json/division/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
        $("#transfer_select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");

      });

    });

    //START INDIVIDUAL COMPONENT CLASSIFICATION
    var ctr = 0;
    $('#addComponents').click(function() {
      ctr += 1;
      // console.log(ctr);
      //ADD CLASS
      window.getClass = function(id) {
        var subcattext = $("option:selected", "#equip_subcat_1").text();

        $.getJSON("{{ url('json/showcategory') }}/" + id, function(datajson) {}).done(function(datajson) {


          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            $("#category").text(obj.class_description);
            $("#prop_class_" + ctr + "").val(obj.class_description);
            $("#getSubcategory_" + ctr + "").val(obj.subclass_description);
            $("#categoryHidden").val(obj.class_description);
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
      $("#tbl_components_" + id + " tr:last").after("<tr><td><input style='font-size:12px;' type='text' class='form-control' name='comp_property_number[]' value=''></td><td><input style='font-size:12px;' type='text' class='form-control' name='prop_class[]' id='prop_class_" + proctr + "'></td><td><select onchange='getClass(this.value)' style='font-size:12px;' name='equip_subcat[]' id='equip_subcat_" + proassignctr + "' class='form-control prop_assign_ctr'><option value='' selected>--Select--</option></select></td><td><input style='font-size:12px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_" + proctr + "'></td><td><input style='font-size:12px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_" + proctr + "'></td><td><input style='font-size:12px;' type='text' class='form-control' name='equip_subprop_num[]' value='" + proctr + "'></td><td><input style='font-size:12px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + proctr + "' value=''></td><td>" + del_btn + "</td></tr>");

      $("#equip_subcat_" + proassignctr + "").select2({
        dropdownParent: "#tbl_components_" + id + " tr:last",
        closeOnSelect: true,
        width: '100%',

      });
      //DELEGATE ON CHANGE 
      $(document).on("change", "#equip_subcat_" + proassignctr + "", function() {
        $.getJSON("{{ url('json/showcategory') }}/" + this.value, function(datajson) {}).done(function(datajson) {

          //LOAD JSON CLASS
          jQuery.each(datajson, function(i, obj) {
            $("#category").text(obj.class_description);
            $("#prop_class_" + proassignctr + "").val(obj.class_description);
            $("#getSubcategory_" + proassignctr + "").val(obj.subclass_description);
            $("#categoryHidden").val(obj.class_description);
            $("#subcategoryHidden").val(subcattext);

          });

        }).fail(function() {
          alert(Error);
        });
      });
      //DELEGATE ON CHANGE 

      $("#tbl_components_" + id + " tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_" + proctr + "'  class='form-control'>");

    
      $.getJSON("{{ url('json/subcategory/all') }}", function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          $("#equip_subcat_" + proassignctr).append("<option value='" + obj.classification_id + "'>" + obj.description + "</option>");

        });


      });
    }

    //GET DIVISION
    window.getDivision = function(empcode) {
      $("#empcode").val(empcode);
      console.log
      $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
        //LOAD JSON CLASS
        jQuery.each(datajson, function(i, obj) {

          $("#division").val(obj.division_acro);
          $("#position").val(obj.position_desc);

          $("#fullname").val(obj.fullname);
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
    
      var propassign_formvar = $("#select_staff").val();
      $("#nav-tab").empty().append('<a class="replace-tab-text nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#sub-item-1" role="tab" aria-controls="nav-home" aria-selected="false">Set 1</a>');

      $("#nav-tabContent").append('<div class="tab-pane fade show" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab"><div class="card"><div class="card-body"><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div><div class="col-12 col-md-6"><input type="text" name="prop_num[]" id="prop_num_1" class="form-control propassignformctr" value="" required></div></div><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div><div class="col-12 col-md-6"><input type="text" name="prop_total_val[]" id="prop_total_val_1" class="form-control" value="" required></div></div><div class="row form-group"><div class="col-12 col-md-2 "><label for="text-input" class="form-control-label">Issued To</label></div><div class="col-12 col-md-6"><select name="propassign_form[]" id="select_staff" data-placeholder="Select a Staff" class="form-control propassign_ctr" required><option value="' + propassign_formvar + '" selected>' + propassign_formvar + '</option></select></div></div><div class="hide-label"><h7>Add Components <a href="#" class="btn btn-primary btn-sm" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br/><br/><table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px"><thead><th style="width:20%">Component Name</th><th style="width:50%">Serial No.</th><th style="width:2%">Date Issued</th><th style="width:100%">Issued To</th><th style="width:2%"></th></thead></table></div></div></div>');

      // hideElements(); 

    }

    $(document).on("click", "#generateics", function() {

      $("#print-row").show();

      $("#largeModal .close").click();

      //WORK ON 
   
      var year = $("#select_year").val();
      var ppe_type = $("#select_ppe_type").val();


      var t = $('#bootstrap-data-table').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "paging": true,
        "ajax": {
          "type": "GET",
          "url": "{{ url('get/get_rpcppe')}}" + "/" + year + "/" + ppe_type
        },
        "columns": [{
            "data": "id"
          },
          {
            "data": "component_classification"
          },
          {
            "data": "component_name"
          },
  
          {
            "data": "property_number"
          },
       
          {
            "data": "component_umeasure"
          },
          {
            "data": "value"
          },
          {
            "data": "quantity"
          },
          {
            "data": "quantity"
          },
          {
            "data": ["remarks"]
          },
          {
            "data": "remarks"
          },
          {
            "data": "remarks"
          }

        ],
        "columnDefs": [{
          "targets": 2,
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

      t.clear();
      // TODO
      //action button event listeners
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


      $('#bootstrap-data-table').on('click', '.row-generate-ics', function(e) {
        let varID = getRowID(e.target);
        generateICS(varID);

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

  });

  //helper
  function getRowID(element) {
    return $(element).parents('tr').attr('data-id')
  }

 
  function editEquipmentdetails(id) {

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
    $.getJSON("{{ url('get/equipment-set-components') }}/" + id, function(datajson) {

      var del_btn = "";


      if (id != 0) {
        var proctr = 0;
        del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        proctr -= 1;
      }



      $.getJSON("{{ url('get/viewppecomponents-components') }}/" + datajson[0].id, function(datajson) {

      }).done(function(datajson) {
        jQuery.each(datajson, function(i, obj) {
          var selectlength = ($(".selectlength").length);


          $("#edit_tbl_components_1 tr:last").after("<tr><td><input style='font-size:12px;' type='text' class='form-control' name='update_comp_property_number[]' value='" + obj.property_number + "'></td><td><input style='font-size:12px;' type='text' class='form-control' name='update_comp_prop_class[]' id='update_comp_prop_class_" + i + "' value='" + obj.component_subclass + "'></td><td><select onchange='getClass(this.value)' style='font-size:12px;' name='update_comp_equip_subcat[]' id='update_comp_equip_subcat_" + i + "' class='form-control prop_assign_ctr'><option value='" + obj.component_classification + "' selected>" + obj.component_classification + "</option></select></td><td><textarea style='font-size:12px; overflow:auto; height:120px;width:320px; word-wrap: break-word;' type='text' class='form-control prop_component_ctr' name='update_comp_prop_component[" + i + "]' id='update_comp_prop_component_" + i + "' value='" + obj.component_name + "'>" + obj.component_name + "</textarea></td><td><input style='font-size:12px;' type='number' class='form-control' value='" + obj.quantity + "' name='update_component_quantity[]' id='update_component_quantity_" + i + "'></td><td><input style='font-size:12px;' type='text' class='form-control' name='update_comp_prop_class[]' id='update_comp_prop_class_" + i + "' value='" + obj.property_number + "'></td> <td><input style='font-size:12px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + i + "' value='" + obj.serial_num + "'></td><td  class='selectlength'><select style='width: 100%' name='update_component_issued_to[" + i + "]' id='update_component_issued_to_" + i + "' onchange='getDivision2(this.value)' data-placeholder='Select a Staff' class='form-control'><option value='" + obj.issued_to + "' selected>" + obj.fullname + "</option></select></td><td>");

          $.getJSON("{{ url('json/users/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
              $("#update_component_issued_to_" + selectlength).append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
              $("#update_component_issued_to_" + selectlength).select2();


              //DELEGATE ON CHANGE 

              //WORK ON THIS AT THE OFFICE
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
        $("#update_equipment_id").val(obj.id);
        $("#update_set_id").val(obj.id);
        $("#update_par_number").val(obj.property_number);
        $("#update_date_par").val(obj.date_par);
        $("#update_categoryHidden").val(obj.component_classification);
        $("#update_subcategoryHidden").val(obj.component_subclass);
        $("#update_category").text(obj.component_classification);
        $("#update_prop_subcat").val(obj.component_subclass);
        $("#update_prop_desc").val(obj.component_name);
        $("#update_serial_num").val(obj.serial_num);
        $("#update_division").val(obj.division);
        $("#update_position").val(obj.position);
        $("#update_fullname").val(obj.issued_to);
        $("#update_prop_quantity").val(obj.quantity);
        $("#update_subprop_num").val(obj.component_subpropertynumber);
        $("#update_fund_cluster").val(obj.fund_cluster);
        $("#update_fund_number").val(obj.fund_number);
        $("#update_date_issued").val(obj.date_issued);
        // $("#update_prop_umeasure").val(obj.update_prop_umeasure);
        // $("#update_date_delivered").val(obj.date_delivered);
        // $("#update_date_inspected").val(obj.date_inspected);
        // $("#update_date_accepted").val(obj.date_accepted);
        $("#update_date_acquired").val(obj.date_acquired);
        $("#update_prop_num_1").val(obj.property_number);
        $("#update_prop_total_val_1").val(obj.value);
        $("#update_propassign_form").text(obj.staff_fullname);
        $("#update_select_division").text(obj.division);
        $("#update_remarks_from").val(obj.remarks_from);
        $("#update_remarks_sales").val(obj.remarks_sales);
        $("#update_remarks_sales_date").val(obj.remarks_sales_date);
        $("#update_remarks_po_num").val(obj.remarks_po_num);
        $("#update_remarks_po_date").val(obj.remarks_po_date);
        $("#update_remarks_pr_num").val(obj.remarks_pr_num);
        $("#update_remarks_pr_date").val(obj.remarks_pr_date);
        $("#update_remarks_charged").val(obj.remarks_charged);
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
        // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
        window.location.href = "{{ url('accept-ics') }}/" + id;
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
        // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
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

  function deleteEquip(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
        window.location.href = "{{ url('admin/delete-equipment') }}/" + id;
      }
    })
  }

  function generateICS(set_id) {
    window.open("{{ url('pdf/rpcppe') }}/" + set_id);
  }

  function printRPCPPE(year) {
    var year = $("#select_year").val();
    var ppe_type = $("#select_ppe_type").val();
    window.open("{{ url('pdf/rpcppe') }}/" + year + "/" + ppe_type);
  }
</script>

@endsection