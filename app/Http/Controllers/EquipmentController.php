<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use PDF;
use App\Equipment_Set_Components;
use App\ICS_Components;
use App\ICS_Items;
use Session;


class EquipmentController extends Controller
{
    public function __construct()
    {
     
        $this->middleware('auth');
    }

    public function index()
    {
       return View('equipment');
    }
  
    // Store ICS
    public function storeics2(Request $request)
    {
        try
        {
            if(isset($request->equip_serial_num)){ 
            $componentSet = [];
            $componentSet[] = [
            // 'position' => $request->position,
            'fullname' => $request->getstaffname,
            'position' => $request->employee_position_get,
            'fund_cluster' => $request->fund_cluster,
            'property_number' => $request->property_number,  
            'property_number_1' => isset($request->property_number_array[0]) ?  $request->property_number_array[0] : null,  
            'property_number_2' => isset($request->property_number_array[1]) ?  $request->property_number_array[1] : null,   
            'inventory_item_number' => $request->inventory_item_number[0],  
            'ics_number' =>$request->ics_number,  
            'ics_type' =>$request->ics_type, 
            'ics_category' =>$request->ics_category, 
            'pcv_by' =>$request->pcv_by,  
            'amount' => $request->amount,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->select_division,
            'location' => $request->location,
            'component_name' => $request->prop_component[0],
            'ics_umeasure' => $request->prop_umeasure,
            'quantity' => $request->component_quantity[0],
            'component_classification' => $request->equipment_category[0],
            'component_subclass' => $request->getSubcategory[0],
            'subclass_id' => $request->equip_subcat[0],
            'component_subpropertynumber' => $request->equip_subprop_num[0],
            'serial_num' => $request->equip_serial_num[0],
            'date_acquired' => $request->date_acquired,
            'date_ics' => $request->date_ics,
             'remarks_from' => $request->remarks_from,
             'remarks_sales' => $request->remarks_sales,
             'remarks_sales_date' => $request->remarks_sales_date,
             'remarks_po_num' => $request->remarks_po_num,
             'remarks_po_date' => $request->remarks_po_date,
             'remarks_pr_num' => $request->remarks_pr_num,
             'remarks_pr_date' => $request->remarks_pr_date,
             'remarks_charged' => $request->remarks_charged,
            'issued_to' => $request->getstaffemployeecode,
            'employee_code' => $request->getstaffemployeecode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
            DB::table('ics_components')->insert($componentSet);
            Session::flash('message',"Successfully Saved Data");

            $set_id = DB::table('ics_components')->get()->last()->id;
         
            $user = Auth::user();
            $username = $user->username;
            $division = getDivision($user->division);
            $staffname = $request->getstaffname;

            $action = "Successfully created supply issued to {$staffname}";

            if(isset($request->equip_serial_num)){ 
              $historylogSet = [];
              $historylogSet[] = [
              'set_id' => $set_id,
              'equipment_type' => "ICS",
              'action' => $action,
              'staff' => $username,
              'division' => $division 
              ];
            }
            DB::table('history_log')->insert($historylogSet);
            Session::flash('message',"Successfully Saved Data");

            $set_id_components = DB::table('ics_components')->get()->last()->id;
            $equip_id_components = DB::table('ics_components')->get()->last()->id;

            // $set_id_components = $componentSet->id;

            if(isset($request->equip_serial_num)){ 
            $componentSet2 = [];
            foreach($request->equip_serial_num as $index => $equip_serial_num) {
            $componentSet2[] = [
            // 'position' => $request->position,
            'fullname' => $request->getstaffname,
            'position' => $request->employee_position_get,
            'fund_cluster' => $request->fund_cluster,
            'fund_number' => $request->fund_number,
            'property_number' => $request->property_number,  
            'inventory_item_number' => $request->inventory_item_number[$index],  
            'ics_number' =>$request->ics_number,  
            'set_id' => $set_id_components,
            'ics_type' =>$request->ics_type, 
            'pcv_by' =>$request->pcv_by,  
            'equip_id' => $index,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->select_division,
            'component_name' => $request->prop_component[$index],
            'lifespan' => $request->estimated_useful_life[$index],
            // 'value' => $request->prop_total_val[0],
            'item_cost' => $request->unit_cost[$index],
            'ics_umeasure' => $request->prop_umeasure,
            'quantity' => $request->component_quantity[$index],
            'component_classification' => $request->equipment_category[$index],
            'component_subclass' => $request->getSubcategory[$index],
            'subclass_id' => $request->equip_subcat[$index],
            'component_subpropertynumber' => $request->equip_subprop_num[$index],
            'serial_num' => $request->equip_serial_num[$index],
            'date_acquired' => $request->date_acquired,
            'date_ics' => $request->date_ics,
            'remarks' => $request->remarks[$index],
             'remarks_from' => $request->remarks_from,
             'remarks_sales' => $request->remarks_sales,
             'remarks_sales_date' => $request->remarks_sales_date,
             'remarks_po_num' => $request->remarks_po_num,
             'remarks_po_date' => $request->remarks_po_date,
             'remarks_pr_num' => $request->remarks_pr_num,
             'remarks_pr_date' => $request->remarks_pr_date,
             'remarks_charged' => $request->remarks_charged,
            // 'date_issued' => $request->equip_date_issued[$index],
            'issued_to' => $request->getstaffemployeecode,
            'employee_code' => $request->getstaffemployeecode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
           }
            DB::table('ics_components_items')->insert($componentSet2);
            Session::flash('message',"Successfully Saved Data");
           }
         }
         return redirect()->back()->with('message','Success');
        }
         catch(Exception $e)
          {
          return "ERROR";
          }
    }

    // Store PPE
    public function store(Request $request)
    {
        try
        {
          $ctr = 0;
          $equip_emp = new App\Equipment_Set;
          $equip_comp = new App\Equipment_Set_Components;

          if(isset($request->equip_serial_num) || isset($request->property_number_array))
            { 
            $componentSet2[] = 
            [
            'par_number' =>$request->par_number,  
            'position' => $request->employee_position_get,
            'fund_cluster' => $request->fund_cluster,
            'fund_number' => $request->fund_number,
            'date_par' => $request->date_par,
            'ppe_type' => $request->ppe_type,  
            'property_number' => $request->property_number,  
            'property_number_1' => isset($request->property_number_array[0]) ?  $request->property_number_array[0] : null,  
            'property_number_2' => isset($request->property_number_array[1]) ?  $request->property_number_array[1] : null,   
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->select_division,
            'estimated_useful_life' => $request->estimated_useful_life[0],
            'component_name' => $request->prop_component[0],
            'component_umeasure' => $request->prop_umeasure,
            'quantity' => $request->component_quantity[0],
            'component_classification' => $request->equipment_category[0],
            'component_subclass' => $request->getSubcategory[0],
            'subclass_id' => $request->equip_subcat[0],
            'component_subpropertynumber' => $request->equip_subprop_num[0],
            'serial_num' => $request->equip_serial_num[0],
            'date_acquired' => $request->date_acquired,
            'date_par' => $request->date_par,
            'remarks' => $request->remarks[0],
             'remarks_from' => $request->remarks_from,
             'remarks_sales' => $request->remarks_sales,
             'remarks_sales_date' => $request->remarks_sales_date,
             'remarks_po_num' => $request->remarks_po_num,
             'remarks_po_date' => $request->remarks_po_date,
             'remarks_pr_num' => $request->remarks_pr_num,
             'remarks_pr_date' => $request->remarks_pr_date,
            'remarks_charged' => $request->remarks_charged,
            'issued_to' => $request->getstaffemployeecode,
            'fullname' => $request->getstaffname,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
            DB::table('equipment_components')->insert($componentSet2);
            }

            $set_id = DB::table('equipment_components')->get()->last()->id;

            $user = Auth::user();
            $username = $user->username;
            $division = getDivision($user->division);
            $staffname = $request->getstaffname;
            $action = "Successfully created equipment issued to {$staffname}";
  
            $historylogSet = [];
            $historylogSet[] = [
            'set_id' =>  $set_id,
            'equipment_type' => "PPE",
            'action' => $action,
            'staff' => $username,
            'division' => $division 
            ];
         
            DB::table('history_log_ppe')->insert($historylogSet);

          //   if(isset($request->property_number_array)){ 
          //     $propertyNumberSet = [];
          //     foreach($request->property_number_array as $index => $property_number_array) {
          //     $propertyNumberSet[] = [
          //     'property_number_1' =>$request->property_number_array[0],  
          //     'property_number_2' => $request->property_number_array[1],
          //     ];
          //    }
          //     DB::table('equipment_sets_components')->insert($propertyNumberSet);
          //  }
            
            if(isset($request->equip_serial_num)){ 
            $componentSet = [];
            foreach($request->equip_serial_num as $index => $equip_serial_num) {
            $componentSet[] = [
            'par_number' =>$request->par_number,  
            'position' => $request->employee_position_get,
            'equip_id' => $index,
            'date_par' => $request->date_par,
            'fund_cluster' => $request->fund_cluster,
            'fund_number' => $request->fund_number,
            'ppe_type' => $request->ppe_type,  
            'property_number' => $request->property_number,  
            'property_number_1' => isset($request->property_number_array[0]) ?  $request->property_number_array[0] : null,  
            'property_number_2' => isset($request->property_number_array[1]) ?  $request->property_number_array[1] : null,   
            // 'inventory_item_number' => $request->inventory_item_number[$index],  
            'set_id' => $set_id,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->select_division,
            'component_name' => $request->prop_component[$index],
            'estimated_useful_life' => $request->estimated_useful_life[$index],
            'component_umeasure' => $request->prop_umeasure,
            'quantity' => $request->component_quantity[$index],
            'amount' => $request->equip_unit_cost[$index],
            'component_classification' => $request->equipment_category[$index],
            'component_subclass' => $request->getSubcategory[$index],
            'subclass_id' => $request->equip_subcat[$index],
            'component_subpropertynumber' => $request->equip_subprop_num[$index],
            'serial_num' => $request->equip_serial_num[$index],
            'remarks' => $request->remarks[$index],
            'fullname' => $request->getstaffname,
            'date_acquired' => $request->date_acquired,
            'date_par' => $request->date_par,
             'remarks_from' => $request->remarks_from,
             'remarks_sales' => $request->remarks_sales,
             'remarks_sales_date' => $request->remarks_sales_date,
             'remarks_po_num' => $request->remarks_po_num,
             'remarks_po_date' => $request->remarks_po_date,
             'remarks_pr_num' => $request->remarks_pr_num,
             'remarks_pr_date' => $request->remarks_pr_date,
             'remarks_charged' => $request->remarks_charged,
            'issued_to' => $request->getstaffemployeecode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
           }
            DB::table('equipment_sets_components')->insert($componentSet);
         }
      
          return redirect()->back()->with('message', 'save-success');
        }
         catch(Exception $e)
          {
          return "ERROR";
          }
    }


    public function delete($id)
    {
      $equip_emp->where('id',$id)
                   ->update([
                              'deleted_at' => date('Y-m-d H:i:s')
                          ]);
    }

    // Accept PPE
    public function accept($id)
    {
         DB::table('equipment_sets_components')
        ->where('id', $id)
        ->update([
           'status' => "Acquired",
           'status_html' => "<small><div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'>Acquired</div></strong></small>"
         ]);

         DB::table('equipment_components')
         ->where('id', $id)
         ->update([
          'status' => "Acquired",
          'status_html' => "<div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'><small><strong>Acquired</strong></small></div>"
          ]);

          $user = Auth::user();
          $username = $user->username;
          $firstname = $user->fname;
          $lastname = $user->lname;
          $middlename = $user->mname;
          $division = getDivision($user->division);
          $staffname = $firstname . " " .$middlename . " " .$lastname;
          $action = "Successfully accepted by {$staffname}";
  
            $historylogSet = [];
            $historylogSet[] = [
           'set_id' => $id,
           'equipment_type' => "PPE",
           'action' => $action,
           'staff' => $username,
           'division' => $division 
           ];
        
           DB::table('history_log_ppe')->insert($historylogSet);

       return redirect()->back()->with('message-accepted', 'accept-success');;
    }


    // Accept ICS
     public function acceptics($id)
    {

         DB::table('ics_components')
        ->where('id', $id)
        ->update([
           'status' => "Acquired",
           'status_html' => "<div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'><small><strong>Acquired</strong></small></div>"
         ]);

         DB::table('ics_components_items')
         ->where('set_id', $id)
         ->update([
            'status' => "Acquired",
            'status_html' => "<div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'><small><strong>Acquired</strong></small></div>"
          ]);
 
         $user = Auth::user();
         $username = $user->username;
         $firstname = $user->fname;
         $lastname = $user->lname;
         $middlename = $user->mname;
         $division = getDivision($user->division);
         $staffname = $firstname . " " .$middlename . " " .$lastname;
         $action = "Successfully accepted by {$staffname}";
 
           $historylogSet = [];
           $historylogSet[] = [
          'set_id' => $id,
          'equipment_type' => "ICS",
          'action' => $action,
          'staff' => $username,
          'division' => $division 
          ];
       
          DB::table('history_log')->insert($historylogSet);

         return redirect('ics/all')->with('message-accept', 'accept-success');
    }

     public function revert($id)
    {

         DB::table('equipment_sets_components')
        ->where('id', $id)
        ->update([
           'status' => "Reverted",
           'status_html' => "<div class='badge-danger' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'>Reverted</div></strong></small>"
         ]);

       return redirect()->back();
    }

    public function revertics($id)
    {

         DB::table('ics_components')
        ->where('id', $id)
        ->update([
           'status' => "Reverted",
           'status_html' => "<div class='badge-danger' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'>Reverted</div></strong></small>"
         ]);

       return redirect()->back();
    }

      public function dispose(Request $request)
    {  
        $user = Auth::user();
        $user_type = $user->account_type;

        $id = $request->dispose_equipment_id;

        $user = Auth::user();
        $username = $user->username;
        $division = getDivision($user->division);
        $staffname = $request->dispose_fullname;
        $action = "Successfully tagged PPE issued to {$staffname} as for disposal";


         DB::table('equipment_sets_components')
        ->where('id', $id)
        ->update([
           'status' => "For Disposal",
           'remarks' => $request->dispose_remarks,
           'status_html' => "<div class='badge-warning' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px; width:100px;'><small style='font-weight:bold;'>For Disposal</small></div>"
         ]);

         DB::table('equipment_components')
         ->where('id', $id)
         ->update([
            'status' => "For Disposal",
            'remarks' => $request->dispose_remarks,
            'status_html' => "<div class='badge-warning' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px; width:100px;'><small style='font-weight:bold;'>For Disposal</small></div>"
          ]);

         $historylogSet = [];
         $historylogSet[] = [
         'set_id' => $id,
         'equipment_type' => "PPE",
         'action' => $action,
         'staff' => $username,
         'division' => $division 
         ];
      
         DB::table('history_log_ppe')->insert($historylogSet);
       

       return redirect()->back()->with('message-disposed', 'success-dispose');
    }


    public function dispose_confirm(Request $request)
    {  
        $user = Auth::user();
        $user_type = $user->account_type;

        $id = $request->dispose_equipment_id;

        $user = Auth::user();
        $username = $user->username;
        $division = getDivision($user->division);
        $staffname = $request->dispose_fullname;
        $action = "Successfully confirmed disposal of PPE issued to {$staffname}";


         DB::table('equipment_sets_components')
        ->where('id', $id)
        ->update([
           'status' => "Disposed",
           'remarks' => $request->dispose_remarks,
           'status_html' => "<div class='badge-danger' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px; width:100px;'><small style='font-weight:bold;'>Disposed</small></div>"
         ]);

         DB::table('equipment_components')
         ->where('id', $id)
         ->update([
            'status' => "Disposed",
            'remarks' => $request->dispose_remarks,
            'status_html' => "<div class='badge-danger' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px; width:100px;'><small style='font-weight:bold;'>Disposed</small></div>"
          ]);

         $historylogSet = [];
         $historylogSet[] = [
         'set_id' => $id,
         'equipment_type' => "PPE",
         'action' => $action,
         'staff' => $username,
         'division' => $division 
         ];
      
         DB::table('history_log_ppe')->insert($historylogSet);
       return redirect()->back()->with('message-disposed', 'success-dispose');
    }


    public function transfer(Request $request)
    {  
      {
        $id = $request->transfer_equipment_id;
        DB::table('equipment_sets_components')
         ->where('id', $id)
         ->update([
           'issued_to' => $request->transfer_fullname,
           'division' => $request->transfer_select_division,
           'position' => $request->transfer_position,
           'employee_code' => $request->transfer_propassign_form,
           'status' => "Pending Transfer",
           'status_html' => "<div style='background-color:darkorange;  color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Pending Transfer</small></div>"
         ]); 

         DB::table('equipment_components')
         ->where('id', $id)
         ->update([
           'issued_to' => $request->transfer_fullname,
           'division' => $request->transfer_select_division,
           'position' => $request->transfer_position,
           'employee_code' => $request->transfer_propassign_form,
           'status' => "Pending Transfer",
           'status_html' => "<div style='background-color:darkorange; color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Pending Transfer</small></div>"
         ]); 

         $db = DB::table('ics_components')->where('id', $id);
         $user = Auth::user();
         $username = $user->username;
         $division = getDivision($user->division);
         $to = $request->transfer_fullname;
         $action = "Successfully transferred supply to {$to}";

       
          $historylogSet = [];
          $historylogSet[] = [
          'set_id' => $id,
          'equipment_type' => "ICS",
          'action' => $action,
          'staff' => $username,
          'division' => $division 
          ];
       
        DB::table('history_log_ppe')->insert($historylogSet);
   
   
       }
           return redirect()->back()->with('message-transferred', 'success-transfer');
     }

       public function transferics(Request $request)
    {  
      {
        $ics_items = new App\ICS_Items;

        $id = $request->transfer_equipment_id;
        $size = DB::table('ics_components_items')->where('set_id', $id)->count();

        DB::table('ics_components')
         ->where('id', $id)
         ->update([
           'issued_to' => $request->transfer_fullname,
           'division' => $request->transfer_select_division,
           'employee_code' => $request->transfer_propassign_form,
           'status' => "Pending Transfer",
           'status_html' => "<div class='badge-danger' style='font-weight:bold; font-size:11px; text-align:center; color: white; background-color:darkorange; border-radius:10px; height:30px;'>Pending Transfer</div></strong></small>"
         ]); 

         
          for ($i=0; $i < $size; $i++){
            DB::table('ics_components_items')->where('equip_id', $i)->where('set_id', $id)
            ->update([
            'issued_to' => $request->transfer_propassign_form,
            'employee_code' => $request->transfer_propassign_form,
            'division' => $request->transfer_select_division,
            'position' => $request->transfer_position,
            'status' => "Pending Transfer",
            'status_html' => "<div class='badge-danger' style='font-weight:bold; font-size:11px; text-align:center; color: white; background-color:darkorange; border-radius:10px; height:30px;'>Pending Transfer</div></strong></small>"
           ]);
           }

         $db = DB::table('ics_components')->where('id', $id);
         $user = Auth::user();
         $username = $user->username;
         $division = getDivision($user->division);
         $to = $db->value('issued_to');
         $action = "Successfully transferred supply to {$to}";


          $historylogSet = [];
          $historylogSet[] = [
          'set_id' => $id,
          'equipment_type' => "ICS",
          'action' => $action,
          'staff' => $username,
          'division' => $division 
          ];
       
        DB::table('history_log')->insert($historylogSet);
        
       }
           return redirect()->back()->with('message-transferred', 'success-transfer');
     }

     public function disposeics(Request $request)
    {  
        $user = Auth::user();
        $user_type = $user->account_type;

        $id = $request->dispose_equipment_id;

        $db = DB::table('ics_components')->where('id', $id);
        $username = $user->username;
        $division = getDivision($user->division);
        $staffname = $request->dispose_fullname;
        $to = $db->value('issued_to');
        $action = "Successfully tagged supply issued to {$staffname} as for disposal.";

         
         DB::table('ics_components')
        ->where('id', $id)
        ->update([
           'status' => "For Disposal",
           'remarks' => $request->dispose_remarks,
           'status_html' => "<div class='badge-warning' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px; width:100px;'><small style='font-weight:bold;'>For Disposal</small></div>"
         ]);

         $historylogSet = [];
         $historylogSet[] = [
         'set_id' => $id,
         'equipment_type' => "ICS",
         'action' => $action,
         'staff' => $username,
         'division' => $division 
         ];
      
         DB::table('history_log')->insert($historylogSet);
       

       return redirect()->back()->with('message-disposed', 'dispose-success');
    }

    public function disposeics_confirm(Request $request)
    {  
        $user = Auth::user();
        $user_type = $user->account_type;

        $id = $request->dispose_equipment_id;

        $db = DB::table('ics_components')->where('id', $id);
        $username = $user->username;
        $division = getDivision($user->division);
        $staffname = $request->dispose_fullname;
        $to = $db->value('issued_to');
        $action = "Successfully confirmed disposal of supply issued to {$staffname}";

         
         DB::table('ics_components')
        ->where('id', $id)
        ->update([
           'status' => "Disposed",
           'remarks' => $request->dispose_remarks,
           'status_html' => "<div class='badge-danger' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Disposed</small></div>"
         ]);

         $historylogSet = [];
         $historylogSet[] = [
         'set_id' => $id,
         'equipment_type' => "ICS",
         'action' => $action,
         'staff' => $username,
         'division' => $division 
         ];
      
         DB::table('history_log')->insert($historylogSet);
       

       return redirect()->back()->with('message-disposed', 'dispose-success');
    }




    public function update(Request $request)
    {
      {
      $components = App\Components::findorfail($request->id);
      $components->component_name = $request->update_prop_desc;
      $components->save();
         
      } 
          return redirect('admin/equipment/all');
          
    }

   
    public function updateequipment(Request $request)
    { 
       {
        $id = $request->update_equipment_id;

        $set_id = $request->update_set_id;

         DB::table('equipment_components')
        ->where('id', $id)
        ->update([
                'quantity' => $request->update_component_quantity[0],
                'serial_num' => $request->equip_serial_num[0],
                'par_number' => $request->update_par_number,
                'date_par' => $request->update_date_par,
                'property_number' => $request->update_property_number,
                'property_number_1' => isset($request->update_property_number_array[0]) ?  $request->update_property_number_array[0] : null,  
                'property_number_2' => isset($request->update_property_number_array[1]) ?  $request->update_property_number_array[1] : null,   
                'fund_cluster' => $request->update_fund_cluster,
                'fund_number' => $request->update_fund_number,
                'ppe_type' => $request->update_ppe_type,
                'division' => $request->update_select_division,
                'component_name' => $request->update_comp_prop_component[0],
                'component_classification' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'component_subpropertynumber' => $request->update_subprop_num,
                // 'status' =>  'Edited',
                'date_acquired' => $request->update_date_acquired,
                'date_issued' => $request->update_date_issued,
                // 'employee_code' => $request->update_propassign_form,
                'position' => $request->update_position,
                'fullname' => $request->update_fullname,
                'issued_to' => $request->update_select_staff,
                'date_issued' => $request->update_date_issued,
                // 'remarks' => $request->update_remarks,
                'remarks_from' => $request->update_remarks_from,
                'remarks_sales' => $request->update_remarks_sales,
                'remarks_sales_date' => $request->update_remarks_sales_date,
                'remarks_po_num' => $request->update_remarks_po_num,
                'remarks_po_date' => $request->update_remarks_po_date,
                'remarks_pr_num' => $request->update_remarks_pr_num,
                'remarks_pr_date' => $request->update_remarks_pr_date,
                'remarks_charged' => $request->update_remarks_charged,
                ]);

        DB::table('equipment_sets_components')
        ->where('set_id', $id)
        ->update([
                'par_number' => $request->update_par_number,
                'property_number' => $request->update_property_number,
                'property_number_1' => isset($request->update_property_number_array[0]) ?  $request->update_property_number_array[0] : null,  
                'property_number_2' => isset($request->update_property_number_array[1]) ?  $request->update_property_number_array[1] : null,   
                'date_par' => $request->update_date_par,
                'fund_cluster' => $request->update_fund_cluster,
                'ppe_type' => $request->update_ppe_type,
                'fund_number' => $request->update_fund_number,
                'division' => $request->update_select_division,
                'component_name2' => $request->update_prop_desc,
                'component_classification' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'component_subpropertynumber' => $request->update_subprop_num,
                // 'status' =>  'Edited',
                'serial_num' => $request->update_serial_num,
                'date_acquired' => $request->update_date_acquired,
                'date_issued' => $request->update_date_issued,
                // 'employee_code' => $request->update_propassign_form,
                // 'issued_to' => $request->update_fullname,
                'position' => $request->update_position,
                'fullname' => $request->update_fullname,
                'issued_to' => $request->update_select_staff,
                'date_issued' => $request->update_date_issued,
                // 'remarks' => $request->update_remarks,
                'remarks_from' => $request->update_remarks_from,
                'remarks_sales' => $request->update_remarks_sales,
                'remarks_sales_date' => $request->update_remarks_sales_date,
                'remarks_po_num' => $request->update_remarks_po_num,
                'remarks_po_date' => $request->update_remarks_po_date,
                'remarks_pr_num' => $request->update_remarks_pr_num,
                'remarks_pr_date' => $request->update_remarks_pr_date,
                'remarks_charged' => $request->update_remarks_charged,
                ]);

        //ADD COMPONENTS SECTION
        $size = DB::table('equipment_sets_components')->where('set_id', $set_id)->count();
        if(isset($request->update_component_issued_to)){ 
           for ($i=0; $i < $size; $i++){
             DB::table('equipment_sets_components')->where('equip_id', $i)->where('set_id', $set_id)
             ->update([
                //  'inventory_item_number' => $request->update_inventory_item_number[$i], 
                //  'issued_to' => $request->update_component_issued_to[$i],
                 'remarks' => $request->update_remarks[$i],
                 'quantity' => $request->update_component_quantity[$i],
                 'component_subpropertynumber' => $request->update_subproperty_number[$i],
                 'component_name' => $request->update_comp_prop_component[$i],
                 'component_classification' => $request->update_comp_prop_class[$i],
                 'component_subclass' => $request->update_comp_equip_subcat_get[$i],
                 'estimated_useful_life' => $request->update_estimated_useful_life[$i],
                 'serial_num' => $request->equip_serial_num[$i],
                 'amount' => $request->update_equip_unit_cost[$i]
              ]);
            }
          }
          else{}
        //END ADD COMPONENTS SECTION    

       }

        return redirect()->back()->with('message-edited','Success');
    }

   public function updateics(Request $request)
    { 
       {
        $id = $request->update_equipment_id;
        $set_id = $request->update_set_id;
        DB::table('ics_components')
        ->where('id', $id)
        ->update([
                'ics_umeasure' => $request->update_prop_umeasure,
                'fund_cluster' => $request->update_fund_cluster,
                'fund_number' => $request->update_fund_number,
                'property_number' => $request->update_property_number,
                'property_number_1' => isset($request->update_property_number_array[0]) ?  $request->update_property_number_array[0] : null,  
                'property_number_2' => isset($request->update_property_number_array[1]) ?  $request->update_property_number_array[1] : null,   
                'location' => $request->update_location, 
                'ics_type' => $request->update_ics_type, 
                'ics_category' => $request->update_ics_category, 
                'ics_number' =>$request->update_ics_number,  
                'date_ics' =>$request->update_date_ics,  
                'division' => $request->update_select_division,
                'component_name' => $request->update_comp_prop_component[0],
                'lifespan' => $request->update_estimated_useful_life[0],
                'component_name2' => $request->update_prop_desc,
                'component_classification' => $request->update_categoryHidden,
                'classification_id' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'amount' => $request->update_amount,
                'quantity' => $request->update_prop_quantity,
                'component_subpropertynumber' => $request->update_subprop_num,
                // 'status' =>  'Edited',
                'position' => $request->update_position,
                'fullname' => $request->update_fullname,
                'issued_to' => $request->update_select_staff,
                'serial_num' => $request->update_serial_num,
                'date_acquired' => $request->update_date_acquired,
                'date_issued' => $request->update_date_issued,
                'employee_code' => $request->update_propassign_form,
                // 'issued_to' =>  $request->update_propassign_form,
                'remarks_from' => $request->update_remarks_from,
                'remarks_sales' => $request->update_remarks_sales,
                'remarks_sales_date' => $request->update_remarks_sales_date,
                'remarks_po_num' => $request->update_remarks_po_num,
                'remarks_po_date' => $request->update_remarks_po_date,
                'remarks_pr_num' => $request->update_remarks_pr_num,
                'remarks_pr_date' => $request->update_remarks_pr_date,
                'remarks_charged' => $request->update_remarks_charged,
                ]);


        DB::table('ics_components_items')
        ->where('id', $id)
        ->update([
                'ics_umeasure' => $request->update_prop_umeasure,
                'fund_cluster' => $request->update_fund_cluster,
                'fund_number' => $request->update_fund_number,
                'ics_number' =>$request->update_ics_number,  
                'property_number' =>$request->update_property_number, 
                'property_number_1' => isset($request->update_property_number_array[0]) ?  $request->update_property_number_array[0] : null,  
                'property_number_2' => isset($request->update_property_number_array[1]) ?  $request->update_property_number_array[1] : null,    
                'ics_category' => $request->update_ics_category, 
                'date_ics' =>$request->update_date_ics,  
                'division' => $request->update_select_division,
                'component_name2' => $request->update_prop_desc,
                'component_classification' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'amount' => $request->update_amount,
                'quantity' => $request->update_prop_quantity,
                'component_subpropertynumber' => $request->update_subprop_num,
                'status' =>  'Edited',
                'position' => $request->update_position,
                'fullname' => $request->update_fullname,
                'serial_num' => $request->update_serial_num,
                'date_issued' => $request->update_date_issued,
                'employee_code' => $request->update_propassign_form,
                'remarks_from' => $request->update_remarks_from,
                'remarks_sales' => $request->update_remarks_sales,
                'remarks_sales_date' => $request->update_remarks_sales_date,
                'remarks_po_num' => $request->update_remarks_po_num,
                'remarks_po_date' => $request->update_remarks_po_date,
                'remarks_pr_num' => $request->update_remarks_pr_num,
                'remarks_pr_date' => $request->update_remarks_pr_date,
                'remarks_charged' => $request->update_remarks_charged,
                ]);
             
                $set_id_components = DB::table('ics_components')->get()->last()->id;
                $equip_id_components = DB::table('ics_components_items')->get()->last()->equip_id+1;
           
        //ADD COMPONENTS SECTION
        $size = DB::table('ics_components_items')->where('set_id', $set_id)->count();
        if(isset($request->update_component_issued_to)){ 
           for ($i=0; $i < $size; $i++){
             DB::table('ics_components_items')->where('equip_id', $i)->where('set_id', $set_id)
             ->update([
                 'ics_number' =>$request->update_ics_number,  
                 'date_acquired' => $request->update_date_acquired,
                 'issued_to' => $request->update_select_staff,
                 'lifespan' => $request->update_estimated_useful_life[$i],
                 'fullname' => $request->update_fullname,
                 'component_subpropertynumber' => $request->update_comp_subprop[$i],
                 'component_classification' => $request->update_comp_prop_class[$i],
                 'inventory_item_number' => $request->update_comp_property_number[$i],
                 'subclass_id' => $request->update_comp_equip_subcat[$i],
                 'division' => $request->update_comp_division[$i],
                 'employee_code' => $request->update_comp_employeecode[$i],
                 'position' => $request->update_comp_position[$i],
                 'quantity' => $request->update_component_quantity[$i],
                 'component_subclass' => $request->update_comp_equip_subcat_get[$i],
                 'item_cost' => $request->update_unit_cost[$i],
                 'serial_num' => $request->equip_serial_num[$i],
                 'component_name' => $request->update_comp_prop_component[$i],
                 'ics_umeasure' => $request->update_prop_umeasure,
                 'remarks' => $request->update_remarks[$i],
              ]);
            }
            
            // ADDITIONAL COMPONENTS
            // $componentSet2 = [];
            // foreach($request->update_component_issued_to as $index => $equip_serial_num) {
            // $componentSet2[] = [
            // 'division' => $request->update_select_division,
            // 'set_id' => $set_id_components,
            // 'equip_id' => $equip_id_components,
            // 'property_number' => $request->update_property_number,  
            // 'inventory_item_number' => $request->inventory_item_number[$index],
            // 'ics_number' =>$request->update_ics_number,  
            // 'ics_type' => $request->update_ics_type, 
            // 'fund_cluster' => $request->update_fund_cluster, 
            // 'component_name' => $request->prop_component[$index], 
            // 'lifespan' => $request->estimated_useful_life[$index], 
            // 'component_classification' => $request->equip_subcat[$index],
            // 'component_subclass' => $request->equipment_category[$index],
            // 'item_cost' => $request->unit_cost[$index],
            // 'quantity' => $request->component_quantity[$index],
            // 'serial_num' => $request->equip_serial_num[$index],
            // ];
            // }
            // DB::table('ics_components_items')->insert($componentSet2);
            // END ADDITIONAL COMPONENTS

          } else {

          }
        //END ADD COMPONENTS SECTION  
       }
       return redirect()->back()->with('message-edited','Success');
    }

    public function deleteppe($id)
    {
      {
      $ppe_components = new App\Equipment_Set; 
      $ppe_items = new App\Equipment_Set_Components;
    
      $ppe_components->where('id',$id)
      ->delete();      

      $ppe_items->where('set_id',$id)
      ->delete();

      DB::table('history_log_ppe')->where('set_id',$id)
      ->delete();

      }
     return redirect()->back()->with('message-deleted','Success');
    }



 }



