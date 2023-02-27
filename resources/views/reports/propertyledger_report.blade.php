@extends('layouts.master')

@section('addCSS')
<!-- <link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
<style>
  .table td {
    font-size: 14px;
  }

  .table th {
    font-size: 12px;
  }
  button
  {
    border-radius:4px!important;
  }
</style>
@endsection

@section('content-title')
Property Ledger Card
@endsection

@section('content')
<div class="w3-container">
    <div class="w3-row" style="width:800px;" >
      <a href="javascript:void(0)" onclick="openTab(event, 'GenerateReport');">
        <div class="w3-third tablink w3-bottombar w3-border-blue w3-padding">
        <center>Generate Report</center>
        </div>
      </a>
     
      <a href="javascript:void(0)" onclick="openTab(event, 'List');">
        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">
        <center>List of Reports Generated</center>
      </div>
      </a>
    </div>

  <div id="GenerateReport" class="w3-container tab " style="display:block">
    <div class = "">
      <br/>
        <p align="left"><button id="generateReportButton" style="border-radius:4px;" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i>&nbsp; Generate Report</button></p>
        <div id="print-row">
          <p align="left" style="display:hidden;"><button id="printRPCPPE" type="button" class="btn btn-primary btn-md" data-toggle="modal" onclick="printReport()"><i class="fa fa-print"></i>&nbsp; Print Report</button></p>
        </div>

        Date Range: <span style="font-weight:bold;" id ="date_range"></span><br/><br/>
        <table id="bootstrap-data-table" class="table" style="background-color: #FFF;width: 100%; ">
          <thead class="thead-light">
            <tr>
              <th style="width: 2%">#</th>
              <th>ICS No.</th>
              <th>Division</th>
              <th>Responsibility Center Code</th>
              <th>Semi-Expendable Property No.</th>
              <th>Item Description</th>
              <th>Unit</th>
              <th>Quantity Issued</th>
              <th width="10%">Unit Cost</th>
              <th width="10%">Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr id="toclear" style="">
              <td colspan="14">
                <center>Click <strong>Generate Report</strong> to Generate Report</center>
              </td>
            </tr>
          </tbody>
        </table>

      <!-- GENERATE RSPI  -->
      <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:1950px;">
          <div class="modal-content" style="width:900px;">
            <div class="modal-header">
              <h5 class="modal-title" id="largeModal">Generate Report of Semi-Expendable Supplies Issued</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="generateSPIssuedReport" method="POST" action="">
                @csrf

                <div class="card-body">
                      <input type="hidden" id ="date_range_get" name="date_range_get">
                      <input type="hidden" name="empcode" id="empcode" value="">
                      <div class="row form-group">
                              <div class="col-12 col-md-2">
                                  <label for="text-input" class=" form-control-label">Start Date</label>
                              </div>
                              <div class="col-12 col-md-4">
                              <input class="form-control" type="date" id="start_date_issued" name="start_date_issued">
                              </div>
                      </div>

                      <div class="row form-group">
                          <div class="col-12 col-md-2">
                              <label for="text-input" class=" form-control-label">End Date</label>
                          </div>
                              <div class="col-12 col-md-4">
                              <input class="form-control" type="date" id="end_date_issued" name="end_date_issued">
                          </div>
                      </div>

                      <div class="row form-group">
                          <div class="col-12 col-md-2">
                              <label for="text-input" class=" form-control-label">Fund Cluster</label>
                          </div>
                              <div class="col-12 col-md-4">
                              <select name="fund_cluster" id="fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control" required>
                                        <option value="" disabled selected>Select a Fund Cluster</option>
                              </select>
                              </div>
                      </div>

                      <div class="row form-group">
                          <div class="col-12 col-md-2">
                              <label for="text-input" class=" form-control-label">RSPI Serial Number</label>
                          </div>
                              <div class="col-12 col-md-4">
                              <input class="form-control" value="RSPI " type="text" id="rspi_serial_number" name="rspi_serial_number">
                          </div>
                      </div>
                </div>

                <div class="modal-footer">
                  <button style="border-radius: 4px;" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button style="border-radius: 4px;" id="generateReport" type="submit" data-dismiss="modal" class="btn btn-primary">Confirm</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <!-- END GENERATE RSPI -->
      </div>

  <div id="List" class="w3-container tab" style="display:none">
  <br/>
  <table id="bootstrap-data-table-reports" class="table" style="text-align:center; background-color: #FFF;width: 100%; ">
  <thead class="thead-light">
    <tr style="text-align:center;">
      <th style="width: 2%">#</th>
      <th>RSPI Serial Number</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Date Created</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr id="toclear" style="">
      <td colspan="14">
      
      </td>
    </tr>
  </tbody>
</table>

  </div>
</div>
<br/>

<!-- Start Update RSPI -->
<div class="modal fade" id="updateRSPI">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin-top: 10px;">
            <div class="modal-header">
                <h5 class="modal-title">
                    Update RSPI Number</h5>
            </div>
            <form method="POST" action="{{ url('rspi/update') }}" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="update_rspi_id" id="update_rspi_id" value="">

                <div class="tab-content pl-3 pt-2" id="nav-tabContent" style="background-color: #FFF;padding: 1%;border:1px solid #DDD;border-top: 1px solid #FFF">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card">
                            <br />
                            <div class="row form-group" style="padding-left:10px;">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">RSPI Serial Number</label></div>
                                <div class="col-12 col-md-6">
                                    <input class="form-control" name='update_rspi_serial_number' id="update_rspi_serial_number" required>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    </div>
                </div>
                <br>
                <p align="right" style="padding-right:300px;">
                    <button style="border-radius:4px;" type="submit" name="btn-edit" id="btn-edit" class="btn btn-primary btn-md">Update</button>
                    <a style="border-radius:4px;" href="" data-dismiss="modal" class="btn btn-secondary btn-md">Cancel</a>
                </p>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End RSPI Update -->

@endsection

@section('addJS')
@if(session('message-deleted'))
<script type="text/javascript">
Swal.fire({
    title: "Success",
    text: "Report Successfully Deleted!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

@if(session('message-updated'))
<script type="text/javascript">
Swal.fire({
    title: "Success",
    text: "RSPI Serial Number Successfully Updated!",
    type: "success"
}).then(function() {
   
});
</script>  
<br/>
@endif

<script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    showGeneratedRSPI();
    $("#print-row").hide();

    $('#select_year').select2({
      dropdownParent: "#largeModal",
      closeOnSelect: true,
      theme: "classic",
      width: '100%',

    });

    $.getJSON("{{ url('json/fund-cluster/all') }}", function(datajson) {
      jQuery.each(datajson, function(i, obj) {
        $("#fund_cluster").append("<option value='" + obj.fund_cluster + "'>" + obj.fund_cluster + "</option>");
      });
    });


   $("#generateSPIssuedReport").on("submit", function (e) {
        var dataString = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "{{ url('spissued/generate-report') }}",
          data: dataString,
          success: function (response) {
            Swal.fire(
            'Success!',
            'Report Successfully Generated!',
            'success')
          }
        });
        e.preventDefault();
        });

        $('#generateSPIssuedReport').submit(function() {
        if ($.trim($("#start_date_issued").val()) === "" || $.trim($("#end_date_issued").val()) === "") {
            alert('you did not fill out one of the fields');
            return false;
            }
        });

   
    $(document).on("click", "#generateReport", function() {
      $('#date_range').html(moment(start_date).format('ll') + " to " + moment(end_date).format('ll')) 
      $('#date_range_get').val(moment(start_date).format('ll') + " to " + moment(end_date).format('ll')) 
      var start_date = $("#start_date_issued").val();
      var end_date = $("#end_date_issued").val();
      var fund_cluster = $("#fund_cluster").val();

      if (start_date != "" || end_date !="") {
            $("#print-row").show();
            $("#largeModal .close").click();
            $('#generateSPIssuedReport').submit();
            var t = $('#bootstrap-data-table').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'excel'
              ],
              "destroy": true,
              "saveState": true,
              "processing": true,
              "serverSide": true,
              "paging": true,
              "ajax": {
                "type": "GET",
                "url": "{{ url('get/spissued')}}" + "/" + start_date + "/" + end_date + "/" + fund_cluster
              },
              "columns": [
                {
                  "data": "id"
                },
                {
                  "data": "ics_number"
                },
                {
                  "data": "division"
                },
                {
                  "data": "responsibility_center_code"
                },
                {
                  "data": "inventory_item_number"
                },
                {
                  "data": "component_name"
                },
                {
                  "data": "ics_umeasure"
                },
                {
                  "data": "quantity"
                },
                {
                  "data": "unit_cost"
                },
                {
                  "data": "unit_cost"
                }
              ],
              "columnDefs": [{
                "targets": 2,
                "render": function(data, type, row) {
                  if (data != "" && data != null && data.length > 150) {
                    return `<p>${data.substring(0, 150)}...<a href='#' class='text-primary display-ppe-details'><u> See more</u> <a/></p>`
                  }
                  return data;
                }
              }],
              "createdRow": function(row, data, dataIndex) {
                $(row).attr('data-id', data.id)
              }

            });
            t.clear();
            $('#bootstrap-data-table').on('click', '.row-edit-equipment', function(e) {
              let varID = getRowID(e.target);
              editEquipmentdetails(varID);
            });
      }
      else
      {
        $("#generateReport").prop("disabled", true);
        Swal.fire({
            title: "Warning",
            text: "Please fill-out all fields",
            type: "warning"
        }).then(function() {
        });
      }
    });
  });

  function showGeneratedRSPI()
  {
    var t = $('#bootstrap-data-table-reports').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        "destroy": true,
        "saveState": true,
        "processing": true,
        "serverSide": false,
        "paging": true,
        "ajax": {
          "type": "GET",
          "url": "{{ url('get/generated/spissued')}}" 
        },
        "columns": [
          {
            "data": "id"
          },
          {
            "data": "rspi_serial_number"
          },
          {
            data: "start_date", render: function(data) {
            if (data == null) { return '-'; }
            return moment(data).format('LL');
            }
          },
          {
            data: "end_date", render: function(data) {
            if (data == null) { return '-'; }
            return moment(data).format('LL');
            }
          },
          {
            data: "created_at", render: function(data) {
            if (data == null) { return '-'; }
            return moment(data).format('LLL');
            }
          },
          {
            "data": null,
            "defaultContent": "<div class='uk-inline'> <button style='border-radius:4px;' class='uk-button uk-button-primary' type='button'><i class='menu-icon fa fa-caret-down'></i> Action</button> <div uk-dropdown='mode: click'> <ul class='uk-nav uk-dropdown-nav'  style='height:120px; overflow-x: scroll; overflow-x:hidden;'> <li><a href='#' class='row-generate-report'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-eye'></i> View Report </div></a></li><li> <a href='#' class='row-edit-report'> <div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-edit'></i> Edit RSPI Number</div></a> </li><li><a href='#' class='row-delete-report'><div style='font-size:18px; font-weight:normal;'><i class='menu-icon fa fa-times'></i> Delete Report </div></a></li></ul> </div></div>"         
          }
        ],
      
        "createdRow": function(row, data, dataIndex) {
          $(row).attr('data-id', data.id)
        }

      });
          //COUNTER
          t.on('order.dt search.dt', function() {
                    t.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                    }).draw();
                //COUNTER

      t.clear();
  }

  $('#bootstrap-data-table-reports').on('click', '.row-generate-report', function(e) {
            let varID = getRowID(e.target);
            retrieveReport(varID);
  });

  
  $('#bootstrap-data-table-reports').on('click', '.row-edit-report', function(e) {
            let varID = getRowID(e.target);
            editReport(varID);
  });

    
  $('#bootstrap-data-table-reports').on('click', '.row-delete-report', function(e) {
            let varID = getRowID(e.target);
            deleteReport(varID);
  });

  function getRowID(element) {
    return $(element).parents('tr').attr('data-id')
  }

  function retrieveReport(id) {
      $.getJSON("{{ url('get/generated/spissued') }}/" + id, function(datajson) {
      window.open("{{ url('pdf/spissued-report') }}/" + datajson[0].start_date + "/" + datajson[0].end_date + "/" + datajson[0].fund_cluster);
      });
  }


  function deleteReport(id) {
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
        window.location.href = "{{ url('rspi/delete') }}/" + id;
      }
    })
  }

    function generateReport(start_date, end_date, fund_cluster) {
      window.open("{{ url('pdf/spissued-report') }}/" + start_date + "/" + end_date + "/" + fund_cluster);
    }

    function editReport(id){
      $.getJSON("{{ url('get/generated/spissued') }}/" + id, function(datajson) {}).done(function(datajson) {
              jQuery.each(datajson, function(i, obj) {
                  $("#update_rspi_id").val(obj.id);
                  $("#update_rspi_serial_number").val(obj.rspi_serial_number);
              });
          }).fail(function() {
              alert("Error loading data! Page reloading, please wait...")
              location.reload();
          });
          $("#updateRSPI").modal("toggle");
    }

    function printReport(start_date, end_date, fund_cluster) {
      var start_date_issued = $("#start_date_issued").val();
      var end_date_issued = $("#end_date_issued").val();
      var fund_cluster = $("#fund_cluster").val();
      window.open("{{ url('pdf/spissued-report') }}/" + start_date_issued + "/" + end_date_issued + "/" + fund_cluster);
    }

    function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-border-blue", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.firstElementChild.className += " w3-border-blue";
    }
</script>
@endsection