@if (Auth::user()->account_type == "Staff")
<div id="main-menu" class="main-menu collapse navbar-collapse" style="background-color:#003763;">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="{{ url('dashboard/all') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>

                   
                    <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-package"></i>Inventory<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ url('equipment/all') }}">Plant Property and Equipment</a></li>
                        <li><a href="{{ url('ics/all') }}">Semi-Expendable Supply</a></li>
                        </ul>
                   </div>

                      
                   <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-shopping-cart"></i>Procurement<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ url('annual-procurement-plan') }}">Annual Procurement Plan (APP)</a></li>
                        <li class="uk-active"><a href="{{ url('divisional-procurement-plan') }}">  Divisional Procurement Management Plan (DPPMP)</a></li>
                        </ul>
                   </div>
                 
                    
                   <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-trash"></i>Disposal<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('ppe-disposal') }}">Disposed PPE</a></li>
                        <li class="uk-active"><a href="#">Disposed Semi-Expendable Supplies</a></li>
                       
                        </ul>
                   </div>

                        <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' >
                        <ul class="uk-nav uk-dropdown-nav">
                        </ul>
                    </div>

                  
                   <li class="">
                        <a href="{{ url('change-password/all') }}"> <i class="menu-icon fa fa-gear"></i>Change Password</a>
                   </li>

                   <li class="">
                      <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="menu-icon fa fa-power-off"></i>Logout</a>
                   </li>

                   
                    <h3 class="menu-title">Documents</h3>
                    <ul uk-nav>
                    <li class="">
                        <a href="{{ url('documents') }}"> <i class="menu-icon fa fa-book"></i>Documents</a>
                    </li>
                    </ul>
                    
                    <div class="uk-width-1-2@s">
                    </div>
                    
                </ul>
            </div><!-- /.navbar-collapse -->

@else
<div id="main-menu" class="main-menu collapse navbar-collapse" style="background-color:#003763;">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="{{ url('dashboard/all') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>

                   
                    <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-package"></i>Inventory<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ url('equipment/all') }}">Plant Property and Equipment</a></li>
                        <li><a href="{{ url('ics/all') }}">Semi-Expendable Supply</a></li>
                        </ul>
                   </div>

                      
                   <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-shopping-cart"></i>Procurement<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ url('annual-procurement-plan') }}">Annual Procurement Plan (APP)</a></li>
                        <li class="uk-active"><a href="{{ url('divisional-procurement-plan') }}">  Divisional Procurement Management Plan (DPPMP)</a></li>
                        </ul>
                   </div>
                 
                    
                   <li class="" >
                        <a href=""><i class="customhide menu-icon ti ti-trash"></i>Disposal<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>

                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('ppe-disposal') }}">PPE - For Disposal</a></li>
                        <li class="uk-active"><a href="{{ route('ppe-disposed') }}">PPE - Disposed</a></li>
                        <li class="uk-active"><a href="{{ route('supplies-disposal') }}">Supplies - For Disposal</a></li>
                        <li class="uk-active"><a href="{{ route('supplies-disposed') }}">Supplies - Disposed</a></li>
                        </ul>
                   </div>


                   

                
                  
                    <ul uk-nav>
                    <li class="" >
                        <a href=""><i class="menu-icon fa fa-database"></i></a>
                    </li>
                    </ul>
                    <div class="uk-width-1-2@s uk-width-2-5@m">
                        <ul class="uk-nav-default" uk-nav>
                            <li class="uk-parent">
                                <a href="#">Library <span uk-nav-parent-icon></span></a>
                                <ul style="width:200px!important;">
                                <li class="uk-active"><a href="{{ url('library-category') }}"><i class="fa fa-database"></i> Category</a></li>
                                <li class="uk-active"><a href="{{ url('library-subcategory') }}"><i class="fa fa-database"></i> Sub-Category</a></li>
                                <li class="uk-active"><a href="{{ url('library-ics-type') }}"><i class="fa fa-database"></i> ICS Type</a></li>
                                <li class="uk-active"><a href="{{ url('library-fund-cluster') }}"><i class="fa fa-database"></i> Fund Cluster</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- <li class="">
                        <a href="{{ url('user-management/all') }}"> <i class="menu-icon fa fa-user"></i>Users Management</a>
                    </li> -->

                    <li class="" >
                        <a href=""><i class="customhide menu-icon fa fa-user""></i>Users Management<i style='float:right; padding-top:7px;' class="fa fa-chevron-circle-down"></i></a>
                    </li>
                    <div uk-dropdown="mode: click" style='color:black; background-color:#003763;' class="customhide" >
                        <ul class="uk-nav uk-dropdown-nav">
                        <li class="uk-active"><a href="{{ url('user-management/all') }}">ICOS and Regular Staff</a></li>
                        <li><a href="{{ url('project-staff-management/all') }}">Project Staff</a></li>
                        </ul>
                   </div>

                   <li class="">
                        <a href="{{ url('change-password/all') }}"> <i class="menu-icon fa fa-gear"></i>Change Password</a>
                   </li>

                   <li class="">
                      <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="menu-icon fa fa-power-off"></i>Logout</a>
                   </li>

                    <h3 class="menu-title">REPORTS</h3>
                    <ul uk-nav>
                        <li class="" >
                            <a href=""><i class="menu-icon fa fa-book"></i></a>
                        </li>
                        <li class="ppe-icon" >
                            <a href=""><i class="menu-icon fa fa-book"></i></a>
                        </li>
                    </ul>

                    <div class="uk-width-1-2@s">
                 
                        <ul class="uk-nav-default" uk-nav>
                            <li class="uk-parent">
                                <a href="#" onclick="hidePPEicon();">Supplies<span uk-nav-parent-icon></span></a>
                                <ul style="width:200px!important;">
                                    <li class="uk-parent">
                                        <ul class="uk-nav-sub">
                                        <!-- <li class="uk-active"><a href="{{ url('ics-report-ui/all') }}">ICS</a></li> -->
                                        <!-- <li class="uk-active"><a href="{{ url('semi-expendable-card-report-ui/all') }}">Semi-Expendable Property Card</a></li> -->
                                        <li class="uk-active"><a href="{{ url('spissued-report') }}">Report of SP Issued</a></li>
                                        <li class="uk-active"><a href="{{ url('sp-ledger') }}">Property Ledger Card</a></li>
                                        <!-- <li class="uk-active"><a href="{{ url('propcard-report-ui/all') }}">Property Sticker</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                         </ul>

                            <ul class="uk-nav-default" uk-nav>
                            <li class="uk-parent">
                                <a href="#" onclick="showPPEicon();">Plant, Property, and Equipment<span uk-nav-parent-icon></span></a>
                                <ul style="width:200px!important;">
                                    <li class="uk-parent">
                                        <ul class="uk-nav-sub">
                                        <li class="uk-active"><a href="{{ url('par-report-ui/all') }}">PAR</a></li>
                                        <li class="uk-active"><a href="{{ url('rpcppe-report-ui/all') }}">Report on the Physical Count of PPE</a></li>
                                        <li class="uk-active"><a href="{{ url('propcard-report-ui/all') }}">Property Card</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            </ul>
                    </div>

                    <h3 class="menu-title">Documents</h3>
                    <ul uk-nav>
                    <li class="">
                        <a href="{{ url('documents') }}"> <i class="menu-icon fa fa-book"></i>Documents</a>
                    </li>
                    </ul>
                    
                    <div class="uk-width-1-2@s">
                    </div>
                    
                </ul>
            </div><!-- /.navbar-collapse -->

@endif
            
            <script>
            function hidePPEicon()
            {
                $(".ppe-icon").toggle();
            }

            function showPPEicon()
            {
                $(".ppe-icon").show();
            }
            </script>