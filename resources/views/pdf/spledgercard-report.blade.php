<!-- PDF -->
<style>
  body
  {
    font-size: 13px;
  }

  td
  {
    font-size: 11.5px;
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
<body >
<p style="text-align: right;"><strong>Annex A.1</strong></p>
<p style="text-align: center;"><strong>SEMI EXPENDABLE PROPERTY LEDGER CARD</strong></p>
@foreach ($data as $equipment)
    <table border="1" style="width:100%; border-collapse: collapse;">
        <div style="height:30px;"
        <div class = 'td colspan3 '>Entity Name: Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)</div>
        <div class = 'td'>Fund Cluster: <strong>{{ $equipment->fund_cluster }}</strong>
        </div>
        </div>
            <tbody>
            <tr>
            <td colspan="8"><strong>Semi-Expendable Property: {{ $equipment->component_classification }}  </td>
            <td colspan="6" rowspan="1"><strong> Semi-Expendable Property Number: </strong>{{ $equipment->property_number }}</td>
            </tr>

            <tr>
            <td colspan="8"><strong>Description:</strong> {{ $equipment->component_name }} </td>
            <td class="ledgercard_details" colspan="2" rowspan="1"><strong> UACS Object Code:</strong> {{ $equipment->ledger_uacs_code }}</td>
            <td colspan="4" rowspan="1"><strong> <center>Repair History</center> </strong> </td>
            </tr>
            <!-- Headers -->
            <tr>
            <td style="text-align: center;" rowspan="2"  colspan="1"><strong>Date</strong></td>
            <td style="text-align: center;" rowspan="2"  colspan="1"><strong>Reference</strong></td>
            <td style="text-align: center;" colspan="3"><strong>Receipt</strong></td>
            <td style="text-align: center;" rowspan="2" colspan="3"><strong>Issues/Transfer/Adjustment/s</strong></td>
            <td style="text-align: center;" rowspan="2" colspan="1"><strong>Accumulated Impairment Losses</strong></td>
            <td style="text-align: center;" rowspan="2" colspan="1"><strong>Adjusted Cost</strong></td>
            <td style="text-align: center;" colspan="2" rowspan="2"><strong>Nature of Repair</strong></td>
            <td style="text-align: center;" colspan="2"rowspan="2"><strong>Amount</strong></td>
            </tr>
            <tr>
            <td style="text-align: center;">Unit Cost</td>
            <td style="text-align: center;">Total Cost</td>
            <td style="text-align: center;">Qty.</td>
            <!-- End Headers -->
            </tr>
           
            <tr>
                <td class="ledgercard_details">{{ $equipment->ledger_date }}</td>
                <td class="ledgercard_details">{{ $equipment->ledger_reference }}</td>
                <td>{{ $equipment->unit_cost }}</td>
                <td>{{ $equipment->unit_cost }}</td>
                <td>{{ $equipment->quantity }}</td>
                <td class="ledgercard_details" colspan="3">{{ $equipment->ledger_issues_transfer_adjustments }}</td>
                <td class="ledgercard_details">{{ $equipment->ledger_accumulated_impairment_losses }}</td>
                <td class="ledgercard_details" colspan="1">{{ $equipment->ledger_adjusted_cost }}</td>
                <td class="ledgercard_details" colspan="2">{{ $equipment->ledger_nature_of_repair }}</td>
                <td class="ledgercard_details" colspan="1">{{ $equipment->ledger_amount }}</td>
            </tr>
            @endforeach
            @for ($i = 0; $i < 17; $i++)
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="3">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="1">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="1">&nbsp;</td>
            </tr>
            @endfor    
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


</script>    