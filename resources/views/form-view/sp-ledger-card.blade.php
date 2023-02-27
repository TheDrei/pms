<style>
  body
  {
    font-size: 13px;
  }

  .ledgercard_details
  {
    background-color:#d3d3d3;
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

<div style = "overflow-y:scroll"> 
    <table border="1" style="width:100%; border-collapse: collapse; overflow-y:scroll;">
        <div style="height:30px;"
        <div class = 'td colspan3 '>Entity Name: Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)</div>
        <div class = 'td'>Fund Cluster: <input style="border:none;" name="ledger_fundcluster" id="ledger_fundcluster" type="text" class="col-md-6">
        </div>
        </div>
            <tbody>
            <tr>
            <td colspan="8"><strong>Semi-Expendable Property: <input style="border:none;" name="ledger_classification" id="ledger_classification" type="text" class="col-md-6"></strong>  </td>
            <td colspan="6" rowspan="1"><strong> Semi-Expendable Property Number: </strong> <input style="border:none;" name="ledger_property_number" id="ledger_property_number" type="text" class="col-md-6"> </td>
            </tr>

            <tr>
            <td colspan="8"><strong>Description:</strong> <input style="border:none;" name="ledger_description" id="ledger_description" type="text" class="col-md-6"> </td>
            <td class="ledgercard_details" colspan="2" rowspan="1"><strong> UACS Object Code:</strong> <input style="border:none;" name="ledger_uacs_code" id="ledger_uacs_code" type="text" class="col-md-6"></td>
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
                <td class="ledgercard_details"><input type="date" style="border:none;" name="ledger_date" id="ledger_date" value="" required></td>
                <td class="ledgercard_details"><input type="text" style="border:none;" name="ledger_reference" id="ledger_reference" required></td>
                <td><input type="number" style="border:none;" name="ledger_unit_cost" id="ledger_unit_cost" required></td>
                <td><input type="number" style="border:none;" name="ledger_total_cost" id="ledger_total_cost" required></td>
                <td><input type="number" style="border:none; text-align-center;" name="ledger_quantity" id="ledger_quantity" required></td>
                <td class="ledgercard_details" colspan="3"><textarea type="text" style="border:none;" name="ledger_issues_transfer_adjustments" id="ledger_issues_transfer_adjustments" required></textarea></td>
                <td class="ledgercard_details"><textarea type="text" style="border:none;" name="ledger_accumulated_impairment_losses" id="ledger_accumulated_impairment_losses" required></textarea></td>
                <td class="ledgercard_details" colspan="1"><input type="number" style="border:none;" name="ledger_adjusted_cost" id="ledger_adjusted_cost" required></td>
                <td class="ledgercard_details" colspan="2"><input  type="text" style="border:none;" name="ledger_nature_of_repair" id="ledger_nature_of_repair" required></td>
                <td class="ledgercard_details" colspan="1"><input  type="number" style="border:none;" name="ledger_amount" id="ledger_amount" required></td>
            </tr>
            @for ($i = 0; $i < 17; $i++)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="3"></td>
                <td></td>
                <td colspan="1"></td>
                <td colspan="2"></td>
                <td colspan="1"></td>
            </tr>
            @endfor    
            </tbody>
</table>
</div> 
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