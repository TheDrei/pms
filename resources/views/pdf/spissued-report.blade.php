<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        </style>
        <title>Report of SP Issued</title>
        <style>
            .small-font{
                font-size:9px;
            }
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                /* margin : 15px 15px 20px 15px; */
                font-family: "Arial", Times, serif;
                font-size: 12px;
            }
            section {
                padding: 1em 0;
            }

            .container {
                max-width: 1000px;
                border-collapse: collapse;
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
            .text-right {
                float: right;
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
                /* margin: 0.5em 0; */
            }
            .remarks-row {
                padding: 0.3em 0;
            }
            .par-title {
                font-size: 14px;
            }
            .par-content {
                width:100%;
                padding: 1em 0;
            }
          
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table tr td,
            table tr th {
                border: 1px solid black;
                text-align: center;
            }

            table tr td {
                padding:1.5em;
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
        <div class = "container ">
        <div class="container">
            <p class="text-right par-title ">
            <small>Annex A.7</small>
            </p>
            <section class="header text-center">
                <p class="text-upper font-weight-bold par-title ">
                REPORT OF SEMI-EXPENDABLE PROPERTY ISSUED
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

                            <span class="text-right">
                            <span class="font-weight-bold">
                                Serial No.
                            </span>
                            {{ $rspi_serial_number }}
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
                             {{ $equipment->fund_cluster }}
                             @endif
                             @endforeach
                            </span>
                        </div>
                       
                        <div >
                            <span class="font-weight-bold">
                            Date:
                            </span>
                            <span class="par-header-info par-no">
                            {{ $date }}
                            </span>
                            <br/>
                        </div>
                    </div>
                    <span class="text-right">
                            (Issued {{ $date_range }} )
                    </span>
                </div>
            </div>

        <div class="par-content" >
        
        <table style="border-collapse: collapse; width: 100%; height: 180px;" border="1">
        <tbody>
            <thead>
            <tr> 
            <th colspan="6"><em>To be filled out by the Property and/or Supply Division/Unit</em></th>
            <th colspan="2"><em>To be filled out by the Accounting Division/Unit</em></th>
            </tr>
            <tr> 
            <th rowspan="1">ICS No.</th>
            <th rowspan="1">Responsibility Center Code</th>
            <th colspan="1">Semi-Expendable Property No.</th>
            <th rowspan="1">Item Description</th>
            <th rowspan="1">Unit</th>
            <th rowspan="1">Quantity Issued</th>
            <th rowspan="1">Unit Cost</th>
            <th rowspan="1">Amount</th>                     
            </tr>
            </thead>
            @foreach ($data as $equipment)
            <tr style="">
            <td style="vertical-align:top;border:none;">{{ $equipment->ics_number }}</td>
            <td style="text-align: left; font-size:10px; vertical-align:top;border-top:none;border-bottom:none;">{{ $equipment->responsibility_center_code }}</td>
            <td style="vertical-align:top;border-top:none;border-bottom:none;">{{ $equipment->property_number }}</td>
            <td style="text-align: left; vertical-align:top;border-top:none;border-bottom:none;">{{ $equipment->component_name }}</td>
            <td style="vertical-align:top;border-top:none;border-bottom:none;"> {{ $equipment->ics_umeasure }}</td>
            <td style="vertical-align:top;border-top:none;border-bottom:none;"> {{ $equipment->quantity }}</td>
            <td style="vertical-align:top;border-top:none;border-bottom:none;"> {{ number_format($equipment->unit_cost, 2) }}</td>
            <td style="vertical-align:top;border-top:none;border-bottom:none;"> {{ number_format($equipment->unit_cost, 2) }}</td>
            </tr>
       
            @endforeach
          
        </tbody>
        </table>
         <div class="signatories flex-container">

         <div class="received-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                I hereby certify to the correctness of the above information:
                                </span>
                            </div>
                            <br/><br/>
                            <div class="signatory-info">
                                <div style="text-align:center;" class="received-by-name font-weight-bold text-upper">
                                   GLENDA P. LANTACON
                                </div>
                                <div style="text-align:center;" class="border-top-black-1">
                                    Signature Over Printed Name of Property Officer
                                </div>
                            </div>
                         
                        </div>
                        
                        <div class="issued-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                               Posted by:
                                </span>
                            </div>
                            <br/>
                            <div class="signatory-info">
                                <div class="text-center issued-by-name font-weight-bold text-upper">
                                @foreach ($data as $index => $equipment)
           						@if($index == 0)
            					<!-- <span style="text-transform: uppercase;"> {{ $equipment->fullname}} </span> -->
            					@endif
            					@endforeach
                                </div>
                                <div class="text-center border-top-black-1">
                                    Signature Over Printed Name of Designated Accounting Staff
                                </div>
                            </div>
                            
                            <div class="signatory-info">
                                <div class="text-center  issued-by-date font-weight-bold text-upper">
                                  {{$date}}
                                </div>
                                <div class="text-center border-top-black-1">
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


<script>
// window.print();
</script> 
