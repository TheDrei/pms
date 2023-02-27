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
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
        
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
                    Inventory Custodian Slip
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
                    <input class="form-control" type="hidden" name="update_fullname" id="update_fullname" required>
                    <input class="form-control" type="hidden" name="update_position" id="update_position" required>
                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                   Fund Cluster:
                                </div>
                                <div style="width:300px;">
                                <select name="update_fund_cluster" id="update_fund_cluster" data-placeholder="Choose a Fund Cluster" class="form-control" required>
                                        <option value="" disabled selected>Select a Fund Cluster</option>
                                 </select>
                                </div>
                              
                    </div>
                    <div>
                               <div class="font-weight-bold">
                                    ICS No.
                                </div>
                                <div style="width:300px;">
                                    <input class="form-control" placeholder="ICS No." name='update_ics_number' id="update_ics_number" required>
                                 
                                </div>
                               
                            </div>
                    </div>

                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                  ICS Type
                                </div>
                                <div style="width:300px;">
                                <select name="update_ics_type" id="update_ics_type" data-placeholder="Choose an ICS Type" class="form-control" required>
                                        <option value="" disabled selected>Select an ICS Type</option>
                                        <option value="PO">PO</option>
                                        <option value="PCV">PCV</option>
                                        <option value="Reimbursement">Reimbursement</option>
                                        <option value="Contract">Contract</option>
                                 </select>
                                </div>
                    </div>
                    <div>
                         <div class="font-weight-bold">
                                   Location
                         </div>

                                <div style="width:300px;">
                                    <input class="form-control" placeholder="Location" name='update_location' id="update_location" required>
                                </div>

                              
                         </div>
                    </div>

                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                  Property No. <a href="#" class="btn btn-primary btn-sm" id="editAddPropertyNumber" style="border-radius: 200px;"><i class="fa fa-plus"></i></a>
                                </div>
                                <div style="width:300px;">
                                <input class="form-control" placeholder="Property No." name='update_property_number' id="update_property_number" required>
                                </div>

                                <div style="width:300px;" class="update_property_numbers">

                                </div>
                         </div>
                           
                         <div>
                               <div class="font-weight-bold">
                                   Unit of Measure
                                </div>
                                <div style="width:300px;">
                                <select name="update_prop_umeasure" id="update_prop_umeasure" data-placeholder="Choose a Unit of Measure..." class="form-control" required>
                                        <option value="" disabled selected>Select Unit of Measure</option>
                                        <option value="unit">unit</option>
                                        <option value="set">set</option>
                                </select>
                                </div>
                         </div>
                    </div>

                    <div class="header-row flex-container">
                        <div class="flex-grow-1">
                                <div class="font-weight-bold">
                                Date of ICS
                                </div>
                                <div style="width:300px;">
                                <input type="date" name="update_date_ics" id="update_date_ics" class="form-control" required>
                                </div>
                             
                        </div>
                        <div>
                               <div class="font-weight-bold">
                                Date Acquired 
                                </div>
                                <div style="width:300px;">
                                <input type="date" name="update_date_acquired" id="update_date_acquired" class="form-control" required>
                                </div>
                            
                            </div>
                    </div>
                </div>
                <div style="float:right;">
                <h7>Add Components <a href="#" class="btn btn-primary btn-sm" id="editAddComponents" onclick="editAddComponents(1)" style="border-radius: 100px"><i class="fa fa-plus"></i></a></h7></div><br/>
                <div class="par-content">
                <div style="width:100%; overflow-x:auto;">
                    <table id="edit-property-table" class="edit-property-table"  style="border: 1px solid black;  text-align: center;">
                        <thead class="solid-borders">
                            <tr class="solid-borders">
                                <th class="solid-borders">Inventory Item Number</th>
                                <th class="solid-borders">Sub-Category</th>
                                <th class="solid-borders">Category</th>
                                <th class="solid-borders">Description</th>
                                <th class="solid-borders">Quantity</th>
                                <th class="solid-borders">Sub-Property No.</th>
                                <th class="solid-borders">Serial No.</th>
                                <th class="solid-borders">Estimated Useful Life</th>
                                <th class="solid-borders">Unit Cost</th>
                                <th class="solid-borders">Issued to</th>
                                <th class="solid-borders">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                         <!-- Appended contents appear here. -->
                        </tbody>
                    </table>
                   </div>
                   <div class="solid-borders"><strong>&nbspTotal Cost: ₱<span id="update_total_cost"></span></strong></div>
                    <div class="property-remarks border-black-1">
                        <div>
                            <span class="text-upper font-weight-bold">
                                Remarks
                            </span>
                        </div>
                        <div class="remarks-details">
                        <div class="remarks-row">
                             <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">
                                    <strong>Purchased From</strong>
                                </label></div>
                                <div class="col-12 col-md-5">
                                    <input type="text" placeholder="Purchased From" name="update_remarks_from" id="update_remarks_from" class="form-control" required>
                                </div>
                           
                            </div>
                            </div>
                            
                            <div class="remarks-row">
                                <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">
                                <strong>Charged to</strong>
                                </label></div>
                                <div class="col-12 col-md-5">
                                    <input type="text" placeholder="Charged to" name="update_remarks_charged" id="update_remarks_charged" class="form-control" required>
                                </div>
                              
                       
                                </div>
                            </div>
                           <table style="border:none; border-collapse: collapse; width: 90%; padding:0.2em!important;" border="1">
                                <tbody>
                                <tr>
                                <td> </td>
                                <td><strong>No.</strong></td>
                                <td><strong>Date</strong></td>
                                </tr>
                                <tr style="width: 70%;">
                                <td><strong>Sales Invoice</strong></td>
                                <td> 
                                    <input type="text" placeholder="Sales Invoice No." name="update_remarks_sales" id="update_remarks_sales" class="form-control" >
                                
                                </td>
                                <td>  
                                    <input type="date" name="update_remarks_sales_date" id="update_remarks_sales_date" class="form-control" >
                                
                                </td>
                                </tr>
                                <tr>
                                <td><strong>PO/PCV</strong></td>
                                <td> 
                                    <input type="text" placeholder="PO/PCV No." name="update_remarks_po_num" id="update_remarks_po_num" class="form-control" >
                                 
                                  
                                </td>
                                <td> 
                                     <input type="date" name="update_remarks_po_date" id="update_remarks_po_date" class="form-control" >
                                
                                </td>
                                </tr>
                                <tr>
                                <td><strong>PR</strong></td>
                                <td> 
                                     <input type="text" placeholder="PR No." name="update_remarks_pr_num" id="update_remarks_pr_num" class="form-control" > 
                                 
                                </td>
                                <td> 
                                    <input type="date" name="update_remarks_pr_date" id="update_remarks_pr_date" class="form-control" >
                                
                                </td>
                                </tr>
                                </tbody>
                            </table>
                           
                        </div>
                        
                    </div>
                    <div class="signatories flex-container">
                        <div class="received-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Received from:
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
                                <div id="update-received-by-date" class="received-by-date font-weight-bold text-upper">
                                 
                                </div>
                                <div class="border-top-black-1">
                                    Date
                                </div>
                            </div>
                        </div>
                        <div class="issued-by-information border-black-1 signatory-container">
                            <div class="text-left">
                                <span>
                                    Received by:
                                </span>
                            </div>
                            <div class="signatory-info">
                                <select name="update_select_division" id="update_select_division" data-placeholder="Select a Division" class="form-control" required>
                                <option value="" disabled selected>Select Division</option>
                                </select>
                                <br/>
                            </div>
                            
                            <div class="text-center">
                            <select name="update_select_staff" id="update_select_staff" data-placeholder="Select a Staff" class="form-control" onchange="getDivision(this.value)" required>
                                <option value="" disabled selected>Select Staff</option>
                                </select>
                                <div class="border-top-black-1">
                                    Signature Over Printed Name of End User
                                </div>
                            </div>
                            <br/>

                            <div class="signatory-info">
                                <div class="issued-by-position font-weight-bold text-upper">
                                <span id="update_employee_position"></span>/<span id ="update_employee_division"></span>
                              
                                </div>
                                <div class="border-top-black-1">
                                    Position / Office
                                </div>
                            </div>
                            <div class="signatory-info">
                                <div id="update-issued-by-date" class="issued-by-date font-weight-bold text-upper">
                                 
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