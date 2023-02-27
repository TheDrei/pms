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
            .solid-borders {
                border-top:1px solid black!important;
                border-left:1px solid black!important;
                border-right:1px solid black!important;
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
           
            table tr td {
                padding: 1em;
            } 
            .property-remarks {
                padding: 1em 0 1em 1em;
            }
            .remarks-details {
                padding-left: 4em;
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
        <div class="container">
            <section class="header text-center">
                <p class="text-upper font-weight-bold par-title">
                 Inventory Transfer Report
                </p>
            </section>
            <section class="content">
                <div class="par-header">
                    <div class="header-row flex-container">
                         <div class="flex-grow-1">
                            <span class="font-weight-bold">
                                Entity Name :
                            </span>
                            <span class="text-underline par-header-info entity-name">
                             <strong> DOST-PCAARRD </strong>
                            </span>
                        </div>
                        <div class="flex-grow-2">
                            <span class="font-weight-bold">
                             Fund Cluster :
                            </span>
                            <span class="par-header-info entity-name">
                            <select name="itr_fund_cluster" id="itr_fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control" required>
                                        <option value="" disabled selected>Select a Fund Cluster</option>
                            </select>
                            </span>
                        </div>
                    </div>

                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                 From Accountable Officer/Agency/Fund Cluster:
                                </div>
                                <div style="width:300px;">
                                 <input class="form-control" placeholder="From Accountable Officer/Agency/Fund Cluster" name='from_accountable_officer' id="from_accountable_officer" required>
                                </div>
                        
                         </div>
                         <div>
                               <div class="font-weight-bold">
                                 ITR No:
                                </div>
                                <div style="width:300px;">
                                 <input class="form-control" placeholder="ITR No." name='to_accountable_officer' id="to_accountable_officer" required>
                                </div>
                          </div>
                    </div>

                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                  To Accountable Officer/Agency/Fund Cluster:
                                </div>
                                <div style="width:300px;">
                                 <input class="form-control" placeholder="To Accountable Officer/Agency/Fund Cluster" name='itr_number' id="itr_number" required>
                                </div>
                    </div>

                    <div>
                            <div class="font-weight-bold">
                            Date
                            </div>

                            <div style="width:300px;">
                            <input class="form-control" type="date" placeholder="date" name='itr_date' id="itr_date" required>
                            </div>
                         </div>
                    </div>
                    
                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                  Transfer Type
                                </div>
                                <div style="width:300px;">
                                    <select name="itr_fund_cluster" id="itr_fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control" required>
                                    <option value="" disabled selected>Select a Fund Cluster</option>
                                    </select>
                                </div>
                         </div>
                    </div>
                </div>
            </section>
            <section style="padding-left:0px; padding-right:50px;">
            <table border="1" cellpadding="1" cellspacing="1" style="width:100%; border-collapse:collapse;">
                <tbody>
                    <tr>
                        <td style="text-align:center"><strong>Date Acquired</strong></td>
                        <td style="text-align:center"><strong>Item No.</strong></td>
                        <td style="text-align:center"><strong>ICS No./ Date</strong></td>
                        <td style="text-align:center"><strong>Description</strong></td>
                        <td style="text-align:center"><strong>Amount</strong></td>
                        <td style="text-align:center"><strong>Condition of Inventory</strong></td>
                    </tr>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td><input style="border:none;" type="date" name="itr_date_acquired[]" id="itr_date_acquired_{{$i}}"></td>
                        <td><input style="border:none;" type="text" name="itr_item_number[]" id="itr_item_number_{{$i}}"></td>
                        <td><input style="border:none;" type="text" name="itr_ics_number[]" id="itr_ics_number_{{$i}}"></td>
                        <td><input style="border:none;" type="text" name="itr_description[]" id="itr_description_{{$i}}"></td>
                        <td><input style="border:none;" type="text" name="itr_amount[]" id="itr_amount_{{$i}}"></td>
                        <td><input style="border:none; width:100px;" type="text" name="itr_condition[]" id="itr_condition_{{$i}}"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            </section>
        </div>

          
    </body>
</html>