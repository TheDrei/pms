<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            
        </style>
        <title>PAR</title>
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

            .container {
                max-width: 816px;
                margin: auto;
            }

            .flex-container {
                display: flex;
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
                <p class="text-upper font-weight-bold par-title">
                    Property Acknowledgement Receipt
                </p>
                <p>
                    Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD) Los Baños, Laguna
                </p>
            </section>
            <section class="content">
                <div class="par-header">
                    <div class="header-row">
                        <div>
                            <span class="font-weight-bold">
                                Entity Name :
                            </span>
                            <span class="text-underline par-header-info entity-name">
                             <strong> DOST-PCAARRD </strong>
                            </span>
                        </div>
                    </div>
                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                            <span class="font-weight-bold">
                                Fund Cluster : 
                            </span>
                            <span class="text-underline par-header-info fund-cluster">
                             @foreach ($data as $index => $equipment)
                             @if($index == 0)
                                    {{ $equipment->fund_cluster }}
                                    @endif
                             @endforeach
                            </span>
                        </div>
                        <div>
                            <span class="font-weight-bold">
                                PAR No. : 
                            </span>
                            <span class="text-underline par-header-info par-no">
                             @foreach ($data as $index => $equipment)
                                @if($index == 0)
                                {{ $equipment->par_number }}
                                @endif
                             @endforeach 
                            </span>
                        </div>
                    </div>
                </div>
                <div class="par-content">
                    <table class="propery-table">
                        <thead>
                            <tr class="propery-table-header">
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Description</th>
                                <th>Property Number</th>
                                <th>Date Acquired</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $equipment)
                            <tr style="">
                            <td style="vertical-align:top;"><hr style="height:2px; visibility:hidden;" />{{ $equipment->quantity }}</td>
                            <td style="text-align: left; font-size:12px; vertical-align:top;"><hr style="height:5px; visibility:hidden;" />{{ $equipment->component_umeasure }}</td>
                            <td style="vertical-align:top;">{{ $equipment->component_name }}<br/><br/>{{ $equipment->remarks }}<br/>SN: {{ $equipment->serial_num }}<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
                            <td style="text-align: center; vertical-align:top;">{{ $equipment->property_number }}<br/><br/>{{ $equipment->property_number_1 }}<br/><br/>{{ $equipment->property_number_2 }}</td>
                            <td style="text-align: center; vertical-align:top;">{{ date('d M y', strtotime($equipment->date_acquired)) }}</td>
                            <td style="vertical-align:top;"> {{ number_format($equipment->amount, 2) }}</td>
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
                                <span>
                                    P.O. / PCV No. :
                                </span>
                               
                               <!-- PO/PCV No. -->
                                <span>
                                @foreach ($data as $index => $equipment)
           						@if($index == 0)
      					        {{ $equipment->remarks_po_num }} dated {{ $equipment->remarks_po_date }}
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
                                  &nbsp;
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>


                        <div class="received-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Issued by:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-name font-weight-bold text-upper">
                                   GLENDA P. LANTACON
                                </div>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of Supply and/or Property Custodian
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-position font-weight-bold text-upper">
                                Administrative Officer V / FAD-Property Section
                                </div>
                                <div class="border-top-black-1">
                                    Position / Office
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-date font-weight-bold text-upper">
                                    &nbsp;
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
