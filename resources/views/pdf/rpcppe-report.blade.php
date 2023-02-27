<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        </style>
        <title>RPCPPE</title>
        <style>
             
            {
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
                max-width: 1000px;
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

            .float-right {
               float: right;
            }

            .text-right {
                text-align: right;
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
                width: 100px;
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
                padding:0.3em;
            }
            .property-remarks {
                padding: 1em 0 1em 1em;
            }
            .remarks-details {
                padding-left: 7em;
            }

            .signatories > div {
                flex: 0 0 54.5%;
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
    
      
        <div class="container">
        <p style="float:right;"><em><span>Appendix 73</span></em></p>
           <center>
                <div class="text-upper font-weight-bold par-title">
               
                REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT<br/>
                </div>
                <strong>
                @foreach ($data as $index => $equipment)
                @if($index == 0)
                {{ $equipment->component_classification }}
                @endif
                @endforeach
                </strong>
                <br/>
                (Type of Property, Plant, and Equipment)<br/>
                <strong>
                As of December 31, 2022
                </strong>
        </center> 		
  

            <section class="content">
                <div class="par-header">
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
                            </span><br/>
                            For which  Dr. Reynaldo V. Ebora, Executive Director, PCAARRD-DOST is accountable, having assumed such accountability on February 16, 2015.		
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="par-content">
                <center>
                <table style="border-collapse: collapse;" border="1">
                <tbody>
                    <thead>
                    <tr> 
                    <th rowspan="2">ARTICLE</th>
                    <th rowspan="2">DESCRIPTION</th>
                    <th rowspan="2">PROPERTY NUMBER</th>
                    <th rowspan="2">UNIT OF MEASURE</th>
                    <th rowspan="2">UNIT VALUE</th>
                    <th rowspan="2">QUANTITY per PROPERTY CARD</th>
                    <th rowspan="2">QUANTITY per PHYSICAL COUNT</th>
                    <th colspan="2">SHORTAGE/OVERAGE</th>
                    <th rowspan="2">REMARKS</th>      
                    </tr>
                    <tr>
                    <th rowspan="1">Quantity</th>
                    <th rowspan="1">Value</th>
                    </tr>
                    </thead>
                    @foreach ($data as $equipment)
                    <tr style="">
                    <td style="width:100%;vertical-align:top;">{{ $equipment->component_subclass }}</td>
                    <td style="text-align: left; font-size:12px; vertical-align:top;">{{ $equipment->component_name }}</td>
                    <td style="vertical-align:top;">{{ $equipment->property_number }}</td>
                    <td style="text-align: center; vertical-align:top;">{{ $equipment->component_umeasure }}</td>
                    <td style="vertical-align:top;"> {{ number_format($equipment->amount, 2) }}</td>
                    <td style="vertical-align:top;"> {{ $equipment->quantity }}</td>
                    <td style="vertical-align:top;"> {{ $equipment->quantity }}</td>
                    <td style="vertical-align:top;"> - </td>
                    <td style="vertical-align:top;"> - </td>
                    <td style="vertical-align:top;"> {{ $equipment->remarks }}</td>
                    </tr>
                    @endforeach
                    <tr>
                    <td style="vertical-align:top;"> </td>
                    <td style="vertical-align:top;"> </td>
                    <td style="vertical-align:top;"> </td>
                    <td style="vertical-align:top;"><strong>Total</strong></td>
                    <td style="vertical-align:top;">{{ number_format($unit_value_sum, 2)  }}</td>
                    <td style="vertical-align:top;">{{ $quantity }}</td>
                    <td style="vertical-align:top;">{{ $quantity }}</td>
                    <td style="vertical-align:top;"> </td>
                    <td style="vertical-align:top;"> </td>
                    <td style="vertical-align:top;"> </td>
           
                    </tr> 
                </tbody>
               <tr>
               </tr>  
               <tr> 
                    <td colspan="3" style="text-align:left; padding: 0.2!important;">
                    Certified Correct by:
                    @foreach ($certified_by as $certified_by)  
                    <br/>
                    <br/>
                    <div class="text-center"> <strong>{{ $certified_by->fullname }}</strong></div>
                    <br/> 
                    @endforeach
                    <br/>
                    <div class="text-center"> 
                    <strong> GLENDA P. LANTACON</strong>
                    <br/>
                    <small>Signature over Printed Name of Inventory Committee Chair and Members
                    </small>
                    </div>
                    </td>

                    <td colspan="4" rowspan="5" style="text-align:left; padding: 0.5!important;">
                    Approved by:
                     <br/> <br/> <br/><br/> <br/> <br/> <br/> <br/>
                    <div class="text-center"> 
                    <strong>REYNALDO V. EBORA</strong>
                    <br/>
                    <small>Signature over Printed Name of Head of Agency/Entity or Authorized Representative
                    </small>
                    </div>
                    <br/>
                    </td>

                    <td colspan="4" rowspan="5" style="text-align:left; padding: 0.5!important;">
                    Verified by:
                     <br/> <br/> <br/><br/> <br/> <br/> <br/> <br/>
                    <div class="text-center"> 
                    <strong>EDLYNE A. ROSETE</strong>
                    <br/>
                    <small>Signature over Printerd Name of COA Representative
                    </small>
                    <br/><br/>
                    </div>
                 
                    </td>
                </tr>
               
               </table>
               </center>
            </section>
        </div>
                    
    </body>
</html>
