@extends('layouts.master')

@section('addCSS')
@endsection

@section('content-title')
        Change Password
@endsection

@section('content')

 <form method="POST" id="changepassword" action="{{ url('change-password') }}" enctype="multipart/form-data">
      @csrf

            <input type="hidden" name="frm_url_action" id="frm_url_action" value="{{ url('change-password-send') }}">
            <input type="hidden" name="frm_url_reset" id="frm_url_reset" value="{{ url('change-password') }}">

               <input type="hidden" name="user_id" id="user_id" value="">

                                                          <div class="row form-group" style="padding-left:10px; padding-top:10px; padding-right:900px;">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Password</label></div>
                                                            <div class="col-12 col-md-10">
                                                                <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                                                            </div>
                                                          </div>

                                                             <div class="row form-group" style="padding-left:10px; padding-top:10px; padding-right:900px;">
                                                            <div class="col col-md-2"><label for="text-input" class=" form-control-label" >Confirm Password</label></div>
                                                            <div class="col-12 col-md-10">
                                                                <input type="password" name="password2" id="password2" class="form-control" autocomplete="off" required>
                                                            </div>
                                                          </div>
                                                       
                                        <p align="right" style="padding-right:900px;"> 
                                          <!-- <button id="submit" type="button" name="btn-edit" id="btn-edit" class="btn btn-primary btn-lg">Save</button> -->
                                                  <p align="left"><a href="javascript:void(0)" class="btn btn-primary" onclick="checkPassword()">Save Password</a></p>
                                    </form>
                           


@endsection

@section('addJS')
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
<script type="text/javascript">
$( document ).ready(function() {

                
});
function checkPassword(event)
    {
        var error = false;
        var error_msg = "";


        if($("#password").val() != $("#password2").val())
        {
            error_msg += "Password does not match<br/>";
            error = true;
        }

        // if($("#password").val().length < 8)
        // {
        //     error_msg += "Password length must be 8 or higher<br/>";
        //     error = true;
        // }

        if(error)
        {
            swal.fire("Error!", error_msg, "warning");
        }
        else
        {
            swal.fire("Success!", error_msg, "success");
            $("#changepassword").submit();

        }
    }

 


</script>
@endsection
