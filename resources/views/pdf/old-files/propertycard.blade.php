<!DOCTYPE html>
<html>
<head>
<style>
 @page { size: landscape; }
 @font-face {
    font-family: 'Arial Narrow';
  }

  .text-center{
    text-align:center;
  }

  body {
    font-family: Arial, sans-serif;
  }

  td {
    font-size: 12px;
    padding:0.8em;
     
  }

  .custom-td
  {
    color: black; 
    font-size: 14px; 
    font-weight: 400; 
    font-style: normal; 
    text-decoration: none; 
     vertical-align: top; 
     border-image: initial; 
     border: 1pt solid black;
  }
</style>
<title>Property Card</title>
</head>
<div style = "text-align:center;"><strong>PROPERTY CARD</strong></div><br/>
<div style = "float:left;">Entity Name: <strong>DOST-PCAARRD</strong></div>
<div style = "float:right;">Fund Cluster: 
@foreach ($data as $index => $equipment)
 @if($index == 0)
{{ $equipment->fund_cluster }}
@endif
@endforeach
</div>

<!-- TABLE HERE -->
<center>
<br/>
<br/>
<table style="border-collapse:collapse; width:100%;" >
    <tbody>
        <tr>
            <td colspan="3" style="" class="custom-td">Property, Plant and Equipment:</td>
            <td colspan="4" style="" class="custom-td">
            @foreach ($data as $equipment)
            @for ($i = 0; $i <= 0; $i++)
            {{ $equipment->component_classification }}<br/>
            @endfor
            @endforeach
            </td>
            <td style="border-bottom:none!important; padding-top:1em!important;" class="custom-td">Property Number:</td>
        </tr>
        <tr>
            <td colspan="3" style="" class="custom-td">Description:</td>
            <td colspan="4" style="" class="custom-td"> @foreach ($data as $equipment)
            @for ($i = 0; $i <= 0; $i++)
            {{ $equipment->component_name }}<br/>SN: {{ $equipment->serial_num }}<br><br><br><br><br><br><br><br><br>
            @endfor
            @endforeach
            </td>
            
            <td style="border-top:none!important; font-weight:bold; text-align:center; vertical-align:top; padding-bottom:1em;" class="custom-td"> 
            @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->property_number }}<br/><br/>
            {{ $equipment->property_number_1 }}<br/><br/>
            {{ $equipment->property_number_2 }}
            @endif
            @endforeach
            </td>
        </tr>
       
        <tr style="text-align:center;">
            <td rowspan="2" style="font-weight:bold;" class="custom-td">DATE</td>
            <td rowspan="2" style="font-weight:bold;" class="custom-td">REFERENCE / PAR No.</td>
            <td style="font-weight:bold;" class="custom-td">RECEIPT</td>
            <td colspan="2" style="font-weight:bold;" class="custom-td">ISSUE / TRANSFER / DISPOSAL</td>
            <td style="font-weight:bold;" class="custom-td">BALANCE</td>
            <td rowspan="2" style="font-weight:bold;" class="custom-td">&nbsp;AMOUNT&nbsp;</td>
            <td rowspan="2" style="font-weight:bold;" class="custom-td">REMARKS</td>
        </tr>
        <tr style="text-align:center;">
            <td style="" class="custom-td">Quantity</td>
            <td style="" class="custom-td">Quantity</td>
            <td style="" class="custom-td">OFFICE / OFFICER</td>
            <td style="" class="custom-td">Quantity</td>
        </tr>
        <tr>
            <td style="" class="custom-td text-center"> 
              {{ date('d M y', strtotime($equipment->created_at)) }}
            <br>
            </td>

            <td style="" class="custom-td text-center">@foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->par_number }}
            @endif
            @endforeach<br>
            </td>

            <td style="" class="custom-td text-center"> @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->quantity }}
            @endif
            @endforeach
            </td>

            <td style="" class="custom-td text-center"> @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->quantity }}
            @endif
            @endforeach<br>
            </td>

            <td style="" class="custom-td text-left">  @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->position}}
            @endif
            @endforeach/@foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->division}}
            @endif
            @endforeach<br>  @foreach ($data as $index => $equipment)
            @if($index == 0)
            <span style="text-transform: uppercase;"> {{ $equipment->fullname}} 
            @endif
            @endforeach<br>
            </td>

            <td style="" class="custom-td text-center"> 
              0
             <!-- @foreach ($data as $index => $equipment) -->
            <!-- @if($index == 0)
            {{ $equipment->quantity }}
            @endif
            @endforeach -->
            </td>

            <td style="" class="custom-td text-center"><div align="center"> @foreach ($data as $index => $equipment)
              @if($index == 0)
              {{ number_format($equipment->amount, 2) }}
            @endif
            @endforeach</div>
            </td>

            <td style="" class="custom-td">Purchased from: @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_from }}
            @endif
          @endforeach<br>Sales Invoice No.:&nbsp; @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_sales }}
            @endif
          @endforeach dated @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_sales_date }}
            @endif
          @endforeach<br>P.O. / PCV#: @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_po_num }}
            @endif
          @endforeach dated  @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_po_date }}
            @endif
          @endforeach<br>P.R.# : @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_pr_num }}
            @endif
          @endforeach dated @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_pr_date }}
            @endif
          @endforeach<br>Charged to: @foreach ($data as $index => $equipment)
            @if($index == 0)
            {{ $equipment->remarks_charged }}
            @endif
          @endforeach
          </td>
        
        </tr>
      
    </tbody>
</table>
</center>
</body>

<script type="text/javascript">
// <!--
window.print();
//-->
</script>
</html>