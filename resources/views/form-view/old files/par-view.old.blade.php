<!DOCTYPE html>
<html lang="en">
    <head>
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
            /* body {
                margin : 15px 15px 20px 15px;
                font-family: "Arial", Times, serif;
                font-size: 12px;
            }
            section {
                padding: 1em 0;
            } */

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
            /* table tr td,
            table tr th {
                border: 1px solid black;
                text-align: center;
                padding-right: 1em;
                padding-left: 1em;
            }

            table tr td {
                padding: 1.5em;
            } */
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
                         
                            </span>
                        </div>
                        <div>
                            <span class="font-weight-bold">
                                PAR No. : 
                            </span>
                            <span class="text-underline par-header-info par-no">
                         
                            </span>
                        </div>
                    </div>
                </div>
                <div style="float:right;">
                <h7>Add Components <a href="#" class="btn btn-primary btn-sm" id="addComponents" onclick="addComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7></div><br/>
                <div class="par-content">
                <div style="width:100%; overflow-x:auto;">
                    <table id="property-table" class="property-table"  style="border: 1px solid black;  text-align: center;">
                        <thead class="solid-borders">
                            <tr class="solid-borders">
                                <th class="solid-borders">Quantity</th>
                                <th class="solid-borders">Unit</th>
                                <th class="solid-borders">Description</th>
                                <th class="solid-borders">Property Number</th>
                                <th class="solid-borders">Date Acquired</th>
                                <th class="solid-borders">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                         <!-- Appended contents appear here. -->
                        </tbody>
                    </table>
                   </div>
                    <div class="property-remarks border-black-1">
                        <div>
                            <span class="text-upper font-weight-bold">
                                Remarks
                            </span>
                        </div>
                        <div class="remarks-details">
                            <div class="remarks-row">
                             <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Purchased From </label></div>
                                <div class="col-12 col-md-5">
                                    <input type="text" placeholder="Purchased From" name="remarks_from" id="remarks_from" class="form-control" required>
                                </div>
                                <input type="checkbox" id="remarks_from_check" name="remarks_from_check" value="No Purchased From">
                                <label style="padding-top:5px;" for="remarks_from_check"> <small>&nbsp;No Purchased From Data</small></label><br>
                            </div>
                            </div>
                            <div class="remarks-row">
                                        <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" placeholder="Sales Invoice No." name="remarks_sales" id="remarks_sales" class="form-control" required>
                                    </div>
                                    <input type="checkbox" id="remarks_sales_check" name="remarks_sales_check" value="No Sales Invoice No. Data">
                                    <label style="padding-top:5px;" for="remarks_sales_check"> <small>&nbsp;No Sales Invoice No. Data</small></label><br>
                                </div>
                                        </div>
                            <div class="remarks-row">
                                    <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" placeholder="PO/PCV No." name="remarks_po_num" id="remarks_po_num" class="form-control" required>
                                    </div>
                                    <input type="checkbox" id="remarks_po_num_check" name="remarks_po_num_check" value="No PO/PCV No. Data">
                                    <label style="padding-top:5px;" for="remarks_po_num_check"> <small>&nbsp;No PO/PCV No. Data</small></label><br>
                                    </div>
                            </div>
                            <div class="remarks-row">
                                    <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">No. </label></div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" placeholder="PR No." name="remarks_pr_num" id="remarks_pr_num" class="form-control" required> 
                                    </div>
                                    <input type="checkbox" id="remarks_pr_num_check" name="remarks_pr_num_check" value="No PR No. Data">
                                    <label style="padding-top:5px;" for="remarks_pr_num_check"> <small>&nbsp;No PR No. Data</small></label><br>
                                    </div>
                            </div>
                            <div class="remarks-row">
                                <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Charged to</label></div>
                                <div class="col-12 col-md-5">
                                    <input type="text" placeholder="Charged to" name="remarks_charged" id="remarks_charged" class="form-control" required>
                                </div>
                                <input type="checkbox" id="remarks_charged_check" name="remarks_charged_check" value="No Charged to Data">
                                <label style="padding-top:5px;" for="remarks_charged_check"> <small>&nbsp;No Charged to Data</small></label><br>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="signatories flex-container">
                        <div class="received-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Received by:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <div class="received-by-name font-weight-bold text-upper">
                                   GLENDA P. LANTACON
                                </div>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of End User
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
                                 
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>
                        <div class="issued-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Issued to:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-name font-weight-bold text-upper">
                               
            					<span style="text-transform: uppercase;"> </span>
            					
                                </div>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of End User
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-position font-weight-bold text-upper">
                               
                                </div>
                                <div class="border-top-black-1">
                                    Position / Office
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div class="issued-by-date font-weight-bold text-upper">
                                 
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


