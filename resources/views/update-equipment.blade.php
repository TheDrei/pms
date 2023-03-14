@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">

@endsection

@section('content-title')
    Update Equipment
@endsection

@section('content')



  <form method="PUT" name="frm" id="frm" enctype="multipart/form-data">
  <!-- <form method="POST" name="frm2" id="frm2" action="{{ url('update-equipment')}}"> -->

                            @csrf
                             <input type="hidden" name="equipment_id" id="equipment_id" value="{{ $data['equipment_data']['id'] }}">
                             <input type="hidden" name="equipment_sets" id="equipment_sets" value="{{ $data['equipment_sets']['equip_id'] }}">    
                             <input type="hidden" name="equipment_sets_components" id="equipment_sets_components" value="{{ $data['equipment_sets_components']['equip_id'] }}">                                
                            

                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Equipment Details</a>
                                               
                                                <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">END USER</a> -->
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                               <div class="card">
                                            
                                              <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class="form-control-label">Classification</label></div>
                                    <div class="col-12 col-md-6">
                                        <b><span id="category" name="category" value="">{{ $data['equipment_data']['prop_cat'] }}</span></b>
                                         <input type="text" id="categoryHidden" name="categoryHidden" value="{{ $data['equipment_data']['prop_cat'] }}">
                                         <input type="text" id="subcategoryHidden" name="subcategoryHidden" value="{{ $data['equipment_data']['prop_subcat'] }}">
                                    </div>
                                  </div>

                        <div class="row form-group" style="padding-left:10px;">
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Sub-Classification</label></div>
                                    <div class="col-12 col-md-6">
                                        <select name="prop_subcat" id="prop_subcat" data-placeholder="Choose a Classification..." class="form-control" onchange="getClass(this.value)" required>
                                            <option value="{{ $data['equipment_data']['prop_subcat'] }}" selected>{{ $data['equipment_data']['prop_subcat'] }}</option>

                                           <?php
                                                foreach ($data['viewclassification'] as $value) {
                                                    # code...
                                                  //  echo "<optgroup label='".$value->description."'>";
                                                    foreach ($data['viewclassification'] as $val) {
                                                        if($value->subclass_id == $val->subclass_id)
                                                        {
                                                            echo "<option value='".$val->subclass_id."'>".$val->subclass_description."</option>";
                                                        }
                                                    }
                                                    echo "</optgroup>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                  </div>

              <div class="row form-group" style="padding-left:10px;">
              <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Item Description</label></div>
               <div class="col-12 col-md-10">
              <textarea style="width:755px; height:100px;" class="form-control" name='prop_desc' id="prop_desc" autocomplete="off" required>{{ $data['equipment_data']['prop_desc'] }}</textarea>
              </div>
               </div>


                           <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Quantity</label></div>
                                    <div class="col-12 col-md-5">
                                        <input style="width:100px;" type="number" value="{{ $data['equipment_data']['prop_quantity'] }}" name="prop_quantity" min="1" max="10" id="prop_quantity" class="form-control"  required>
                                    </div>
                                  </div>


                                  <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Unit of Measure</label></div>
                                    <div class="col-12 col-md-6">
                                        <select name="prop_umeasure" id="prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="form-control" required>
                                            <option value="unit">unit</option>
                                            <option value="set">set</option>
                                        </select>
                                    </div>
                                  </div>

                                     <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Delivered</label></div>
                                    <div class="col-12 col-md-6">
                                        <input type="date" name="date_delivered" id="date_delivered" class="form-control" value="{{ $data['equipment_data']['date_delivered'] }}"  required>
                                    </div>
                                  </div>

                                  <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Inspected</label></div>
                                    <div class="col-12 col-md-6">
                                        <input type="date" name="date_inspected" id="date_inspected" class="form-control"  value="{{ $data['equipment_data']['date_inspected'] }}"required>
                                    </div>
                                  </div>

                                  <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Accepted</label></div>
                                    <div class="col-12 col-md-6">
                                        <input type="date" name="date_accepted" id="date_accepted" class="form-control"  value="{{ $data['equipment_data']['date_accepted'] }}"required>
                                    </div>
                                  </div>
                                
                                  <div class="row form-group" style="padding-left:10px;">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Date Acquired</label></div>
                                    <div class="col-12 col-md-6">
                                        <input type="date" name="date_acquired" id="date_acquired" class="form-control" value="{{ $data['equipment_data']['date_acquired'] }}"required>
                                    </div>
                                  </div>


                          <div class="card">
                                <div class="card-header">
                               
                            
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="replace-tab-text nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#sub-item-1" role="tab" aria-controls="nav-home" aria-selected="true">Set 1</a>
                  </div>
              </nav>

              <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                <div class="tab-pane fade show active" id="sub-item-1" role="tabpanel" aria-labelledby="nav-home-tab">
                         <div class="row form-group">
                          <div class="col col-md-2"><label for="text-input" class=" form-control-label">Property No.</label></div>
                        <div class="col-12 col-md-6">
                           <input type="text" name="prop_num[]" id="prop_num_1" class="form-control" value="{{ $data['equipment_sets']['prop_num'] }}" autocomplete="off" required>
                       </div>
                        </div>

                    <div class="row form-group">
                 <div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div>
                  <div class="col-12 col-md-6">
                 <input type="number" name="prop_total_val[]" id="prop_total_val_1" class="form-control" value="{{ $data['equipment_sets']['prop_val'] }}" autocomplete="off" required>
                </div>
                </div>

                    <div class="row form-group">
                                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Issued To</label></div>
                                    <div class="col-12 col-md-6">
                                        <select name="propassign_form[]" id="propassign_form_1" data-placeholder="Select a Staff" class="form-control" required>
                                            <option value="{{ $data['equipment_sets']['equip_issued_to'] }}" selected>{{ $data['equipment_sets']['equip_issued_to'] }}</option>
                                        </select>
                                    </div>
                                  </div>

                                   <div class="row form-group">

                                 
                                   <div class="hide-label">    
                                <h7>Add Components <a href="#" class="btn btn-primary btn-sm" id="addComponents" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7><br/><br/>
                                 <table class="table table-condensed" id="tbl_components_1" width="100%" style="font-size: 12px">
                                 <thead>
                                        <th style="width:20%">Component Name</th>
                                        <th style="width:20%">Value</th>
                                        <th style="width:10%">Quantity</th>
                                        <th style="width:20%">Serial No.</th>
                                        <th style="width:2%">Date Issued</th>
                                        <th style="width:100%">Issued To</th>
                                        <th style="width:20%"></th>
                                    </thead>
                                </table>

                                </div>

                                 </div>
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
                                        <!-- <input type="submit" name=""> -->
                                        </form>

                                        <p align="left" style="padding-right:300px;"> 
                                          <button id="btnsave" class="btn btn-primary btn-lg" onclick="ConfirmActionFrm('frm','{{ url("update-equipment")}}')">Save</button> &nbsp 
                                          <a href="javascript:history.back()" class="btn btn-danger btn-lg">Cancel</a></p>


                                    
@endsection

@section('addJS')
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
<!--UPDATE SCRIPT -->
<script type="text/javascript">
  
    
  $(document).ready(function(){
       
       if ($.isArray('#prop_component')){
         alert("Not an array");
        }else{
           showComponents();

        }
 // $("#tbl_components_1").after('<tr><td> <input type="text" class="form-control prop_component_ctr" value="123" name="prop_component" id="prop_component"></td><td>');

     window.getClass = function(id){
          var subcattext = $("option:selected", "#prop_subcat").text();
          //LOAD JSON CLASS
          //console.log(id);
         
          $.getJSON( "{{ url('json/showcategory') }}/"+id, function( datajson ) {
              }).done(function(datajson) {
                    jQuery.each(datajson,function(i,obj){
                        $("#category").text(obj.class_description);
                        $("#categoryHidden").val(obj.class_description);
                        $("#subcategoryHidden").val(subcattext);
                       
                    });
            }).fail(function() {
               alert(Error);
            });
          //END LOAD JSON SUB-CLASS
        }

      //ADD COMPONENTS BUTTON
       window.addComponents = function(id){
       var del_btn = "";
       var propnum = $("#prop_num_1").val();
       var propassign_formvar = $("#propassign_form_1").val();
       var proctr = 0 + ($(".prop_component_ctr").length);
       var proassignctr = 1 + ($(".prop_assign_ctr").length);

         if(id != 0)
        {
     
             del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        }

    
       //Check empty fields
        if ($('#propassign_form_1').val() != ''){
          var propassign_formvar = $("#propassign_form_1 option:selected").text();
        } 
      //End Check

        $("#tbl_components_"+id+" tr:last").after("<tr><td> <input type='text' class='form-control prop_component_ctr' name='prop_component[]' id='prop_component_"+proctr+"'></td><td><input type='number' class='form-control' name='component_value[]' id='component_value_"+proctr+"'></td><td><input type='number' class='form-control' name='component_quantity[]' id='component_quantity_"+proctr+"' value='1'></td><td><input type='text' class='form-control' name='equip_serial_num[]' value='"+propnum + "-" + proctr +"'></td><td><input type='date' name='equip_date_issued[]' class='form-control'></td><td><select name='prop_assign[]' id='prop_assign_"+proassignctr+"' class='form-control prop_assign_ctr'><option value='"+propassign_formvar+"' selected>"+propassign_formvar+"</option></select></td><td>"+del_btn+"</td></tr>");


         $.getJSON( "{{ url('json/employees/all') }}", function( datajson ) { 
                      jQuery.each(datajson,function(i,obj){
                            $("#prop_assign_"+proassignctr).append("<option value='"+obj.fullname+"'>"+obj.fullname+"</option>");
                  }); 

            }); 
        }
      //END ADD COMPONENTS


      //DELETE COMPONENTS
      window.delComponents = function (id){
        var whichtr = $(id).closest("tr");
        whichtr.remove();

      }
     
        $.getJSON( "{{ url('json/employees/all') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                            $("#propassign_form_1").append("<option value='"+obj.fullname+"'>"+obj.fullname+"</option>");
                  }); 

            }); 
     //END COMPONENTS

     //CODE START FOR SHOWING COMPONENTS
   function showComponents (id) {
     var equipment_id = $("#equipment_id").val(); 
     var del_btn = "";
     var propnum = $("#prop_num_1").val();
     var propassign_formvar = $("#propassign_form_1").val();
     var id = 1;
         
        if(id != 0)
        {
     
             del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delComponents(this)'><i class='fa fa-close'></i></a>";
        }
               
       
                       $.getJSON( "{{ url('json/components') }}/"+equipment_id, function( datajson ) {
                      })
                       .done(function(datajson) 
                      {
                         var objects = datajson.filter(function(n){return n.equip_id==equipment_id});
                        
                      for (var ctr = 0; ctr < objects.length; ctr++) 
                      {
                       
                       $("#tbl_components_1 tr:last").after("<tr><td> <input type='text' class='form-control prop_component_ctr' value='"+objects[ctr].component_name+"' name='prop_component[]' id='prop_component_"+ctr+"'></td><td><input type='number' class='form-control' name='component_value[]' id='component_value_"+ctr+"' value='"+objects[ctr].value+"'></td><td><input type='number' class='form-control' name='component_quantity[]' id='component_quantity_"+ctr+"' value='"+objects[ctr].quantity+"'></td><td><input type='text' class='form-control' id='equip_serial_num_"+ctr+"' name='equip_serial_num[]' value='"+objects[ctr].serial_num+"'></td><td><input type='date' value='"+objects[ctr].date_issued+"' name='equip_date_issued[]' id='equip_date_issued_"+ctr+"' class='form-control'></td><td><select name='prop_assign[]' id='prop_assign_"+ctr+"' class='form-control prop_assign_ctr'><option value='"+objects[ctr].issued_to+"' selected>"+objects[ctr].issued_to+"</option></select></td><td>"+del_btn+"</td></tr>");

                          $.getJSON( "{{ url('json/employees/all') }}", function( datajson ) { 
                             for (var ctr = 0; ctr < objects.length; ctr++) {
                            jQuery.each(datajson,function(i,obj){
                            $("#prop_assign_"+ctr).append("<option value='"+obj.fullname+"'>"+obj.fullname+"</option>");
                            });} 
                            });
                        }
                    
                      });     


         }  
    //CODE END FOR SHOWING COMPONENTS           

    $("#subcategoryHidden").hide();
    $("#categoryHidden").hide();
   // $('#prop_cat').select2();
    //$('select').val("{{ $data['equipment_data']['prop_cat'] }}");
    $("#category").val("{{ $data['equipment_data']['prop_cat'] }}");
    $("#categoryHidden").val("{{ $data['equipment_data']['prop_cat'] }}");
    $("#prop_umeasure").val("{{ $data['equipment_data']['prop_umeasure'] }}");

    $("#prop_subcat").val("{{ $data['equipment_data']['prop_subcat'] }}");
   // $("#date_delivered").val("{{ $data['equipment_data']['date_delivered'] }}");


  //  $("option:selected", "#propassign_form_1").val("{{ $data['equipment_sets']['equip_issued_to'] }}");
   // $("#prop_total_val_1").val("{{ $data['equipment_sets']['prop_val'] }}");
    //$("#prop_num_1").val("{{ $data['equipment_sets']['prop_num'] }}");

  
     // Select the option with a value of 'US'
    $('select').trigger('change'); // Notify any JS components that the value changed

    // jQuery(".standardSelect").chosen({
  //               disable_search_threshold: 10,
  //               no_results_text: "Oops, nothing found!",
  //               width: "100%"
  //           });

  });

</script>
<!-- END UPDATE SCRIPT -->

@endsection
