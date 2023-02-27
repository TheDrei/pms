<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
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
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <img class="align-content" src="{{ asset('sufee-admin-dashboard-master/images/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                             @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
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
                        <center><button type="submit" class="btn btn-success btn-flat m-b-20 m-t-20" style="width: 50%">Sign in</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('sufee-admin-dashboard-masterassets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-masterassets/js/popper.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-masterassets/js/plugins.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-masterassets/js/main.js') }}"></script>


</body>
</html>
