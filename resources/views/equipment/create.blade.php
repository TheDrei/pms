@extends('layouts.master')

@section('addCSS')
@endsection

@section('content-title')
		UPDATE INVENTORY
@endsection

@section('content')
<nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DETAILS</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">END USER</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                               <div class="card">
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
                                               
                                            </div>
                                        </div>

@endsection

@section('addJS')
<script type="text/javascript">

</script>
@endsection
