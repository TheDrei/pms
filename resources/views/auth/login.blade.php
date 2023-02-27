<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - PMS</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/cs-skin-elastic.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/scss/style.css') }}">
    <link href="{{ asset('sufee-admin-dashboard-master/assets/css/fonts.css') }}" rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<style>
body 
{
    font-family: Verdana, Arial, sans-serif;
    font-size: 14px;
}

.input-group-text
{
  border-radius:30px;
}

</style>    
<body style="background-image: url('sufee-admin-dashboard-master/images/login-bg.jpg');  background-position: center;   background-attachment: fixed;  background-size: 100% 100%;">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <!-- <a href="#">
                        <img style="width:300px;" class="align-content" src="{{ asset('sufee-admin-dashboard-master/images/pms-logo.png') }}" alt=""><br/>
                    </a> -->
               
                    <br/>
<!-- 
                <div class="login-form" style="border-radius:14px;">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-group">
                            <label style="text-transform: capitalize; font-weight: bold;">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                             @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label style="text-transform: capitalize; font-weight: bold;">Password</label>
                            <input type="password" class="form-control" name="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>

                        </div>
                        <center><button type="submit" class="btn btn-primary btn-flat m-b-20 m-t-20" style="width: 30%; border-radius:14px; font-weight:bold; text-transform:capitalize; background-color:#003763;">Log-In</button></center>
                    </form>
                </div> -->


                <div class="login-box" style="width:490px;">
                    <div class="card-header text-center" style="border:none;">
                    <div class="login-logo">     
                        <img src="{{ asset('img/pcaarrd.png') }}" width="18%"/>                                  
                        <p style="color:white;font-weight: bold;margin-bottom: 0px;"><strong>DOST-PCAARRD</strong></p>
                        <h1 style="font-weight: bold; font-size:40px; color: #a5d5f5;margin-bottom: 0px;text-shadow: 1px 1px 3px rgb(0,0,0,0.3)">
                            Property <br/>
                        <span style="font-size:35px; font-weight: bold;color: #fff;text-shadow: 1px 1px 3px rgb(0,0,0,0.3);">
                       <strong>Management System</strong>
                        </span></h1>
                    </div>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('login') }}"  aria-label="{{ __('Login') }}">
                    @csrf
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" name='username' id='username' placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span style="color:grey;" class="fa fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" name='password' id='password' placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span style="color:grey;" class="fa fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-4">
                            <div class="">
                            <input type="checkbox" id="remember">
                            <label for="remember" class="text-white">
                            &nbsp;Remember Me
                            </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <p class="col-4">
                            <!-- <a class="text-white" href="#">Forgot password?</a> -->
                        </p>
                        <br/>
                        
                        <div class="col-12">
                        <center>
                            <button type="submit" style="background-color:#2684c3; border-radius:14px;" class="btn btn-primary btn-block">Log In</button>
                            </center>
                        </div>
                        <br/>    <br/>    <br/>
                
                        </div>
                    </form>
                    <!-- Plans & Accomplishments Description -->
                    <!-- <p>
                        <a class="text-white" href="#"><strong>The Plans & Accomplishments System</strong> lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</a>
                    </p> -->
                    </div>

</div>

 </div>
<div class="login-form" style="border-radius:14px; background: #003763;">
                <div style="color:white; text-align:justify;">The <strong >Property Management System</strong> standardizes the process in acquisition, utilization and disposal of properties and equipment of PCAARRD and ensure compliance to standards and procedures prescibed by governing laws, COA Resolutions, DBM Circulars and other policies.</div>
                </div>
               
            </div>
        </div>
    </div>
</body>
<footer class="main-footer" style="color:white; text-align:center; font-size:13px;">Copyright © 2021. PCAARRD Property Management System. <br/>All Rights Reserved. Best viewed in Google Chrome.</footer>
</html>

@if(session()->has('error'))
        <script>
        $(document).Toasts('create', {
          class: 'bg-danger',
          autohide: true,
          close: false,
          delay: 2000,
          position: 'topRight',
          title: 'Failed to Login',
          icon: 'fas fa-exclamation-triangle',
          body: 'Credentials do not match with our records. Please check your <strong>username</strong> or <strong>password</strong>.'
        })
        </script>
@endif 
