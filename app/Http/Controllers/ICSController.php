<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use PDF;

use App\ICS_Components;
use App\ICS_Items;
use Session;


class ICSController extends Controller
{
    public function __construct()
    {
     
        $this->middleware('auth');
    }

    public function index()
    {
       return View('ics');
    }
  
    public function storeics2(Request $request)
    {
        try
        {
            if(isset($request->equip_serial_num)){ 
            $componentSet = [];
            $componentSet[] = [
            'position' => $request->position,
            'fund_cluster' => $request->fund_cluster,
            'property_number' => $request->comp_property_number[0],  
            'ics_number' =>$request->ics_number,  
            'ics_type' =>$request->ics_type, 
            'ics_category' =>$request->ics_category, 
            'pcv_by' =>$request->pcv_by,  
            'amount' => $request->amount,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->division,
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
            'position' => $request->position,
            // 'amount' =>$request->amount,
            'fund_cluster' => $request->fund_cluster,
            'fund_number' => $request->fund_number,
            'property_number' => $request->property_number,  
            'inventory_item_number' => $request->comp_property_number[$index],  
            'ics_number' =>$request->ics_number,  
            'set_id' => $set_id_components,
            'ics_type' =>$request->ics_type, 
            'pcv_by' =>$request->pcv_by,  
            'equip_id' => $index,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'division' => $request->division,
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

     public function storeics(Request $request)
    {
        try
        {
          $ctr = 0;

            $equipment = new App\Equipment;

             /**Februrary 26, 2020
       * Drei Cambay
       * Added prop_umeasure as variable
       * Added date_delivered, date_accepted, and date_acquired
       */
          $equipment->prop_umeasure = $request->prop_umeasure;
          $equipment->prop_subcat = $request->subcategoryHidden;
          $equipment->prop_cat = $request->categoryHidden;
          $equipment->prop_desc = $request->prop_desc;

          $equipment->issued_to = $request->getstaffname;
        
          $equipment->prop_quantity = $request->prop_quantity;
          $equipment->date_delivered = $request->date_delivered;
          $equipment->date_inspected = $request->date_inspected;
          $equipment->date_accepted = $request->date_accepted;
          $equipment->date_acquired = $request->date_acquired;
          $equipment->prop_num = $request->prop_num;
          
          $equipment->save();
          $equip_id = $equipment->id;
          $set_id = DB::table('ics_components')->get()->last()->set_id+1;
          $id = DB::getPdo()->lastInsertId();

            if(isset($request->ics_serial_num)){ 
            $icscomponentSet = [];
            foreach($request->ics_serial_num as $index => $ics_serial_num) {
            $icscomponentSet[] = [
           'position' => $request->position,
            'lifespan' => $request->ics_lifespan,  
            'property_number' => $request->comp_property_number[$index], 
             'ics_number' => $request->ics_number,   
             'fund_cluster' => $request->fund_cluster,
            // 'fund_number' => $request->fund_number,
            'set_id' =>  $set_id,
            'status' => 'Acquired',
            'status_html' => "<div class='badge-success' style='color: white; font-weight:bold; text-align:center; border-radius:10px; height:30px;'><small style='font-weight:bold;'>Acquired</small></div>",
            'equip_id' => $equip_id,
            'division' => $request->division,
            'component_name' => $request->prop_component[$index],
            'value' => $request->prop_total_val[0],
            'amount' => $request->amount,
            'ics_umeasure' => $request->prop_umeasure,
            'quantity' => $request->component_quantity[$index],
            'component_classification' => $request->equipment_category[$index],
            'component_subclass' => $request->getSubcategory[$index],
            'subclass_id' => $request->equip_subcat[$index],
            'component_subpropertynumber' => $request->equip_subprop_num[$index],
            'serial_num' => $request->ics_serial_num[$index],
            'date_acquired' => $request->date_acquired,
            'date_issued' => $request->date_issued,
            'date_ics' => $request->date_ics,
            'issued_to' => $request->update_component_issued_to[$index],
             'remarks_from' => $request->remarks_from,
             'remarks_sales' => $request->remarks_sales,
             'remarks_sales_date' => $request->remarks_sales_date,
             'remarks_po_num' => $request->remarks_po_num,
             'remarks_po_date' => $request->remarks_po_date,
             'remarks_pr_num' => $request->remarks_pr_num,
             'remarks_pr_date' => $request->remarks_pr_date,
             'remarks_charged' => $request->remarks_charged,
            'employee_code' => $request->getstaffname,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];
           }
            DB::table('ics_components')->insert($icscomponentSet);
         }
          return redirect('ics/all');
        }
         catch(Exception $e)
          {
          return "ERROR";
          }
    }

 
     public function acceptics($id)
    {

         DB::table('ics_components')
        ->where('id', $id)
        ->update([
           'status' => "Acquired",
           'status_html' => "<small><div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'>Acquired</div></strong></small>"
         ]);

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
        $to = $db->value('issued_to');
        $action = "Successfully disposed supply";
         
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

   public function updateics(Request $request)
    { 
       {
        $id = $request->update_equipment_id;
        $set_id = $request->update_set_id;
        DB::table('ics_components')
        ->where('id', $id)
        ->update([
                'fund_cluster' => $request->update_fund_cluster,
                'fund_number' => $request->update_fund_number,
                'property_number' => $request->update_property_number,
                'location' => $request->update_location, 
                'ics_type' => $request->update_ics_type, 
                'ics_category' => $request->update_ics_category, 
                'ics_number' =>$request->update_ics_number,  
                'date_ics' =>$request->update_date_ics,  
                'division' => $request->update_division,
                'component_name2' => $request->update_prop_desc,
                'component_classification' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'amount' => $request->update_amount,
                'quantity' => $request->update_prop_quantity,
                'component_subpropertynumber' => $request->update_subprop_num,
                'division' => $request->update_division,
                'status' =>  'Edited',
                'serial_num' => $request->update_serial_num,
                'date_acquired' => $request->update_date_acquired,
                'date_issued' => $request->update_date_issued,
                'employee_code' => $request->update_propassign_form,
                'issued_to' =>  $request->update_propassign_form,
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
                'fund_cluster' => $request->update_fund_cluster,
                'fund_number' => $request->update_fund_number,
                'ics_number' =>$request->update_ics_number,  
                'property_number' =>$request->update_property_number,  
                'ics_category' => $request->update_ics_category, 
                'date_ics' =>$request->update_date_ics,  
                'division' => $request->update_division,
                'component_name2' => $request->update_prop_desc,
                'component_classification' => $request->update_categoryHidden,
                'component_subclass' => $request->update_subcategoryHidden,
                'value' => $request->update_prop_total_val,
                'amount' => $request->update_amount,
                'quantity' => $request->update_prop_quantity,
                'component_subpropertynumber' => $request->update_subprop_num,
                'status' =>  'Edited',
                'serial_num' => $request->update_serial_num,
                'date_acquired' => $request->update_date_acquired,
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

        //ADD COMPONENTS SECTION
        $size = DB::table('ics_components_items')->where('set_id', $set_id)->count();
        if(isset($request->update_component_issued_to)){ 
           for ($i=0; $i < $size; $i++){
             DB::table('ics_components_items')->where('equip_id', $i)->where('set_id', $set_id)
             ->update([
              
                 'ics_number' =>$request->update_ics_number,  
                //  'set_id' => $request->trigger_set_id_change[$i],
                 'issued_to' => $request->update_component_issued_to[$i],
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
                 'component_name' => $request->update_comp_prop_component[$i]
              ]);
            }
          }
          else{}
        //END ADD COMPONENTS SECTION  
       }

       return redirect()->back()->with('message-edited','Success');
    }

    public function deleteics($id)
    {
      {
      $ics_components = new App\ICS_Components; 
      $ics_items = new App\ICS_Items;
    
      $ics_components->where('id',$id)
      ->delete();      

      $ics_items->where('set_id',$id)
      ->delete();

      DB::table('history_log')->where('set_id',$id)
      ->delete();

      }
     return redirect()->back()->with('message-deleted','Success');
    }


    public function table_ics_filter(Request $request, $division)
    {
        $tb = DB::table('view_ics_components_items')
        ->where('division', $division);

        $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb
                ->skip($start)
                ->take($length)->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }


 }



