<?php

namespace App\Http\Controllers;
use DB;
use App;
use Hash;
use App\Category;

use Auth;
use App\Category2;
use App\Subcategory2;
use App\Viewclassification;

use App\Viewcategories;
use App\Subcategory;
use App\Employees;
use App\Equipment;
use App\Viewequipment;
use App\Viewequipmentemployee;
use App\Employee_Equipment;
use App\Equipment_History;

use App\Equipment_Set;


use App\Equipment_Set_Components;
use App\ICS_Components;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    private $menu_dashboard = null;
    private $menu_equipment = null;
    private $menu_ppe = null;
    private $menu_disposed = null;
    private $menu_library = null;
    private $menu_reports = null;
    private $categories = null;
    private $viewcategories = null;
    private $subcategories = null;
    private $equipment = null;
    private $employees = null;
    // private $viewequipemp = null;
    private $equipment_data = null;
     
    private $viewclassification = null; 
    private $equipment_sets = null;
    private $equipment_sets2 = null;
    private $equipment_sets_components = null;
    private $equipment_sets_components2 = null;

    private $item_subtype_lib = null;
    private $item_classification_lib = null;

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($view,$id)
    {
        //MENU
        switch ($view) {
            case 'dashboard':
                # code...
                    $this->menu_dashboard = "active";
                    $viewclass = new Viewclassification;
                    $tbl_viewclass = $viewclass->get();
                    $this->viewclassification = $tbl_viewclass;
                break;

            case 'equipment':
           
            case 'ppe':
                # code...
                    $this->menu_ppe = "active";
                break;
            case 'disposed':
                # code...
                    $this->menu_disposed = "active";
                break;
            case 'library':
                # code...
                    $this->menu_library = "active";
                break;
            case 'reports':
                # code...
                    $this->menu_reports = "active";
                break;

            case 'update-equipment':
                # code...
                    $cat2 = new Category2;
                    $tbl_cat2 = $cat2->select(['subtype_id','description'])->orderBy('description')->get();
                    $this->item_subtype_lib = $tbl_cat2;

                    $subcat2 = new Subcategory2;
                    $tbl_sub_cat2 = $subcat2->select(['classification_id','description'])->orderBy('description')->get();
                    $this->item_classification_lib = $tbl_sub_cat2;

                    $viewclass = new Viewclassification;
                    $tbl_viewclass = $viewclass->orderBy('subclass_description')->get();
                    $this->viewclassification = $tbl_viewclass;

                    $equip_data = new Equipment;
                    $this->equipment_data = $equip_data->where('id',$id)->first();

                    $equipment_sets = new Equipment_Set;
                    $this->equipment_sets = $equipment_sets->where('equip_id',$id)->first();

                    $equipment_sets_components = new Equipment_Set_Components;
                    $this->equipment_sets_components = $equipment_sets_components->where('equip_id',$id)->first();

                  
                    $this->menu_equipment = "active";

                break;


               case 'delete-equipment':
               $equip = new App\Equipment;
               $equip->where('id',$id)
                   ->update([
                              'deleted_at' => date('Y-m-d H:i:s')
                          ]);

               return redirect('admin/equipment/all');
               break;
       
             case 'ics':
            
            case 'ppe':
                # code...
                    $this->menu_ppe = "active";
                break;
            case 'disposed':
                # code...
                    $this->menu_disposed = "active";
                break;
            case 'library':
                # code...
                    $this->menu_library = "active";
                break;
            case 'reports':
                # code...
                    $this->menu_reports = "active";
                break;

            case 'update-equipment':
                # code...
                    $cat2 = new Category2;
                    $tbl_cat2 = $cat2->select(['subtype_id','description'])->orderBy('description')->get();
                    $this->item_subtype_lib = $tbl_cat2;

                    $subcat2 = new Subcategory2;
                    $tbl_sub_cat2 = $subcat2->select(['classification_id','description'])->orderBy('description')->get();
                    $this->item_classification_lib = $tbl_sub_cat2;

                    $viewclass = new Viewclassification;
                    $tbl_viewclass = $viewclass->orderBy('subclass_description')->get();
                    $this->viewclassification = $tbl_viewclass;

                    $equip_data = new Equipment;
                    $this->equipment_data = $equip_data->where('id',$id)->first();

                    $equipment_sets = new Equipment_Set;
                    $this->equipment_sets = $equipment_sets->where('equip_id',$id)->first();

                    $equipment_sets_components = new Equipment_Set_Components;
                    $this->equipment_sets_components = $equipment_sets_components->where('equip_id',$id)->first();

    
                    $this->menu_equipment = "active";

                break;

               case 'delete-equipment':
               $equip = new App\Equipment;
               $equip->where('id',$id)
                   ->update([
                              'deleted_at' => date('Y-m-d H:i:s')
                          ]);

               return redirect('admin/ics/all');
               break;

               case 'accept-equipment':
               $equip = new App\Equipment_Set_Components;
               $equip->where('id', $id)
                  ->update([
                     'status' => "Accepted",
                     'status_html' => "<small><div class='badge-success' style='font-weight:bold; text-align:center; color: white; border-radius:10px; height:30px;'>Accepted</div></strong></small>"
                   ]);

               return redirect('equipment/all');
               break;


        }

        $data = [

                  "item_subtype_lib" => $this->item_subtype_lib,
                  "item_classification_lib" => $this->item_classification_lib,
                  "menu_dashboard" => $this->menu_dashboard,
                  "menu_equipment" => $this->menu_equipment,
                  "menu_ppe" => $this->menu_ppe,
                  "menu_disposed" => $this->menu_disposed,
                  "menu_library" => $this->menu_library,
                  "menu_reports" => $this->menu_reports,
                  "categories" => $this->categories,
                  "viewcategories" => $this->viewcategories,
                  "viewclassification" => $this->viewclassification,
                  "subcategories" => $this->subcategories,
                  "equipment" => $this->equipment,
                  "equipment_sets" => $this->equipment_sets,
                  //"equipment_sets2" => $this->equipment_sets,
                  "equipment_sets_components" => $this->equipment_sets_components,
                   "equipment_sets_components2" => $this->equipment_sets_components2,
                  "employees" => $this->employees,
                  // "viewequipemp" => $this->viewequipemp,
                  "equipment_data" => $this->equipment_data,            
               ];

        return view($view)->with('data',$data);

    }

   
    
    public function updatePPE(Request $request)
    {
        $empeguip = new Employee_Equipment;
       // $equiphistory = new Equipment_History;
        $equipment_sets_components = App\Equipment_Set_Components::find($request->set_id);

        $equiphistory = App\Equipment_History::find($request->empequip_id);

        $empequip_id = $request->empequip_id;
       

        if($request->equip_status == 5)
        {
          
         // $equiphistory->employee_equipment_id = $request->empequip_id;
          $equiphistory->last_known_user = $request->equip_transfer_staff;
          $equiphistory->date_created = $request->equip_date_acquired;
          $equiphistory->equip_remarks = $request->equip_remarks;
          $equiphistory->save();

         // $equipment_sets_components->where('id',$request->id)
         //   ->update([
         //            'issued_to' => $request->equip_transfer_staff,
         //            'date_issued' => $request->equip_date_acquired,
         //            ]);
          // $equiphistory->where('id',$request->empequip_id)
          //          ->update([
          //                     'equip_status' => 1,
          //                     'last_known_user' => $request->equip_transfer_staff,
          //                     'date_created' => $request->equip_date_acquired,
          //                     'equip_remarks' => $request->equip_remarks
          //                 ]);
        
         DB::table('equipment__histories')
        ->where('id', $empequip_id)
        ->update([
                'equip_status' => 1,
                'last_known_user' => $request->equip_transfer_staff,
                'date_created' => $request->equip_date_acquired,
                'equip_remarks' => $request->equip_remarks
                ]);
        }
        else
        {
          //$equiphistory->employee_equipment_id = $request->empequip_id;
          // $equiphistory->date_created = $request->equip_date_acquired;
          // $equiphistory->equip_remarks = $request->equip_remarks;
          // $equiphistory->save();

          // $equiphistory->where('id',$request->empequip_id)
          //          ->update([
          //                     'equip_status' => $request->equip_status,
          //                     'equip_remarks' => $request->equip_remarks,
          //                 ]);
         DB::table('equipment__histories')
        ->where('id', $empequip_id)
        ->update([
                  'equip_status' => $request->equip_status,
                  'equip_remarks' => $request->equip_remarks,
                ]);

        }

        return redirect("admin/ppe/all");
    }


        public function changePassword()
       {
       
         DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
                'password' => bcrypt(request()->password),
                ]);
      
       
        return redirect()->back();
          }

        // public function getpassword()
        // {
        //   $data = [
        //             "nav" => nav("icos"),
        //         ];
        // return view('dtr.change-password')->with("data",$data);
        //   }


    //        public function changepassword()
    // {
    //     $user = App\User::where('id',Auth::user()->id)
    //                     ->update([
    //                                 "password" => bcrypt(request()->password),
    //                             ]);
    //     return redirect('change-password');
    // }


}
