@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/scss/widgets.css') }}">
@endsection

@section('content-title')
DASHBOARD
@endsection

@section('content')
<!-- START FILTER -->
<div class="modal fade" id="dashboardFilters">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top: 10px;">
            <div class="modal-header">
                <h5 class="modal-title">Dashboard Filter</h5>
            </div>
            <br/>
            <form method="POST" action="{{ url('filter-dashboard') }}" enctype="multipart/form-data">
            @csrf
            </nav>
            <div class="row form-group" style="padding-left:10px;">
                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Year</label></div>
                    <div class="col-12 col-md-6">
                        <select name="year" id="year" data-placeholder="Select a Year" class="form-control" required>
                        <option value="" disabled selected>Select a Year</option>
                       </select>
                   </div>
            </div>

            <div class="row form-group" style="padding-left:10px;">
                    <div class="col-12 col-md-2"><label for="text-input" class=" form-control-label">Month</label></div>
                    <div class="col-12 col-md-6">
                        <select name="month" id="month" data-placeholder="Select a Month" class="form-control" required>
                        <option value="" disabled selected>Select a Month</option>
                        </select>
                   </div>
            </div>

            <br>
                <p align="right" style="padding-right:300px;">
                    <button style="border-radius:4px;" type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Filter</button>
                    <a style="border-radius:4px;" href="" data-dismiss="modal" class="btn btn-danger btn-md">Cancel</a>
                </p>
             </form>
           
        </div>
    </div>
</div>
<!-- END FILTER -->



<div class="animated fadeIn">
<div class="row">
<div class="col-sm-12 mb-4">
                        <div class="card-group" >
                            <div class="card offset-col-lg-2 offset-col-md-6 no-padding no-shahow" >
                                <div class="card-body bg-flat-color-1">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="ti ti-package text-light"></i>
                                    </div>

                                    <div class="h1 mb-0 text-light">
                                        <span class="count">{{  getTotalItems() }}</span>
                                    </div>
                                    <small class="text-uppercase font-weight-bold text-light">Total No. of Items</small>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                </div>
                            </div>
                            <div class="card offset-col-lg-2 offset-col-md-6 no-padding no-shadow">
                                <div class="card-body bg-flat-color-5">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="fa fa-truck text-light"></i>
                                    </div>
                                    <div class="h1 mb-0 text-light">
                                        <span class="count">{{  getTotalDashboardStatus('Acquired') }}</span>
                                    </div>
                                    <small class="text-uppercase font-weight-bold text-light">Acquired</small>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                </div>
                            </div>
                            <div class="card offset-col-lg-2 offset-col-md-6 no-padding no-shadow">
                                <div class="card-body bg-flat-color-4">
                                    <div class="h1 text-light text-right mb-4">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                    <div class="h1 mb-0 text-light">
                                    	<span class="count">{{ getTotalDashboardStatus('Disposed') }}</span>
                                    </div>
                                    <small class="text-light text-uppercase font-weight-bold">Disposed</small>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                </div>
                            </div>

                            <div class="card offset-col-lg-2 offset-col-md-6 no-padding no-shadow">
                                <div class="card-body bg-flat-color-2">
                                    <div class="h1 text-light text-right mb-4">
                                    <i class="fa fa-flag"></i>
                                    </div>
                                    <div class="h1 mb-0 text-light">
                                    	<span class="count">{{ getTotalDashboardStatus('Surrendered') }}</span>
                                    </div>
                                    <small class="text-light text-uppercase font-weight-bold">Surrendered</small>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                </div>
                            </div>
                            <div class="card offset-col-lg-2 offset-col-md-6 no-padding no-shadow">
                                <div class="card-body bg-flat-color-3">
                                    <div class="h1 text-light text-right mb-4">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <div class="h1 mb-0 text-light">
                                    	<span class="count">0</span>
                                    </div>
                                    <small class="text-light text-uppercase font-weight-bold">Unpresented</small>
                                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                                </div>
                            </div>
                        </div>
                   
                        <br/>
                    <div class="card" style="width:40%;">
                        <div class="card-body">
                        <div class="row">
                        <div class="col-sm-8">
                        <h5 class="card-title mb-0" style="color:#343434;">Total Inventory Cost: <strong>₱{{  getTotaCost() }}</strong></h5>
                        <div class="small text-muted">Overall</div>
                        </div>
                       
                        <div class="col-sm-4 hidden-sm-down">
                        <button id="viewDashboardFilters" type="button" style="border-radius:4px; color:white;" class="btn float-right bg-flat-color-5">Filter <i class="fa fa-filter"></i></button>
                        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        </div>
                        </div>
                        </div>
                        <div class="chart-wrapper mt-2"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                        <canvas height="50%;" width="100%;" id="totalInventoryCostChart" ></canvas>
                        </div>
                        </div>
                                <!-- <div class="card-footer">
                                            <ul>
                                            <li>
                                            <div class="text-muted">Visits</div>
                                            <strong>29.703 Users (40%)</strong>
                                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </li>
                                            <li class="hidden-sm-down">
                                            <div class="text-muted">Unique</div>
                                            <strong>24.093 Users (20%)</strong>
                                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </li>
                                            <li>
                                            <div class="text-muted">Pageviews</div>
                                            <strong>78.706 Views (60%)</strong>
                                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </li>
                                            <li class="hidden-sm-down">
                                            <div class="text-muted">New Users</div>
                                            <strong>22.123 Users (80%)</strong>
                                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </li>
                                            <li class="hidden-sm-down">
                                            <div class="text-muted">Bounce Rate</div>
                                            <strong>40.15%</strong>
                                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </li>
                                            </ul>
                               </div> --> 
                       
                    </div>

                     </div>

                    <br>
                        <br>

                       <?php
                        		// foreach ($data['viewclassification'] as $value) {
                        		// 	# code...
                        		// 	echo "<div class='col-lg-3 col-md-6'>
						        //                 <div class='card'>
						        //                     <div class='card-body'>
						        //                         <div class='stat-widget-one'>
						        //                             <div class='stat-content dib'>
						        //                                 <div class='stat-text'>".$value->subclass_description."</div>
						        //                                 <div class='stat-digit count'>".$value->total_cat."</div>
						        //                             </div>
						        //                         </div>
						        //                     </div>
						        //                 </div>
						        //             </div>";
                        		// }
                        ?> 
</div>
</div>
@endsection

@section('addJS')
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/widgets.js') }}"></script>
    <script type="text/javascript">
    $( document ).ready(function() {
        $('#viewDashboardFilters').on('click', function(e) {
        $("#dashboardFilters").modal("toggle");
     });
    });
   
     //bar chart
     var ctx = document.getElementById( "totalInventoryCostChart" );
     var year = $('#year').val(); 
     var month = $('#month').val();
      var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "" ],
            datasets: [
                {
                    label: "PPE",
                    data: [ 
                        {{getPPETotalCostJanuary()}}, 
                      
                    ],
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(44, 130, 201, 1)"
                },
                {   
                    label: "ICS",
                    data: [
                        {{getICSTotalCostJanuary()}}, 
                    ],
                    borderColor: "rgba(0,0,0,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(101,198,187,1)"
                }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    } );


    </script>
@endsection
