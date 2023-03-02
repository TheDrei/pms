<?php

namespace App\Http\Controllers;
use Auth;
use App;
use App\Category;
use App\Subcategory;
use App\Employees;
use App\Equipment;
use App\Equipment_Set_Components;
use App\Status;
use App\PPETypeLib;
use App\View_Users;
use App\HRMS_Users;
use App\PMS_Users;
use App\Project_Staff;
use App\Library\Charging_Lib;

use App\DPPMP_Reports;

use App\Equipment_Components;
use App\ICS_Components;
use App\View_ICS_Components;
use App\Annual_Procurement_Plan_Submissions;

use App\View_ICS;

use App\Viewequipment;
use App\Viewclassification;
use App\Viewequipmentemployee;
use App\Components;

use Illuminate\Http\Request;
use DB;

class JsonController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function library($tbl,$val, Request $request)
    {
      switch ($tbl) {

            case 'users-management':
                # code...
                $table = new App\View_Users;
                $tb = $table->orderBy('id')->get();
            break;

            case 'project-staff':
                # code...
                $table = new App\Project_Staff;
                $tb = $table->orderBy('id')->get();
            break;

            case 'fund-cluster':
                # code...
                $table = new App\Library\FundCluster_Lib;
                $tb = $table->orderBy('fund_cluster')->get();
            break;

            case 'charging':
                # code...
                $table = new App\Library\Charging_Lib;
                $tb = $table->orderBy('charging')->get();
            break;


            case 'ppe-subtype':
                # code...
                $table = new App\Library\PPE_SubCategory;
                $tb = $table->orderBy('sub_type')->get();
            break;

            case 'ppe-type':
                # code...
                $table = new App\Library\PPE_Category;
                $tb = $table->orderBy('type')->get();
            break;

            case 'subcategory2':
                # code...
                $table = new App\Subcategory2;
                $tb = $table->where('subtype_id',$val)->orderBy('description')->get();
            break;

            case 'category2':
                # code...
                $table = new Category2;
                $tb = $table->where('classification_id',$val)->orderBy('description')->get();
            break;

            case "showcategory":
                # code...
                $table = new Viewclassification;
                $tb = $table->where('subclass_id',$val)->get();
            break;

            case 'category':
                # code...
                $table = new Category;
                $tb = $table->orderBy('cat_desc')->get();
            break;

            case 'subcategory':
                # code...
                $table = new Subcategory;
                $tb = $table->orderBy('description')->get();
            break;


            case 'status':
                # code...
                $table = new Status;
                $tb = $table->orderBy('status_desc')->get();
            break;

            case 'employees':
                # code...
                $table = new Employees;
                $tb = $table->select(['name','fullname'])->orderBy('fullname')->get();
            break;

            case 'components':
                $table = new Equipment_Set_Components;
                $tb = $table->select(['id','equip_id','component_name', 'value', 'quantity','serial_num', 'date_issued', 'issued_to'])
                ->orderBy('component_name')->get();
            break;

            case 'equipment':
                $user = Auth::user();
                $empcode = $user->username;
                # code...
                $table = new Viewequipment;
                $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('prop_desc')->get();
            break;

            case 'ics-items':
                $user = Auth::user();
                $empcode = $user->username;
                # code...
                $table = new ICS_Items;
                $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('prop_desc')->get();
            break;

             case 'ics':
                $user = Auth::user();
                $empcode = $user->username;
                # code...
                $table = new ICS_Components;
                $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id')->get();
            break;

             case 'icsitemsall':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = 'Admin';
                # code...
                if($user_type =='Admin')
                {
                    $table = new App\ICS_Items;
                    $tb = $table->whereNull('deleted_at')->orderBy('id');
                }
                else
                { 
                    $table = new App\ICS_Items;
                    $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                }

                
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb->select(
                    'id',
                    'set_id',
                    'equip_id',
                    'remarks_from',
                    'property_number',
                    'ics_number',
                    'fund_cluster',
                    'fund_number',
                    'component_name',
                    'component_name2',
                    'lifespan',
                    'division',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

             case 'ppe-history':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = 'Admin';
                # code...
                // if($user_type =='Admin')
                // {
                //     $table = new App\ICS_Items;
                //     $tb = $table->whereNull('deleted_at')->orderBy('id');
                // }
                // else
                // { 
                //     $table = new App\ICS_Items;
                //     $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                // }

                
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb->select(
                    'id',
                    'set_id',
                    'equip_id',
                    'remarks_charged',
                    'remarks_from',
                    'property_number',
                    'ics_number',
                    'fund_cluster',
                    'fund_number',
                    'component_name',
                    'component_name2',
                    'lifespan',
                    'division',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

            case 'componentsall':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = 'Admin';
                # code...
                if($user_type =='Admin')
                {
                    $table = new App\View_PPE_Items;
                    $tb = $table->whereNull('deleted_at')->orderBy('id');
                }
                else
                { 
                    $table = new App\View_PPE_Items;
                    $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                }
                
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb->select(
                    'id',
                    'fullname',
                    'remarks_charged',
                    'remarks_from',
                    'division',
                    'property_number',
                    'par_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();
                // return DataTables::of($data)->addIndexColumn()->make(true);
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
            break;

              case 'componentsmain':
                $user = Auth::user();
                $employee_code = $user->username;
                $user_type = $user->account_type;
                # code...
                if($user_type =='Admin')
                {
                    $table = new App\Equipment_Components;
                    $tb = $table
                    ->whereNull('deleted_at')
                    ->orderBy('id');
                }
                else
                { 
                    $table = new App\Equipment_Components;
                    $tb = $table->whereNull('deleted_at')
                    ->where('issued_to', $employee_code)
                    ->orderBy('id');
                }
                
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 99999999999999 : $request->get('length');
                $data = $tb->select(
                    'id',
                    'par_number',
                    'fullname',
                    'remarks_charged',
                    'remarks_from',
                    'division',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;


            case 'icsall':
                $user = Auth::user();
                $employee_code = $user->username;
                $user_type = $user->account_type;
                # code...
                if($user_type =='Admin')
                {
                    $table = new ICS_Components;
                    $tb = $table->whereNull('deleted_at')->orderBy('id');
                }
                else
                { 
                    $table = new ICS_Components;
                    $tb = $table->whereNull('deleted_at')
                    ->where('issued_to', $employee_code)
                    ->orderBy('id');
                }


                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 99999999999999 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'property_number',
                    'fullname',
                    'remarks_from',
                    'remarks_charged',
                    'ics_number',
                    'component_subpropertynumber',
                    'component_name',
                    'lifespan',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

            case 'app-list':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = $user->account_type;
               
                $table = new Annual_Procurement_Plan_Submissions;
                $tb = $table->whereNull('deleted_at')->orderBy('id');
                # code...
                // if($user_type =='Admin')
                // {
                //     $table = new Annual_Procurement_Plan_Submissions;
                //     $tb = $table->whereNull('deleted_at')->orderBy('id');
                // }
                // else
                // { 
                //     $table = new Annual_Procurement_Plan_Submissions;
                //     $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                //     $tb = $table->whereNull('deleted_at')->orderBy('id');
                // }
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 99999999999999 : $request->get('length');
                 $data = $tb
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

            case 'dppmp-list':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = $user->account_type;
               
                $table = new DPPMP_Reports;
                $tb = $table->whereNull('deleted_at')->orderBy('id');
                # code...
                // if($user_type =='Admin')
                // {
                //     $table = new Annual_Procurement_Plan_Submissions;
                //     $tb = $table->whereNull('deleted_at')->orderBy('id');
                // }
                // else
                // { 
                //     $table = new Annual_Procurement_Plan_Submissions;
                //     $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                //     $tb = $table->whereNull('deleted_at')->orderBy('id');
                // }
                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 99999999999999 : $request->get('length');
                 $data = $tb
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

            case 'icsfiltered':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = $user->account_type;
                $division = $request->filter_division;
                # code...
                if($user_type =='Admin')
                {
                    $table = new ICS_Components;
                    $tb = $table->whereNull('deleted_at')->orderBy('id');
                }
                else
                { 
                    $table = new ICS_Components;
                    $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->orderBy('id');
                }


                $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'property_number',
                    'remarks_from',
                    'remarks_charged',
                    'ics_number',
                    'component_subpropertynumber',
                    'component_name',
                    'lifespan',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->where('division', $division)
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);

            break;

            case 'users':
                # code...
                $table = new PMS_Users;
                $tb = $table->select(['id','fname','lname', 'mname', 'fullname', 'division_acro', 'username'])->where('deleted_at', NULL)->orderBy('lname')->get();
            break;


            // case 'users':
            //     # code...
            //     $table = new View_Users;
            //     $tb = $table->select(['id','fname','lname', 'division_acro', 'username', 'fullname'])->orderBy('lname')->get();
            // break;

            case 'division':
                # code...
                $table = DB::table('divisions');
                $tb = $table->select(['division_acro'])->orderBy('division_acro')->distinct()->get();
            break;
            /**February 26, 2020
            * Drei Cambay
            Removed orderBy('last_known_user') 
            */
            case 'viewequipemp':
                # code...
                $arr = explode(",",$val);
                $table = new Viewequipmentemployee;
                $tb = $table
                        ->whereIn('equip_status',$arr)
                        //  ->orderBy('last_known_user')
                        ->orderBy('equip_status')
                        ->get();
            break;

            case 'viewppedetails':
                $user = Auth::user();
                $empcode = $user->username;
                $user_type = 'Admin';
                # code...
                if($user_type =='Admin')
                {
                    $table = new Components;
                    $tb = $table->whereNull('deleted_at')->orderBy('id')->where('id', $val);
                }
                else
                { 
                    $table = new Components;
                    $tb = $table->whereNull('deleted_at')->where('employee_code', $empcode)->where('id', $val)->orderBy('id');
                }

                return response()->json([
                    'success' => true,
                    'data' => $tb->first()->component_name
                ], 200);
            break;

        }
    
        return  $tb;
    }
    

    public function requestdivision($division_acro)
    {
    //   return json_encode(App\View_Users::where('division_acro',$division_acro)->whereNotNull('position_desc')->get());
    return json_encode(App\PMS_Users::where('division_acro',$division_acro)->where('deleted_at', NULL)->get());
    }

    public function requestdivisionProjectStaff($division_acro)
    {
    return json_encode(App\Project_Staff::where('division_acro',$division_acro)->where('deleted_at', NULL)->get());
    }

    public function requestposition($employee_code)
    {
      return json_encode(App\PMS_Users::where('username',$employee_code)->whereNUll('deleted_at')->get());
    }

    public function requestequipment_details($id)
    {
      return json_encode(App\Equipment::where('id',$id)->get());
    }

     public function requestcomponent_details($id)
    {
      return json_encode(App\Components::where('id',$id)->get());
    }

    public function requestparcomponent_details($set_id)
    {
      return json_encode(App\View_PPE_Items::where('set_id',$set_id)->get());
    }

     public function requesticscomponent_details($id)
    {
      return json_encode(App\ICS_Components::where('id',$id)->get());
    }

     public function requesticscomponent_items_details($id)
    {
      return json_encode(App\ICS_Items::where('set_id',$id)->get());
    }

    public function requestequipment_set_components($id)
    {
      return json_encode(App\Equipment_Set_Components::where('id',$id)->get());
    }


     public function viewrequesticscomponent_items_details($id)
    {
      return json_encode(App\View_ICS_Items::where('set_id',$id)->get());
    }

    public function viewrequesticscomponent_items_details_id($id)
    {
      return json_encode(App\View_ICS_Items::where('id',$id)->get());
    }

    public function viewrequestparcomponent_items_details_id($id)
    {
      return json_encode(App\View_PPE_Items::where('id',$id)->get());
    }


     public function viewrequestppecomponent_items_details($id)
    {
      return json_encode(App\View_PPE_Items::where('set_id',$id)->get());
    }

    public function view_history($set_id, Request $request)
    {
      $tb = App\Equipment_History::where('set_id',$set_id);
      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb->select(
                    'division',
                    'action',
                    'created_at',
                    'staff'
                )
                ->skip($start)
                ->take($length)
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function view_history_ppe($set_id, Request $request)
    {
      $tb = App\Equipment_History_PPE::where('set_id',$set_id);
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



     public function json_icsitems($empcode, Request $request)
    {
      $tb = App\View_ICS_Items::where('issued_to',$empcode);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'ics_number',
                    'component_subpropertynumber',
                    'component_name',
                    'lifespan',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function json_icsitems_division($division, Request $request)
    {
      $tb = App\View_ICS_Items::where('division',$division);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'ics_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'lifespan',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    

    public function json_ics($empcode, Request $request)
    {
      $tb = App\View_ICS_Items::where('issued_to',$empcode);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'ics_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'lifespan',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }



     public function json_paritems($empcode, Request $request)
    {
      $tb = App\View_PPE_Items::where('issued_to',$empcode);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'par_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

      public function json_pardivisionitems($division, Request $request)
    {
      $tb = App\View_PPE_Items::where('division',$division);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'par_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

     public function json_parnumberitems($par_number, Request $request)
    {
      $tb = App\View_PPE_Items::where('par_number',$par_number);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'remarks_from',
                    'par_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

     public function json_rpcppe($year, $ppe_type, Request $request)
    {
      $tb = App\View_PPE_Items::whereYear('date_par',$year)->where('component_classification', $ppe_type);

      $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                 $data = $tb->select(
                    'id',
                    'division',
                    'fullname',
                    'component_umeasure',
                    'value',
                    'remarks_from',
                    'par_number',
                    'property_number',
                    'component_subpropertynumber',
                    'component_name',
                    'component_classification',
                    'component_subclass',
                    'quantity',
                    'serial_num',
                    'issued_to',
                    'status_html',
                    'date_acquired',
                     'remarks',
                    'id as row_id' 
                )
                ->skip($start)
                ->take($length)
                ->get();

              
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

     public function requestuser_empcode($empcode)
    {
      return json_encode(App\HRMS_Users::where('username',$empcode)->get());
    }

}
