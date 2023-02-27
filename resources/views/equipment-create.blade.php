@extends('layouts.master')

@section('addCSS')
@endsection

@section('content-title')
        ADD NEW EQUIPMENT
@endsection

@section('content')
<nav>                                   <form method="POST" action="{{ url('save-equipment') }}" enctype="multipart/form-data">
                                        @csrf
                                        <p align="right">
                                            <button type="submit" class="btn btn-primary"> SAVE </button>
                                            <a href="{{ url('admin/equipment/all') }}" class="btn btn-danger"> CANCEL </a>
                                        </p>


                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DETAILS</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">END USER</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                               <div class="card" style="border:none">
                                                        <div class="card-body">
                                                            <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Category</label></div>
                                                            <div class="col-12 col-md-6">
                                                                <select name="prop_cat" id="prop_cat" data-placeholder="Choose a Category..." class="standardSelect" required>
                                                                    <option value='' disabled selected>----Select----</option>
                                                                    <?php
                                                                        foreach ($data['categories'] as $value) {
                                                                            # code...
                                                                            echo "<optgroup label='".$value->cat_desc."'>";
                                                                            foreach ($data['subcategories'] as $val) {
                                                                                if($value->id == $val->cat_id)
                                                                                {
                                                                                    echo "<option value='".$val->subcat_id."'>".$val->_desc."</option>";
                                                                                }
                                                                            }
                                                                            echo "</optgroup>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                          </div>


                                   <!-- February 26, 2020
                                       Drei Cambay 
                                       Changes Made: 
                                       1. Added Unit of Measure drop down selection box  -->
                                  <div class="row form-group">
                                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">Unit of Measure</label></div>
                                    <div class="col-12 col-md-6">
                                        <select name="prop_umeasure" id="prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="standardSelect" required>
                                            <option value='' disabled selected>----Select----</option>
                                            <option value="unit">unit</option>
                                            <option value="set">set</option>
                                        </select>
                                    </div>
                                  </div>
                                  <!-- End of Select code  -->

                                                          <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Title</label></div>
                                                            <div class="col-12 col-md-10">
                                                                <input type="text" name="prop_title" id="prop_title" class="form-control" autocomplete="off" required>
                                                            </div>
                                                          </div>

                                                          <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Description</label></div>
                                                            <div class="col-12 col-md-10">
                                                                <textarea class="form-control" name='prop_desc' id="prop_desc" autocomplete="off" required></textarea>
                                                            </div>
                                                          </div>

                                                          <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Property #</label></div>
                                                            <div class="col-12 col-md-6">
                                                                <input type="text" name="prop_num" id="prop_num" class="form-control" autocomplete="off" required>
                                                            </div>
                                                          </div>

                                                          <div class="row form-group">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Value</label></div>
                                                            <div class="col-12 col-md-6">
                                                                <input type="text" name="prop_total_val" id="prop_total_val" class="form-control" autocomplete="off" required>
                                                            </div>
                                                          </div>

                                                      </div>
                                                  </div> 
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                               <div class="card">
                                                     <div class="card-body">
                                                            <h5>Assign to Staff <a href="#" onclick="addStaff(++initial_staff)" class="btn btn-primary btn-sm" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h5>
                                                            <br>
                                                            <table class="table table-condensed" id="tbl_staff" width="100%">
                                                                <thead>
                                                                    <th>Name</th>
                                                                    <th style="width:30%">Date Acquired</th>
                                                                    <th style="width:30%">Serial #</th>
                                                                    <th style="width:2%"></th>
                                                                </thead>
                                                            </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


@endsection

@section('addJS')
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
<script type="text/javascript">
var initial_staff = 0;
addStaff(0);

function addStaff(ctr) {
        
        var del_btn = "";

        if(ctr != 0)
        {
            del_btn = "<a href='#' class='btn btn-danger btn-sm' style='border-radius:100px' onclick='delStaff(this)'><i class='fa fa-close'></i></a>";
        }

         $("#tbl_staff tr:last").after("<tr><td><select name='prop_assign[]' id='prop_assign_"+ctr+"'  class='form-control'><option value='' disabled selected>--Select Staff--</option></select></td><td><input type='date' class='form-control' name='equip_date_acquired[]'></td><td><input type='text' name='equip_serial_num[]' class='form-control'></td><td>"+del_btn+"</td></tr>");
        

         $.getJSON( "{{ url('json/employees/all') }}", function( datajson ) {
                      jQuery.each(datajson,function(i,obj){
                            $("#prop_assign_"+ctr).append("<option value='"+obj.name+"'>"+obj.fullname+"</option>");
                  }); 
            });
     }

     function delStaff(obj)
     {
        var whichtr = $(obj).closest("tr");
        whichtr.remove();
     }
</script>
@endsection
