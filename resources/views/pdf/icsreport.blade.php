<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
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
                font-size: 14px;
            }
            section {
                padding: 1em 0;
            }

            .table-headers {
               font-size: 13px;
            }

            .container {
                max-width: 816px;
                margin: auto;
            }

            .flex-container {
                display: flex;
            }

            .border-bottom-1 {
                border-bottom: 1px solid black;
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
                border-bottom:none;
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
                border-right:none;
                flex: 0 0 50%;
            }
            .signatory-info {
                font-size:11px;
                text-align: center;
                padding: 1em 0;
            }
            .signatory-container {
                padding: 0.5em 1em;
                
            }
        </style>
    </head>
    <body>
        <div class="container">
            <section class="header text-center">
                <p class="text-upper font-weight-bold par-title ">
                    Inventory Custodian Slip
                </p>
                <p>Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)<br/> Los Baños, Laguna
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
                             <strong>
                            @foreach ($data as $index => $equipment)
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
                                <th class="table-headers" colspan="1" rowspan="2">Quantity</th>
                                <th class="table-headers" colspan="1" rowspan="2">Unit</th>
                                <th class="table-headers" colspan="2">Amount</th>
                                <th class="table-headers" colspan="1" rowspan="2">Description</th>
                                <th class="table-headers" colspan="1" rowspan="2">Inventory Item No.</th>
                                <th class="table-headers" colspan="1" rowspan="2">Estimated Useful Life</th>
                            </tr>
                            <tr class="propery-table-header">
                                <th class="table-headers">Unit Cost</th>
                                <th class="table-headers">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $equipment)
                            <tr style="border:none;">
                            <td style="vertical-align:top; border-bottom:none; border-top:none;"><hr style="height:2px; visibility:hidden;" />{{ $equipment->quantity }}</td>
                            <td style="text-align: left; border-bottom:none; border-top:none; font-size:12px; vertical-align:top;"><hr style="height:5px; visibility:hidden;" />{{ $equipment->ics_umeasure }}</td>
                            <td style="vertical-align:top; border-bottom:none; border-top:none;">{{ number_format($equipment->unit_cost, 2) }}</td>
                            <td style="vertical-align:top; border-bottom:none; border-top:none;">{{ number_format(($equipment->unit_cost) * ($equipment->quantity),2)  }}</td>
                            <td style="font-size: 11.5px; text-align: center; border-bottom:none; border-top:none; vertical-align:top;">{{ $equipment->component_name }}<br/>
                            @if(!empty($equipment->serial_num ) && ($equipment->serial_num ) !== 'null')
                            <small>Serial Number: {{ $equipment->serial_num }}</small><br/>
                            {{ $equipment->remarks }} 
                            @endif 
                            @if(count($data) > 1)
                            <br/>
                            @else
                            <br/> <br/> <br/> <br/> <br/> <br/>  <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/></td>
                            @endif
                            <td style="text-align: center; border-bottom:none; border-top:none; vertical-align:top;">{{ $equipment->inventory_item_number }}</td>
                            <td style="text-align: center; border-bottom:none; border-top:none; vertical-align:top;">{{ $equipment->lifespan }} </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                 
                    
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
                    <div class="signatories flex-container border-black-1">
                        <div class="received-by-information signatory-container">
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
                                    Signature Over Printed Name
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

                        <div style="border-top:none; border-bottom:none;" class="issued-by-information border-black-1 signatory-container">
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
                                    Signature Over Printed Name
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
                                    &nbsp;
                                  <!-- {{$date}} -->
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>
                    </div>
                
            </section>
  
        </div>
    </body>
</html>


<script>
window.print();
</script> 
