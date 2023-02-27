<style>
  body
  {
    font-size: 14px;
  }

  td
  {
    font-size: 13px;
  }

 .td
 {
   display: table-cell;
 }

 .colspan3
 {
   width: 860px; /*3 times the standard cell width of 100px - colspan3 */
 }
 
</style>
<body>
<p style="text-align: right;"><em><strong>Annex A.1</strong></em></p>
<p style="text-align: center;"><strong>SEMI EXPENDABLE PROPERTY CARD</strong></p>
<table border="1" style="width:100%; border-collapse: collapse;">

<div style="height:30px;"
<div class = 'td colspan3 '>Entity Name: Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)</div>
<div class = 'td'>Fund Cluster: {{ $data[0]->fund_cluster }}
 </div>
</div>

<tbody>

<tr>
<td colspan="8"><strong>Semi-Expendable Property:</strong> {{ $data[0]->component_classification }}</td>
<td colspan="3" rowspan="2"><strong> Property Number: </strong>{{ $data[0]->property_number }}</td>
</tr>
<tr>
<td colspan="8"><strong>Description:</strong> {{ $data[0]->component_name }}<br/>SN: {{ $data[0]->serial_num }}</td>
</tr>
<!-- Headers -->
<tr>
<td style="text-align: center;" rowspan="2"><strong>Date</strong></td>
<td style="text-align: center;" rowspan="2"><strong>Reference</strong></td>
<td style="text-align: center;" colspan="3"><strong>Receipt</strong></td>
<td style="text-align: center;" colspan="3"><strong>Issue/Transfer/Disposal</strong></td>
<td style="text-align: center;"><strong>Balance</strong></td>
<td style="text-align: center;" rowspan="2"><strong>Amount</strong></td>
<td style="text-align: center;" rowspan="2"><strong>Remarks</strong></td>
</tr>
<tr>
<td style="text-align: center;">Qty.</td>
<td style="text-align: center;">Unit Cost</td>
<td style="text-align: center;">Total Cost</td>
<td style="text-align: center;">Item No.</td>
<td style="text-align: center;">Qty.</td>
<td style="text-align: center;">Office/Officer</td>
<td style="text-align: center;">Qty.</td>
<!-- End Headers -->

</tr>
<tr>
  <!-- Date of Sales -->
<td>  
  <center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->remarks_sales_date }}
  @endfor @endforeach   
  </center>
</td>

<!-- Reference -->
<td>
Sales Invoice No.
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->remarks_sales }}
  @endfor @endforeach  
</td>

<!-- Quantity -->
<td>
  <center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  <br/>{{ $equipment->quantity }}<br/><br/>
  @endfor @endforeach
  </center>
</td>

<!-- Unit Cost -->
<td>
<center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  <br/>{{ number_format($equipment->unit_cost, 2) }}<br/><br/>
  @endfor @endforeach
</center>
</td>

<!-- Total Cost -->
<td>
<center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  <br/>{{ number_format($equipment->unit_cost, 2) }}<br/><br/>
  @endfor @endforeach
</center>
</td>
</td>
<td>
  <!-- Item No. (ITD) -->
</td>
<td>
  <!-- Quantity (ITD) -->
</td>
<td>
  <!-- Office/Officer (ITD) -->
</td>

<!-- Quantity (Balance) -->
<td>
<center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  <br/>{{ $equipment->quantity }}<br/><br/>
  @endfor @endforeach
</center>

</td>

<!-- Amount -->
<td>
<center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  <br/>{{ number_format($equipment->unit_cost, 2) }}<br/><br/>
  @endfor @endforeach
</center>  
</td>

<!-- Remarks -->
<td>

</td>
</tr>
<tr>

  <!-- Date of ICS -->
<td>  
  <center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->date_ics }}
  @endfor @endforeach   
  </center>
</td>

<!-- ICS Number -->
<td>  
ICS No.   
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->ics_number }}
  @endfor @endforeach   
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<!-- Inventory Item No. -->
<td>  
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->inventory_item_number }}
  @endfor @endforeach   
</td>
<!-- Quantity -->
<td>  
  <center>
  @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->quantity }}
  @endfor @endforeach   
</center>
</td>
<td> @foreach ($data as $equipment) 
  @for ($i = 0; $i <= 0; $i++) 
  {{ $equipment->fullname }}
  @endfor @endforeach   </td>
<td>
<center>
  0
</td>
<td>
<center>
  -
</center>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
</tr>
</tbody>
</table>
</body>
<script>
var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

style.type = 'text/css';
style.media = 'print';

if (style.styleSheet){
  style.styleSheet.cssText = css;
} else {
  style.appendChild(document.createTextNode(css));
}

head.appendChild(style);

window.print();
</script>    