<style>
  body
  {
    font-size: 13px;
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
<p style="text-align: center;"><strong>SEMI-EXPENDABLE LEDGER CARD</strong></p>
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
            <td style="vertical-align:top;">{{ $equipment->ics_number }}</td>
            <td style="text-align: left; font-size:10px; vertical-align:top;">{{ $equipment->responsibility_center_code }}</td>
            <td style="vertical-align:top;">{{ $equipment->property_number }}</td>
            <td style="text-align: left; vertical-align:top;">{{ $equipment->component_name }}</td>
            <td style="vertical-align:top;"> {{ $equipment->ics_umeasure }}</td>
            <td style="vertical-align:top;"> {{ $equipment->quantity }}</td>
            <td style="vertical-align:top;"> {{ number_format($equipment->unit_cost, 2) }}</td>
            <td style="vertical-align:top;"> {{ number_format($equipment->unit_cost, 2) }}</td>
            </tr>
            @endforeach
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