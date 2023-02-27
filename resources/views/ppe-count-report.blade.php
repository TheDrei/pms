@extends('layouts.master')

@section('addCSS')
<!-- <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<style>
.table td{
  font-size:14px;
}

.table th{
  font-size:12px;
}

/*.btn{
  background-color:#007bff;
}

.btn-secondary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}*/

</style>
@endsection


@section('content-title')
REPORTS - Physical Count of PPE
@endsection


@section('content')

<!-- START FILTER -->
<div class="modal fade" id="generateRPCPPE">
<div class="modal-dialog modal-lg">
    <div class="modal-content" style="margin-top: 10px;">
        <div class="modal-header">
                <h5 class="modal-title">Generate RPCPPE</h4>
            </div>
         
       <form method="POST" action="{{ url('transfer-equipment') }}" enctype="multipart/form-data">
      @csrf
                             <input type="hidden" name="transfer_equipment_id" id="transfer_equipment_id" value="">
                             <input type="hidden" name="transfer_fullname" id="transfer_fullname" value="">
                             <input type="hidden" name="transfer_division" id="transfer_division" value="">
                             <input type="hidden" name="transfer_position" id="transfer_position" value="">
                           <!--   <input type="hidden" name="equipment_sets" id="equipment_sets" value="">    
                             <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value=""> -->

                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Filter by Date</a>
                                        
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                               <div class="card">

                                          <br/>       
                                   

                                     <div class="row form-group" style="padding-left:10px;">
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">From</label></div>
                                    <div class="col-12 col-md-4">
                                          <input type="date" name="date_from" id="date_from" class="form-control">
                                    </div>
                                  </div>
                                   
                                  
                                     <div class="row form-group" style="padding-left:10px;">
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">To</label></div>
                                    <div class="col-12 col-md-4">
                                          <input type="date" name="date_to" id="date_to" class="form-control">
                                    </div>
                                  </div>
                                   

                                 <!--  <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Remarks</label></div>
                                    <div class="col-12 col-md-6">
                                        <textarea class="form-control" name='transfer_remarks' id="transfer_remarks" required></textarea>
                                    </div>
                                  </div>  -->
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
                                          <button type="button" id="ppebutton" onclick="updateValues()" value="" name="btn-edit" id="btn-edit" class="btn btn-primary btn-lg">Generate</button>
                                          <a href="" data-dismiss="modal" class="btn btn-danger btn-lg">Cancel</a></p>
                                        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<!-- END FILTER -->
        
    <p align="left"><button id="equipmentButton" onclick="generateRPCPPE();" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Generate Report</button></p>
<!--     <p align="left"><button id="icsButton" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; ADD SEMI-EXPANDABLE SUPPLY</button></p> -->
            <!-- <p align="right"><a href="{{ url('admin/equipment-create/new') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i>&nbsp; ADD NEW</a></p> -->
        <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; overflow-x: auto;">
                    <thead  class="thead-dark">
                          <tr>
                        <th style="width: 2%">#</th>
                        <th>ARTICLE</th>
                        <th>DESCRIPTION</th>
                        <th>PROPERTY NUMBER</th>
                        <th>UNIT VALUE</th>
                        <th>QUANTITY PER PROPERTY CARD</th>
                        <th>QUANTITY PER PHYSICAL COUNT</th>
                        <th colpan="3" style="padding-left: 50px; text-align:center;">SHORTAGE/OVER</th>
                        <th></th>
                        <th>REMARKS</th>

                          </tr>
                      <tr>
                        <th style="width: 2%"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>QUANTITY</th>
                        <th>VALUE</th>
                        <th></th>
                        <!-- <th>REMARKS</th>
                        <th>STATUS</th>
                        <th>DATE ACQUIRED</th>
                        <th width="10%">ACTION</th> -->
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>


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
        
        var propassign_formvar = $("#propassign_form_1").val();  
        var prop_umeasure = $('#prop_umeasure').val();

     
        $(document).ready(function() {

          $("#propassign_form_1").attr('required', true);  


          $('#propassign_form_1').select2({
                 dropdownParent: "#largeModal",
                 closeOnSelect: true,
                 width: '100%',

                    });

         

         $('#transfer_propassign_form').select2({
                 dropdownParent: "#transferEquipment",
                 closeOnSelect: true,
                 width: '100%',

                    });

          $('#select_division').select2({
                 dropdownParent: "#largeModal",
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
              $.getJSON( "{{ url('get/division') }}/"+this.value, function( datajson ) {
                         $("#propassign_form_1").empty();
                      jQuery.each(datajson,function(i,obj){
                            $("#propassign_form_1").append("<option value=''>Select a Staff</option>");
                            $("#propassign_form_1").append("<option value='"+obj.username+"'>"+obj.fullname+"</option>");
                  }); 

                  }); 

              });
               //FILTER DIVISION ON ISSUED TO DROP-DOWN

                //TRANSFER FILTER DIVISION ON ISSUED TO DROP-DOWN
              $("#transfer_select_division").on('change', function() {
              $.getJSON( "{{ url('get/division') }}/"+this.value, function( datajson ) {
                         $("#transfer_propassign_form").empty();
                      jQuery.each(datajson,function(i,obj){
                            $("#transfer_propassign_form").append("<option value=''>Select a Staff</option>");
                            $("#transfer_propassign_form").append("<option value='"+obj.username+"'>"+obj.fullname+"</option>");
                           
                  }); 

                  }); 

              });
               //TRANSFER DIVISION ON ISSUED TO DROP-DOWN
           $('.hidden_component').css('display', 'none');
              
            $('#editEquipment').on('hidden.bs.modal', function () {
            location.reload();
            });


               //propQuantityCheck();
               hideElements();
            
            //Hide Number Input
            $('#categoryHidden').hide();
            $('#subcategoryHidden').hide();

            $("#propassign_form_1").on('change', function() {
      $("#getstaffname").val(this.value);
      });


             //Division Drop-Down
            $.getJSON( "{{ url('json/division/all') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                            $("#select_division").append("<option value='"+obj.division_acro+"'>"+obj.division_acro+"</option>");
                               $("#transfer_select_division").append("<option value='"+obj.division_acro+"'>"+obj.division_acro+"</option>");
                            // $("#update_select_division").append("<option value='"+obj.division_acro+"'>"+obj.division_acro+"</option>");
                  }); 

            }); 





        //DELETE ROW in the DataTable
       window.deleteRow = function(id){
       var table = $('#bootstrap-data-table').DataTable();


         $('#bootstrap-data-table tbody').on( 'click', 'deleterow', function () {
         table.row( $(this).parents('tr')).remove().draw();} );
        }

     
         
         //START INDIVIDUAL COMPONENT CLASSIFICATION
          var ctr=0;
          $('#addComponents').click(function (e) {
                ctr += 1;
                    e.stopPropagation();
               // console.log(ctr);
                 $("#delComponents").click(function (e) {// Preserve other event handlers if any.
                     ctr -= 1;
                       });
          //ADD CLASS

      
        window.getClass = function(id){
          var subcattext = $("option:selected", "#equip_subcat_1").text();
        
               $.getJSON( "{{ url('json/showcategory') }}/"+id, function( datajson ) {
              }).done(function(datajson) {
             

          //LOAD JSON CLASS
                    jQuery.each(datajson,function(i,obj){
                        $("#category").text(obj.class_description);
                        // $("#prop_class_"+ctr+"").val(obj.class_description);
                        // $("#getSubcategory_"+ctr+"").val(obj.subclass_description);
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
        window.addComponents = function(id){
        var del_btn = "";

        
         if(id != 0)
        {
             var proctr=0;
             var proassignctr=0;
             var ctr=0;
             del_btn = "<a href='#' id='delComponents' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
             proctr -= 1;
             proassignctr -= 1;
             ctr -=1;
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
        if ($('#propassign_form_1').val() != ''){
          var propassign_formvar = $("#propassign_form_1 option:selected").text();
        }      
      
           //COMPONENT TEXT-INPUT NEWER
         $("#tbl_components_"+id+" tr:last").after("<tr><td><input style='font-size:12px;' type='text' class='form-control' name='prop_class[]' id='prop_class_"+proctr+"'></td><td><select onchange='getClass(this.value)' style='font-size:12px;' name='equip_subcat[]' id='equip_subcat_"+proassignctr+"' class='form-control prop_assign_ctr'><option value='' selected>--Select--</option></select></td><td><input style='font-size:12px;' type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_"+proctr+"'></td><td><input style='font-size:12px;' type='number' class='form-control' value='1' name='component_quantity[]' id='component_quantity_"+proctr+"'></td><td><input style='font-size:12px;' type='text' class='form-control' name='equip_subprop_num[]' value='"+proctr+"'></td><td><input style='font-size:12px;' type='text' class='form-control' name='equip_serial_num[]' id='equip_serial_num_"+proctr+"' value=''></td><td>"+del_btn+"</td></tr>");

           $("#equip_subcat_"+proassignctr+"").select2({
                 dropdownParent: "#tbl_components_"+id+" tr:last",
                 closeOnSelect: true,
                 width: '100%',

                    });

             //DELEGATE ON CHANGE 
             $(document).on("change", "#equip_subcat_"+proassignctr+"", function(){
              $.getJSON( "{{ url('json/showcategory') }}/"+this.value, function( datajson ) {
              }).done(function(datajson) {
             
          //LOAD JSON CLASS
                    jQuery.each(datajson,function(i,obj){
                        $("#category").text(obj.class_description);
                        $("#prop_class_"+proassignctr+"").val(obj.class_description);
                        $("#getSubcategory_"+proassignctr+"").val(obj.subclass_description);
                        $("#categoryHidden").val(obj.class_description);
                        $("#subcategoryHidden").val(subcattext);

                     });
                 
            }).fail(function() {
               alert(Error);
            });
             });
             //DELEGATE ON CHANGE 


         $("#tbl_components_"+id+" tr:last").after("<input type='hidden' name='getSubcategory[]' id='getSubcategory_"+proctr+"'  class='form-control'>");

          
         $.getJSON( "{{ url('json/employees/all') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                            $("#prop_assign_"+proassignctr).append("<option value='"+obj.fullname+"'>"+obj.fullname+"</option>");

                  }); 

            }); 


         $.getJSON( "{{ url('json/subcategory/all') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                            $("#equip_subcat_"+proassignctr).append("<option value='"+obj.classification_id+"'>"+obj.description+"</option>");
                            
                   }); 
                   

            }); 
        }

        //GET DIVISION
          window.getDivision = function(empcode){
                $.getJSON( "{{ url('get/users') }}/"+empcode, function( datajson ) {
              }).done(function(datajson) {
          //LOAD JSON CLASS
                    jQuery.each(datajson,function(i,obj){
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


      //DELETE COMPONENTS
      window.delComponents = function (id){
        var ctr=0;
        var whichtr = $(id).closest("tr");
        whichtr.remove();
        ctr-=1;
      }
     
     
    function hideElements()
    {

            $( "#prop_umeasure" ).change(function(){
            if($("#prop_umeasure").val()=="unit")
            {
                //$(".replace-tab-text").text("Unit");
                $(".hide-label").show();
          
            }else if($("#prop_umeasure").val()=="set")
            {
                 /// $(".replace-tab-text").text("Set");
                  $(".hide-label").show();
                }
            });

    }


    
    function resetTab()
    {   
     
var propassign_formvar = $("#propassign_form_1").val();
$("#nav-tab").empty().append('<a class="replace-tab-text nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#sub-item-1" role="tab" aria-controls="nav-home" aria-selected="false">Set 1</a>');

$("#nav-tabContent").append('<div class="tab-pane fade show" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab"><div class="card"><div class="card-body"><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div><div class="col-12 col-md-6"><input type="text" name="prop_num[]" id="prop_num_1" class="form-control propassignformctr" value="" required></div></div><div class="row form-group"><div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div><div class="col-12 col-md-6"><input type="text" name="prop_total_val[]" id="prop_total_val_1" class="form-control" value="" required></div></div><div class="row form-group"><div class="col-12 col-md-2 "><label for="text-input" class="form-control-label">Issued To</label></div><div class="col-12 col-md-6"><select name="propassign_form[]" id="propassign_form_1" data-placeholder="Select a Staff" class="form-control propassign_ctr" required><option value="'+propassign_formvar+'" selected>'+propassign_formvar+'</option></select></div></div><div class="hide-label"><h7>Add Components <a href="#" class="btn btn-primary btn-sm" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br/><br/><table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px"><thead><th style="width:20%">Component Name</th><th style="width:50%">Serial No.</th><th style="width:2%">Date Issued</th><th style="width:100%">Issued To</th><th style="width:2%"></th></thead></table></div></div></div>');
         // hideElements(); 
    }


          var t = $('#bootstrap-data-table').DataTable( {
        dom: 'Bfrtip',
      processing: true,
       buttons: [
                            {
                                extend: 'excel',
                                text: 'Export to Excel',
                                className: 'btn-primary',
                                exportOptions: {
                                    modifier: {
                                        page: 'current'
                                    }
                                }
                            }
                        ]

             } );


             


          jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });

          $.getJSON( "{{ url('json/componentsall/all') }}", function( datajson ) {
                      t.row.add( [
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                     '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>',
                                    '<center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center>'
                            ] ).draw( false );     
            }).done(function(datajson){
                t.clear().draw();
                jQuery.each(datajson,function(i,obj){
                        t.row.add( [
                                    "",
                                    obj.component_classification,
                                   "<div style='height:200px; width:130px; overflow-x:auto;'>"+obj.component_name+"</div>",
                                    obj.property_number,
                                    obj.value,
                                    obj.quantity,
                                    obj.quantity,
                                    "-",
                                    "-",
                                    obj.remarks

                            ] ).draw( false );  
                  }); 

                      t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            }).fail(function() {
                alert("Error loading data! Page reloading, please wait...")
                location.reload();
            });


        } );

 function editEquipmentdetails(id)
{
       window.updategetClass = function(id){
          var subcattext = $("option:selected", "#update_prop_subcat").text();
               $.getJSON( "{{ url('json/showcategory') }}/"+id, function( datajson ) {
              }).done(function(datajson) {
      
                    jQuery.each(datajson,function(i,obj){
                        $("#update_category").text(obj.class_description);
                        $("#update_prop_class").val(obj.class_description);
                        $("#update_subcategoryHidden").val(subcattext);
                        $("#update_categoryHidden").val(obj.class_description);
                     });
                 
            }).fail(function() {
               alert(Error);
            });
            };



   $.getJSON( "{{ url('get/components') }}/"+ id, function( datajson ) {
    
            }).done(function(datajson){
                jQuery.each(datajson,function(i,obj){
                $("#update_equipment_id").val(obj.id);
                $("#update_categoryHidden").val(obj.component_classification);
                $("#update_subcategoryHidden").val(obj.component_subclass);
                $("#update_category").text(obj.component_classification);
                $("#update_prop_subcat").val(obj.subclass_id);
                $("#update_prop_desc").val(obj.component_name);
                $("#update_serial_num").val(obj.serial_num);
                $("#update_division").val(obj.division);
                $("#update_position").val(obj.position);
                $("#update_fullname").val(obj.issued_to);

                $("#update_prop_quantity").val(obj.quantity);
                $("#update_subprop_num").val(obj.component_subpropertynumber);

                 $("#update_par_num").val(obj.par_number);
                 
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
                
                $("#update_propassign_form").text(obj.issued_to);
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

function transferEquipment(id)
{
     $.getJSON( "{{ url('get/components') }}/"+ id, function( datajson ) {
    
            }).done(function(datajson){
                jQuery.each(datajson,function(i,obj){
                $("#transfer_equipment_id").val(obj.id);

             
            });
            }).fail(function() {
                alert("Error loading data! Page reloading, please wait...")
                location.reload();
            });

$("#transferEquipment").modal("toggle");

}

 function acceptEquipment(id)
     {
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
          window.location.href = "{{ url('accept-equipment') }}/"+id;
        }
      })
     }

      function revertEquipment(id)
     {
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
          window.location.href = "{{ url('revert-equipment') }}/"+id;
        }
      })
     }

       function disposeEquipment(id)
     {
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
          $.getJSON( "{{ url('get/components') }}/"+ id, function( datajson ) {
    
            }).done(function(datajson){
                jQuery.each(datajson,function(i,obj){
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
     
     // function disposeEquipment(id)
     // {

     //  Swal.fire({
     //    title: 'Are you sure?',
     //    text: "Dispose the equipment.",
     //    icon: 'success',
     //    showCancelButton: true,
     //    confirmButtonColor: '#3085d6',
     //    cancelButtonColor: '#d33',
     //    confirmButtonText: 'Yes, dispose the equipment.'
     //  }).then((result) => {
     //    if (result.value) {
     //    //CODE IF CONFIRMED
     //   $('#disposeEquipmentForm').submit();
     //    //CODE IFCONFIRMED
     //    }
     //  })
     // }
        
        
     function deleteEquip(id)
     {
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
          window.location.href = "{{ url('admin/delete-equipment') }}/"+id;
        }
      })
     }


     function generatePAR(equip_id)
     {
      window.open("{{ url('generate-pdf-par') }}/"+equip_id);
     }


     function generatePropertyCard(equip_id)
     {
      window.open("{{ url('generate-pdf-propcard') }}/"+equip_id);
     }


     function generateRPCPPE()
     {

       $("#generateRPCPPE").modal("toggle");
      // window.open("{{ url('generate-pdf-rpcppe/') }}/"+date);
     }


     function updateValues()
     {
      var date1 = $('#date_from').val();
      var date2 = $('#date_to').val();

      generatePDFRPCPPE(date1, date2);
     }

     
     function generatePDFRPCPPE(date1, date2)
     {

      // var date1 = $('#date_from').val();

      alert(date1+' '+date2);

      // window.open("{{ url('generate-pdf-rpcppe/all') }}");

     }
    </script>

@endsection
