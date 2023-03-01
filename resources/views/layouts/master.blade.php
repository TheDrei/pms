<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title >PMS</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    @yield('addCSS')
    <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/scss/style.css') }}">
    <link href="{{ asset('sufee-admin-dashboard-master/assets/css/fonts.css') }}" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('sweetalert2/src/sweetalert2.scss') }}">


    <style>
/* SCROLLBAR STYLE */
  ::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #003763; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
/* END SCROLLBAR */

.right-panel .page-header h1 {
  font-weight: bold;
}

.navbar .navbar-nav li.menu-item-has-children.show .sub-menu {
    background-color: #073372;
}

.navbar .menu-title {
color:white!important;

}

.navbar .navbar-brand {
    border-bottom: none!important;
    color: #f1f2f7 !important;
}

.navbar .navbar-header {
   
    background-color: #073372;
}

.navbar .navbar-brand img {
    max-width: 145px;
}

.open .menutoggle i:before {
    content: "\f138"!important;
}

</style>  
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>

       
    <aside id="left-panel" class="left-panel" style="background-color:#003763;">
        <nav class="navbar navbar-expand-sm navbar-default">

            <input name="auth" id="auth" type="hidden" value="{{ Auth::user()->username }}">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a style="background-color:#003763;" class="navbar-brand" style="border-bottom:none!important;" href="#"><img src="{{ asset('sufee-admin-dashboard-master/images/pms-logo.png') }}" alt="Logo"></a>
                <a style="background-color:#003763;" class="navbar-brand hidden" href="./"><img src="{{ asset('sufee-admin-dashboard-master/images/logo2.png') }}" alt="Logo"></a>
            </div>

            @include('layouts.nav')
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left" style="background-color:#8dc73c;"><i class="fa fa-tasks"></i></a>
                    <div class="header-left">
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('sufee-admin-dashboard-master/images/admin.jpg') }}" alt="User Avatar">
                        </a>

                           <div style="color:#0077bb; font-weight: bold; width:250px; font-size:16px; padding-top:7px; padding-left:100px;">{{ Auth::user()->lname }}, {{ Auth::user()->fname }}</div> 
                                   
                        <div class="user-menu dropdown-menu">

                              <!--   <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a> -->

                              <!--   <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power -off"></i>
                                        {{ __('Logout') }}
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

   

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>@yield('content-title')</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
     @yield('content')
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
  
    <!-- Right Panel -->
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/uikit.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/uikit-icons.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/main.js') }}"></script>
    <script src="{{ asset('sweetalert2/src/sweetalert2.all.min.js') }}"></script>
    @include('layouts.sweetalert2')
    @yield('addJS')
    @include('layouts.ajaxpost')

</body>
   
</html>

    <script type="text/javascript">

        $( document ).ready(function() {
        var username = $("#auth").val();
        if(username == 'LAN004')
        {
          $('#customhide').hide(); 
        }

        });
       
    </script>    

