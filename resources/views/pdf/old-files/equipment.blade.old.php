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
<!-- START MODAL -->
<div class="modal fade" id="editEquipment">
    <div class="modal-dialog modal-lg" style="margin-right:750px;">
        <div class="modal-content custom" style="margin-top: 10px; width:1300px; overflow-x:hidden;">
            <div class="modal-header">
                <h5 class="modal-title">
                    Update Equipment</h4>
            </div>
            <form method="POST" action="{{ url('update-equipment') }}" enctype="multipart/form-data">
                @csrf <input type="hidden" name="update_position" id="update_position" value="">
                <input type="hidden" name="update_equipment_id" id="update_equipment_id" value="">
                <input type="hidden" name="update_set_id" id="update_set_id" value="">

                <input type="hidden" name="equipment_sets" id="equipment_sets" value="">
                <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value="">
              
                <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card">
                            <br />
                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">PAR No.</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="update_par_number" id="update_par_number" class="form-control" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="update_property_number" id="update_property_number" class="form-control" value="" autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Fund Cluster</label></div>
                                <div class="col-12 col-md-6">
                                <select name="update_fund_cluster" id="update_fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control">
                                        <option value="" disabled selected>Select a Fund Cluster</option>
                                        <option value="No Fund Cluster Data">No Fund Cluster Data</option>
                                 </select>
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px; display:none;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">PPE Category</label></div>
                                <div class="col-12 col-md-6">
                                    <select name="update_ppe_type" id="update_ppe_type" data-placeholder="Choose a PPE Type" class="form-control" >
                                        <option value="" disabled selected>Select a PPE Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Unit of Measure</label></div>
                                <div class="col-12 col-md-6">
                                    <select name="update_prop_umeasure" id="update_prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="form-control">
                                        <option value="unit">unit</option>
                                        <option value="set">set</option>
                                    </select>
                                </div>
                            </div>

                        
                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Sub Property No.</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="update_subprop_num" id="update_subprop_num" class="form-control" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Serial No.</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="text" name="update_serial_num" id="update_serial_num" class="form-control" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="row form-group" style="padding-left:10px;">
                                <!-- <div class="col col-md-2"><label for="text-input" class="form-control-label">Classification</label></div> -->
                                <div class="col-12 col-md-6">
                                    <!-- <b><span id="update_category" name="update_category" value=""></span></b> -->
                                    <input type="hidden" id="update_division" name="update_division" value="">
                                    <input type="hidden" id="update_fullname" name="update_fullname" value="">
                                    <input type="hidden" id="update_categoryHidden" name="update_categoryHidden" value="">
                                    <input type="hidden" id="update_subcategoryHidden" name="update_subcategoryHidden" value="">
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Quantity</label></div>
                                <div class="col-12 col-md-6">
                                    <input style="width:100px;" type="number" value="" name="update_prop_quantity" min="1" max="10" id="update_prop_quantity" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Date of PAR</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="date" name="update_date_par" id="update_date_par" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Acquired (Date of Invoice)</label></div>
                                <div class="col-12 col-md-6">
                                    <input type="date" name="update_date_acquired" id="update_date_acquired" class="form-control" value="">
                                </div>
                            </div>

                            <div class="hide-label" style="padding-left:10px;">
                                <input type='hidden' class='form-control' name='component_value' id='component_value '>
                                <h7>Add Components <a href="#" class="btn btn-primary btn-sm" id="editaddComponents" onclick="editaddComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br /><br />
                                <div style="width:1200px; overflow-x:auto;">
                                <table class="table table-condensed" id="edit_tbl_components_1" width="100%" style="font-size: 12px">
                                    <thead class="thead-light">
                                        <th style="width:10%">Inventory Item No.</th>
                                        <th style="width:20%">Classification</th>
                                        <th style="width:20%">Component</th>
                                        <th style="width:20%">Description</th>
                                        <!--     <th style="width:20%">Value</th> -->
                                        <th style="width:5%">Quantity</th>
                                        <th style="width:5%">Sub-Property No.</th>
                                        <!--  <th style="width:5%">Sub-ICS No.</th> -->
                                        <th style="width:5%">Serial Number</th>
                                        <th style="width:20%">Issued To</th>
                                        <th style="width:20%">Value</th>
                                        <th style="width:20%"></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div><strong><br/>&nbspTotal Cost: ₱<span id="update_total_cost"></span></strong></div>
                        <br/>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Remarks</h4>
                                </div>
                                <div class="card-body">
                                    <br />
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Remarks </label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks" id="update_remarks" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Purchased From </label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks_from" id="update_remarks_from" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Sales Invoice No.</label></div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">No. </label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks_sales" id="update_remarks_sales" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date</label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="date" name="update_remarks_sales_date" id="update_remarks_sales_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">PO/PCV</label></div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">No. </label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks_po_num" id="update_remarks_po_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date</label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="date" name="update_remarks_po_date" id="update_remarks_po_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">PR</label></div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">No. </label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks_pr_num" id="update_remarks_pr_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group" style="padding-left: 30px;">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date</label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="date" name="update_remarks_pr_date" id="update_remarks_pr_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">Charged to</label></div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" name="update_remarks_charged" id="update_remarks_charged" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    </div>
                </div>
                <br>
                <p align="right" style="padding-right:80px;">
                    <button type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Update</button>
                    <a href="" data-dismiss="modal" class="btn btn-secondary btn-md">Cancel</a>
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
                <h5 class="modal-title">
                    Transfer Equipment</h4>
            </div>
            <form method="POST" action="{{ url('transfer-equipment') }}" enctype="multipart/form-data">
                @csrf <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
                <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
                <input type="hidden" name="transfer_division" id="transfer_division" value="">
                <input type="hidden" name="transfer_position" id="transfer_position" value="">
                <!--   <input type="hidden" name="equipment_sets" id="equipment_sets" value="">    
                    <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value=""> -->
          
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
<p align="left"><button id="equipmentButton" type="button" style="border-radius: 4px" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Add Equipment</button></p>

<div class="card-body">
    <table id="bootstrap-data-table" class="table table-striped table-hover" style="background-color:#FFF;width: 100%;">
        <thead class="thead-light">
            <tr>
                <th style="width: 2%">#</th>
                <th>DIVISION</th>
                <th style="width: 20%">CHARGED TO</th>
                <th>PAR NO.</th>
                <th>PURCHASED FROM</th>
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
    <br />
</div>

<!-- START ADD NEW EQUIPMENT MODAL  -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:1950px; padding-right:1900px; padding-left: 300px;">
        <div class="modal-content custom" style="width:1250px;">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModal">Add New Equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('save-equipment') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="position" id="position" value="">
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">PAR No.</label></div>
                                <div class="col-12 col-md-4">
                                    <input class="form-control" placeholder="PAR No." name='par_number' id="par_number" required>
                                 
                                </div>
                                <input type="checkbox" id="par_number_check" name="par_number_check" value="No PAR No.">
                                <label style="padding-top:5px;" for="par_number_check"> <small>&nbsp;No PAR No.</small></label><br>
                            </div>



                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div>
                                <div class="col-12 col-md-4">
                                    <input class="form-control" placeholder="Property No." name='property_number' id="property_number" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Fund Cluster</label></div>
                                <div class="col-12 col-md-4">
                                <select name="fund_cluster" id="fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control" required>
                                        <option value="" disabled selected>Select a Fund Cluster</option>
                                 </select>
                                </div>
                                <input type="checkbox" id="fund_cluster_check" name="fund_cluster_check" value="No PAR No.">
                                <label style="padding-top:5px;" for="fund_cluster_check"> <small>&nbsp;No Fund Cluster</small></label><br>
                            </div>

                            <div class="row form-group" style="display:none;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">PPE Category</label></div>
                                <div class="col-12 col-md-4">
                                    <select name="ppe_type" id="ppe_type" data-placeholder="Choose a PPE Category" class="form-control">
                                        <option value="" disabled selected>Select a PPE Category</option>
                                    </select>
                                </div>
                            </div>
                        
                          
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Unit of Measure</label></div>
                                <div class="col-12 col-md-4">
                                    <select name="prop_umeasure" id="prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="form-control" required>
                                        <option value="" disabled selected>Select Unit of Measure</option>
                                        <option value="unit">unit</option>
                                        <option value="set">set</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="row form-group">
                                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Division</label></div>
                                <div class="col-12 col-md-4">
                                    <select name="select_division" id="select_division" data-placeholder="Select a Division" class="form-control" required>
                                        <option value="" disabled selected>----Select Division----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Issued To</label></div>
                                <div class="col-12 col-md-4">
                                    <select name="propassign_form[]" id="propassign_form_1" data-placeholder="Select a Staff" class="form-control" onchange="getDivision(this.value)" required>
                                        <option value="" disabled selected>----Select Staff----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Date of PAR</label></div>
                                <div class="col-12 col-md-4">
                                    <input type="date" name="date_par" id="date_par" class="form-control" required>
                                </div>
                                <input type="checkbox" id="date_par_check" name="date_par_check" value="No Date of PAR">
                                <label style="padding-top:5px;" for="date_par_check"> <small>&nbsp;No Date of PAR</small></label><br>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Acquired</label></div>
                                <div class="col-12 col-md-4">
                                    <input type="date" name="date_acquired" id="date_acquired" class="form-control" required>
                                </div>
                                <input type="checkbox" id="date_acquired_check" name="date_acquired_check" value="No Date Acquired">
                                <label style="padding-top:5px;" for="date_acquired_check"> <small>&nbsp;No Date Acquired</small></label><br>
                            </div>
                        </div>
                    </div>
                    <!--End of modal -->

                    <!-- End of Set code  -->
                    <div class="card">
                        <div class="card-body">
                            <div class="default-tab">
                                <!-- TAB  -->
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="card-body">
                                        <input type="hidden" name="getstaffemployeecode" id="getstaffemployeecode" value="">
                                        <input type="hidden" name="getstaffname" id="getstaffname" value="">
                                            <!-- March 10, 2020
                                                    Drei Cambay
                                                    Changes Made:
                                                    1. Added table from PPIMS -->
                                            <div class="row form-group">
                                                <div class="col-12 col-md-6">
                                                    <input type="hidden" id="division" name="division" value="">
                                                    <input type="hidden" id="fullname" name="fullname" value="">
                                                    <input type="hidden" id="categoryHidden" name="categoryHidden" value="">
                                                    <input type="hidden" id="subcategoryHidden" name="subcategoryHidden" value="">
                                                </div>
                                            </div>
                                            <!-- End of Select code  -->
                                            <!-- February 28, 2020
                                                    Drei Cambay
                                                    Changes Made:
                                                    1. Added Sub-Classification drop-down 
                                                    2. March 10 - added table from PPIMS -->
                                           <div class="row form-group">
                                            <div class="hide-label">
                                                <input type='hidden' class='form-control' name='component_value' id='component_value '>
                                                <h7>Add Components <a href="#" class="btn btn-primary btn-sm" id="addComponents" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7>
                                                <br /><br />
                                                <div style="width:1100px; overflow-x:auto;">
                                                    <table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px">
                                                        <thead class="thead-light">
                                                            <th style="width:20%">Inventory Item No.</th>
                                                            <th style="width:20%">Sub-Category</th>
                                                            <th style="width:20%">Category</th>
                                                            <th style="width:10%">Description</th>
                                                            <th style="width:10%">Quantity</th>
                                                            <th style="width:10%">Sub-Property No.</th>
                                                            <th style="width:30%">Serial No.</th>
                                                            <th style="width:30%">Estimated Useful Life</th>
                                                            <th style="width:30%">Unit Cost</th>
                                                            <th style="width:20%"></th>
                                                        </thead>
                                                    </table>
                                                </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <div><strong><br/>Total Cost: ₱<span id="total_cost"></span></strong></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Staff Table -->
                        </div>
                        <!-- END OF TAB  -->
                    </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Remarks</h4>
                </div>
                <div class="card-body">
                    <br />
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Remarks </label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="Remarks" name="remarks" id="remarks" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Purchased From </label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="Purchased From" name="remarks_from" id="remarks_from" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_from_check" name="remarks_from_check" value="No Purchased From">
                        <label style="padding-top:5px;" for="remarks_from_check"> <small>&nbsp;No Purchased From Data</small></label><br>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sales Invoice No.</label></div>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="Sales Invoice No." name="remarks_sales" id="remarks_sales" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_sales_check" name="remarks_sales_check" value="No Sales Invoice No. Data">
                        <label style="padding-top:5px;" for="remarks_sales_check"> <small>&nbsp;No Sales Invoice No. Data</small></label><br>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                        <div class="col-12 col-md-6">
                            <input type="date" name="remarks_sales_date" id="remarks_sales_date" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_sales_date_check" name="remarks_sales_date_check" value="No Sales Invoice Date Data">
                        <label style="padding-top:5px;" for="remarks_sales_date_check"> <small>&nbsp;No Sales Invoice Date Data</small></label><br>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PO/PCV</label></div>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="PO/PCV No." name="remarks_po_num" id="remarks_po_num" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_po_num_check" name="remarks_po_num_check" value="No PO/PCV No. Data">
                        <label style="padding-top:5px;" for="remarks_po_num_check"> <small>&nbsp;No PO/PCV No. Data</small></label><br>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                        <div class="col-12 col-md-6">
                            <input type="date" name="remarks_po_date" id="remarks_po_date" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_po_date_check" name="remarks_po_date_check" value="No PO/PCV Date Data">
                        <label style="padding-top:5px;" for="remarks_po_date_check"> <small>&nbsp;No PO/PCV Date Data</small></label><br>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">PR</label></div>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="PR No." name="remarks_pr_num" id="remarks_pr_num" class="form-control" required> 
                        </div>
                        <input type="checkbox" id="remarks_pr_num_check" name="remarks_pr_num_check" value="No PR No. Data">
                        <label style="padding-top:5px;" for="remarks_pr_num_check"> <small>&nbsp;No PR No. Data</small></label><br>
                    </div>
                    <div class="row form-group" style="padding-left: 30px;">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Date</label></div>
                        <div class="col-12 col-md-6">
                            <input type="date" name="remarks_pr_date" id="remarks_pr_date" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_pr_date_check" name="remarks_pr_date_check" value="No PR Date Data">
                        <label style="padding-top:5px;" for="remarks_pr_date_check"> <small>&nbsp;No PR Date Data</small></label><br>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Charged to</label></div>
                        <div class="col-12 col-md-6">
                            <input type="text" placeholder="Charged to" name="remarks_charged" id="remarks_charged" class="form-control" required>
                        </div>
                        <input type="checkbox" id="remarks_charged_check" name="remarks_charged_check" value="No Charged to Data">
                        <label style="padding-top:5px;" for="remarks_charged_check"> <small>&nbsp;No Charged to Data</small></label><br>
                    </div>
                    <!--    <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mode of Procurement</label></div>
                <div class="col-12 col-md-6">
                    <input type="text" name="mode_procurement" id="mode_procurement" class="form-control" >
                </div>
                </div>
                
                -->
                    <div class="modal-footer">
                        <button style="border-radius:4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button style="border-radius:4px;" type="submit" class="btn btn-primary">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ADD EQUIPMENT MODAL -->
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
            $('#remarks_pr_num').removeAttr('required');
            if(!ischecked)
            $("#remarks_pr_num").prop('required',true);
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
        $('#transfer_select_division').select2({
            dropdownParent: "#transferEquipment",
            theme: 'classic',
            closeOnSelect: true,
            width: '100%',
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
        //Staff Drop-Downs
        // $.getJSON( "{{ url('json/users/all') }}", function( datajson ) {
        //           jQuery.each(datajson,function(i,obj){
        //                 $("#propassign_form_1").append("<option value='"+obj.username+"'>"+obj.fullname+"</option>");
        //                 $("#transfer_propassign_form").append("<option value='"+obj.username+"'>"+obj.fullname+"</option>");
        //                 $("#update_propassign_form").append("<option value='"+obj.username+"'>"+obj.fullname+"</option>");    
        //       }); 
        // }); 
        //Division Drop-Down
        $.getJSON("{{ url('json/division/all') }}", function(datajson) {
            jQuery.each(datajson, function(i, obj) {
                $("#select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
                $("#transfer_select_division").append("<option value='" + obj.division_acro + "'>" + obj.division_acro + "</option>");
                // $("#update_select_division").append("<option value='"+obj.division_acro+"'>"+obj.division_acro+"</option>");
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

            //COMPONENT TEXT-INPUT NEWER
            $("#tbl_components_" + id + " tr:last").after("<tr><td><input style='font-size:12px; width:200px;' type='text' class='form-control' name='inventory_item_number[]' value=''></td><td><select onchange='getClass(this.value)' style='font-size:12px; width:300px;' name='equip_subcat[]' id='equip_subcat_" + proctr + "' class='form-control prop_assign_ctr'><option value='' selected>Select a Sub-Category</option></select></td><td><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equipment_category[]' id='equipment_category_" + proctr + "'></td><td><textarea style='font-size:12px; width:200px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_" + proctr + "'></textarea></td><td><input style='font-size:12px; width:50px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_" + proctr + "'></td><td><input style='font-size:12px; width:50px;' type='text' class='form-control' name='equip_subprop_num[]' value='" + proctr + "'></td><td><input style='font-size:12px; width:200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + proctr + "' value=''></td><td><input style='font-size:12px; width:200px;' type='number' class='form-control' name='estimated_useful_life[]' id='estimated_useful_life_" + proctr + "' value=''></td><td><input style='font-size:12px; width:200px;' step='any' type='number' class='form-control unit-cost' name='equip_unit_cost[]' id='equip_unit_cost_" + proctr + "' value='' required></td><td>" + del_btn + "</td></tr>");

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
                dropdownParent: "#tbl_components_" + id + " tr:last",
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
        
            $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                    $("#equip_subcat_" + proctr).append("<option value='" + obj.id + "'>" + obj.sub_type + "</option>");
                });
            });


        }
        //GET DIVISION
        window.getDivision = function(empcode) {
            $.getJSON("{{ url('get/users') }}/" + empcode, function(datajson) {}).done(function(datajson) {
                //LOAD JSON CLASS
                jQuery.each(datajson, function(i, obj) {
                    $("#fullname").val(obj.fullname);
                    $("#division").val(obj.division_acro);
                    $("#position").val(obj.position_desc);
                    $("#update_fullname").val(obj.fullname);
                    $("#update_division").val(obj.division_acro);
                    $("#update_position").val(obj.position_desc);
                    $("#transfer_fullname").val(obj.fullname);
                    $("#transfer_division").val(obj.division_acro);
                    $("#transfer_position").val(obj.position_desc);
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
                    "data": "remarks_charged"
                },
                {
                   
                    "data": "par_number"                
                },

                { 
                    "data": "remarks_from"
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
         
         window.updateGetCategory = function(id) {
            var subcattext = $("option:selected", "#update_prop_subcat").text();
            $.getJSON("{{ url('get/categories') }}/" + id, function(datajson) {}).done(function(datajson) {
                jQuery.each(datajson, function(i, obj) {
                    $("#update_category").text(obj.type);
                    $("#update_comp_prop_class_"+ ctr).val(obj.type);
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
                    $("#edit_tbl_components_1 tr:last").after("<tr><td><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_inventory_item_number[]' value='" + obj.inventory_item_number + "'></td><td><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_comp_prop_class[]' id='update_comp_prop_class_" + i + "' value='" + obj.component_classification + "'></td><td><select onchange='' style='font-size:12px; width: 200px;' name='update_comp_equip_subcat[]' id='update_comp_equip_subcat_" + i + "' class='form-control prop_assign_ctr'><option value='" + obj.component_subclass + "' selected>" + obj.component_subclass + "</option></select></td><td><textarea style='font-size:12px; overflow:auto; height:100px;width:320px; word-wrap: break-word;' type='text' class='form-control prop_component_ctr' name='update_comp_prop_component[" + i + "]' id='update_comp_prop_component_" + i + "' value='" + obj.component_name + "'>" + obj.component_name + "</textarea></td><td><input style='font-size:12px; width: 200px;' type='number' class='form-control' value='" + obj.quantity + "' name='update_component_quantity[]' id='update_component_quantity_" + i + "'></td><td><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='update_subproperty_number[]' id='update_subproperty_number_" + i + "' value='" + obj.component_subpropertynumber + "'></td>	<td><input style='font-size:12px; width: 200px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_" + i + "' value='" + obj.serial_num + "'></td><td  class='selectlength'><select style='width: 100%' name='update_component_issued_to[" + i + "]' id='update_component_issued_to_" + i + "' onchange='getDivision2(this.value)' data-placeholder='Select a Staff' class='form-control'><option value='" + obj.issued_to + "' selected>" + obj.fullname + "</option></select></td><td><input style='font-size:12px; width:200px;' type='number' step='any' class='form-control update-unit-cost' name='update_equip_unit_cost[]' id='update_equip_unit_cost_" + proctr + "' value='" + obj.amount + "' required></td><td>");
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

                        $.getJSON("{{ url('json/ppe-subtype/all') }}", function(datajson) {
                                jQuery.each(datajson, function(p, obj) {
                                    $("#update_comp_equip_subcat_" + i).append("<option value='" + obj.sub_type + "'>" + obj.sub_type + "</option>");
                                });
                            });

                        // $("#edit_tbl_components_1").after("<input type='text' name='updateGetSubcategory[]' id='updateGetSubcategory_" + i + "'  class='form-control prop_assign_ctr'>");

                        //DELEGATE ON CHANGE 
                        var ctr = 0;
                        $(document).on("change", "#update_comp_equip_subcat_"+i, function() {
                         ctr++;    
                        $.getJSON("{{ url('get/categories') }}/" + this.value, function(datajson) {}).done(function(datajson) {
                            //LOAD JSON CLASS
                            jQuery.each(datajson, function(i, obj) {
                                $("#update_category").text(obj.type);
                                $("#update_comp_prop_class_" + proctr +"").val(obj.type);
                                $("#updateGetSubcategory_" + proctr + "").val(obj.sub_type);
                                $("#update_categoryHidden").val(obj.type);
                                $("#update_subcategoryHidden").val(subcattext);
                            });
                            }).fail(function() {
                                alert(Error);
                            });
                        });
                        //DELEGATE ON CHANGE 

                    $.getJSON("{{ url('json/users/all') }}", function(datajson) {
                        jQuery.each(datajson, function(i, obj) {
                            $("#update_component_issued_to_" + selectlength).append("<option value='" + obj.username + "'>" + obj.fullname + "</option>");
                            $("#update_component_issued_to_" + selectlength).select2();

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
                $("#update_ppe_type").val(obj.ppe_type).change();
                $("#update_categoryHidden").val(obj.component_classification);
                $("#update_subcategoryHidden").val(obj.component_subclass);
                $("#update_category").text(obj.component_classification);
                $("#update_prop_subcat").val(obj.subclass_id);
                $("#update_prop_umeasure").val(obj.component_umeasure);
                $("#update_par_number").val(obj.par_number);
                $("#update_prop_desc").val(obj.component_name);
                $("#update_serial_num").val(obj.serial_num);
                $("#update_division").val(obj.division);
                $("#update_position").val(obj.position);
                $("#update_fullname").val(obj.issued_to);
                $("#update_prop_quantity").val(obj.quantity);
                $("#update_subprop_num").val(obj.component_subpropertynumber);
                $("#update_fund_cluster").val(obj.fund_cluster);
                $("#update_date_par").val(obj.date_par);
                $("#update_date_acquired").val(obj.date_acquired);
                $("#update_property_number").val(obj.property_number);
                $("#update_prop_total_val_1").val(obj.value);
                $("#update_propassign_form").text(obj.staff_fullname);
                $("#update_select_division").val(obj.division);
                $("#update_remarks").val(obj.remarks);
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