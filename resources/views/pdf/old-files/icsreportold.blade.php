<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        </style>
        <title>ICS</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                margin : 15px 15px 20px 15px;
                font-family: "Arial", Times, serif;
                font-size: 12px;
            }
            section {
                padding: 1em 0;
            }

            .container {
                max-width: 816px;
                margin: auto;
            }

            .flex-container {
                display: flex;
            }

            .border-total-cost {
                position: relative;
                /* left: 90px; */
                top: 80px;
                border-top: 2px solid black;
                border-bottom: 2px solid black;
            }

            .border-black-1 {
                border: 1px solid black;
            }
            .border-top-black-1 {
                border-top: 1px solid black;
            }
            .flex-container .flex-grow-1 {
                flex-grow: 1;
            }
            .text-center {
                text-align : center;
            }
            .text-left {
                text-align: left;
            }
            .text-upper {
                text-transform : uppercase;
            }
            .text-underline {
                text-decoration: underline;
            }
            .font-weight-bold {
                font-weight : bold;
            }
            .header-row {
                margin: 0.5em 0;
            }
            .remarks-row {
                padding: 0.3em 0;
            }
            .par-title {
                font-size: 14px;
            }
            .par-content {
                padding: 1em 0;
            }
            p {
                padding: 0.4em 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table tr td,
            table tr th {
                border: 1px solid black;
                text-align: center;
                padding-right: 1em;
                padding-left: 1em;
            }

            table tr td {
                padding: 1.5em;
            }
            .property-remarks {
                padding: 1em 0 1em 1em;
            }
            .remarks-details {
                padding-left: 7em;
            }

            .signatories > div {
                flex: 0 0 50%;
            }
            .signatory-info {
                text-align: center;
                padding: 1em 0;
            }
            .signatory-container {
                padding: 0.5em 1em;
            }
        </style>
    </head>
    <body>
        <div class = "container border-black-1">
        <div class="container">
            <section class="header text-center">
                <p class="text-upper font-weight-bold par-title ">
                    Inventory Custodian Slip
                </p>
                <p>
                    Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)
Los Baños, Laguna
                </p>
            </section>
            <section class="content">
                <div class="par-header">
                    <div class="header-row">
                        <div>
                            <span class="font-weight-bold">
                                Entity Name :
                            </span>
                            <span class="par-header-info entity-name">
                                DOST-PCAARRD
                            </span>
                        </div>
                    </div>
                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                            <span class="font-weight-bold">
                                Fund Cluster : 
                            </span>
                            <span class="par-header-info fund-cluster">
                             @foreach ($data as $index => $equipment)
                        @if($index == 0)
                       <strong>{{ $equipment->fund_cluster }}</strong>
                       @endif
                   @endforeach
                            </span>
                        </div>
                        <div>
                            <span class="font-weight-bold">
                                ICS No. : 
                            </span>
                            <span class="par-header-info par-no">
                             <strong>@foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->ics_number }}
            @endif
          @endforeach 
          </strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                <div class="par-content">
                    <table class="propery-table">
                        <thead>
                            <tr> 
                                <th rowspan="2">Quantity</th>
                                <th rowspan="2">Unit</th>
                                <th colspan="2">Amount</th>
                                <th rowspan="2">Description</th>
                                <th rowspan="2">Inventory Item No.</th>
                                <th rowspan="2">Estimated Useful Life</th>
                            </tr>
                            <tr class="propery-table-header">
                                <th>Unit Cost</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                             <tr>
                            	<!-- Quantity -->
                                <td>
                                <center>
                                @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ $equipment->quantity }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
                               </center>
            				    </td>
                                
                                <!-- Unit -->
                                <td>
            					<center> 
                                @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ $equipment->ics_umeasure }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
            					</center>
            					</td>

                                  <!-- Unit Cost -->
                               <td>
                               <center>
                               @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ number_format($equipment->unit_cost, 2) }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
                               </center>
                                </td>

                                  <!-- Total Cost -->
                               <td>
                               <center>
                               @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ number_format($equipment->unit_cost, 2) }}<br/><br/>
            					@endfor
            					@endforeach
                                <div class="border-total-cost">
                                {{ $total_cost }}
                                </div>
                                <br/><br/><br/> <br/><br/> <br/><br/><br/><br/><br/><br/>
                               </center>
                                </td>

                                <!-- Description  -->
                                <td style="text-align:left;">
                                @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ $equipment->component_name }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
                                </td>
                                
                                <!-- Property Number  -->
                                <td>
                                @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ $equipment->property_number }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
                                </td>
                                
                               

                               <!-- Lifespan -->
                                <td>
                                <center>
                                @foreach ($data as $equipment)
            					@for ($i = 0; $i <= 0; $i++)
            					<br/>{{ $equipment->lifespan }}<br/><br/>
            					@endfor
            					@endforeach
                                <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/>
                                </center>
                                </td>
                            </tr>

                           
                            
                        </tbody>
                       
                    </table>
                  

                    <!-- Date Acquired -->
                            <!--     <td>
                               @foreach ($data as $index => $equipment)
                               @if($index == 0)
                               {{ $equipment->date_acquired }}
                               @endif
                               @endforeach
                                </td> -->
                               
                                
                    <div class="property-remarks border-black-1">
                        <div>
                            <span class="text-upper font-weight-bold">
                                Remarks
                            </span>
                        </div>
                        <div class="remarks-details">
                            <div class="remarks-row">
                                <span>
                                    Purchased from :
                                </span>
                                <!-- Purchased From -->
                                <span>
                                @foreach ($data as $index => $equipment)
          						@if($index == 0)
           						{{ $equipment->remarks_from }}
            					@endif
         						@endforeach
                                </span>
                            </div>
                            <div class="remarks-row">
                                <span>
                                    Sales Invoice No. :
                                </span>
                                <!-- Sales Invoice Number -->
                                <span>
                                @foreach ($data as $index => $equipment)
            					@if($index == 0)
            					{{ $equipment->remarks_sales }} dated {{ $equipment->remarks_sales_date }}
            					@endif
            					@endforeach
                                </span>
                            </div>
                            <div class="remarks-row">
                                <span class = "po-pcv-row">
                                @foreach ($data as $index => $equipment)
                                @if($equipment->ics_type == "PCV")
                                @if($index == 0)
                                PCV No. :
                                @endif
                                
                                @elseif($equipment->ics_type == "PO")
                                @if($index == 0)
                                PO No. :
                                @endif
                           
                                @elseif($equipment->ics_type == "Reimbursement")
                                @if($index == 0)
                                Reimbursement No. :
                                @endif
                                
                                @elseif($equipment->ics_type == "Contract")
                                @if($index == 0)
                                Contract No. :
                                @endif

                                @else
                                @if($index == 0)
                                PO/PCV No. :
                                @endif
                                @endif

          						@endforeach
                                </span>
                               
                               <!-- PO/PCV No. -->
                                <span>
                                @foreach ($data as $index => $equipment)
           						@if($index == 0)
      					        {{ $equipment->remarks_po_num }} dated {{ $equipment->remarks_po_date }}
                                
            					@endif

                                @if($equipment->pcv_by != null)
                                PCV by {{ $equipment->pcv_by }}
                                @endif
          						@endforeach
                                </span>

                            </div>
                            <div class="remarks-row">
                                <span>
                                    PR No. :
                                </span>

                                <!-- PR Number -->
                                <span>
                                @foreach ($data as $index => $equipment)
            					@if($index == 0)
            					{{ $equipment->remarks_pr_num }} dated {{ $equipment->remarks_pr_date }}
            					@endif
          						@endforeach
                                </span>
                            </div>
                            <div class="remarks-row">
                                <span>
                                    Charged to :
                                </span>

                                  <!-- Charged to -->
                                <span>
                                @foreach ($data as $index => $equipment)
           					    @if($index == 0)
        		 			    {{ $equipment->remarks_charged}}
            					@endif
            					@endforeach
                                </span>
                            </div>
                        </div>
                        
                    </div>

                  
                    <div class="signatories flex-container">
                        
                        <div class="issued-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Received by:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-name font-weight-bold text-upper">
                                 @foreach ($data as $index => $equipment)
           						 @if($index == 0)
            					<span style="text-transform: uppercase;"> {{ $equipment->fullname}} </span>
            					@endif
            					@endforeach
                                </div>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of End User
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-position font-weight-bold text-upper">
                                @foreach ($data as $index => $equipment)
         						@if($index == 0)
           						{{ $equipment->position}}
            					@endif
       					        @endforeach/@foreach ($data as $index => $equipment)
            					@if($index == 0)
            					{{ $equipment->division}}
       						    @endif
            					@endforeach
                                </div>
                                <div class="border-top-black-1">
                                    Position / Office
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-date font-weight-bold text-upper">
                                  {{$date}}
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>

                        <div class="received-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Received from:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-name font-weight-bold text-upper">
                                   GLENDA P. LANTACON
                                </div>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of End User
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-position font-weight-bold text-upper">
                                Administrative Officer V / FAD-Property
                                </div>
                                <div class="border-top-black-1">
                                    Position / Office
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-date font-weight-bold text-upper">
                                   {{$date}}
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
