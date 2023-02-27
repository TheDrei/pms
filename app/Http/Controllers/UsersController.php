<?php

namespace App\Http\Controllers;
use App\PPE_Category;
use App\PPE_SubCategory;
use App\FundCluster_Lib;
use App\HRMS_Users;
use App\PMS_Users;
use App\Project_Staff;


use Illuminate\Http\Request;
use Auth;
use DB;
class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        return view('library.category-library');
    }

    public function subcategory()
    {
        return view('library.subcategory-library');
    }

    // Auto-Fill Functions
    public function getSubCategorybyCategory($category)
    {
        return json_encode(PPE_SubCategory::where('type',$category)->whereNull('deleted_at', )->get()); 
    }

    public function getCategorybySubCategory($subcategory)
    {
        return json_encode(PPE_SubCategory::where('id',$subcategory)->whereNull('deleted_at', )->get()); 
    }
    // End

    // Fund Cluster Library CRUD 
    public function fundCluster()
    {
        return view('library.fundcluster-library');
    }   

    public function usersList(Request $request)
    {
        $table = HRMS_Users::where('deleted_at', NULL);
        // $table = DB::table('view_users')->where('deleted_at',null);
        $totalCount = (clone $table)->count();
                  $draw = $request->get('draw');
                  $start = (!$request->get('start')) ? 0 : $request->get('start');
                  $length = (!$request->get('length')) ? 900000 : $request->get('length');
                   $data = $table
                  ->skip($start)
                  ->take($length)
                  ->orderBy('id', 'ASC')
                  ->get();
                  return response()->json([
                      'success' => true,
                      'draw' => $draw,
                      'recordsTotal' => $totalCount,
                      'recordsFiltered' => $totalCount,
                      'data' => $data,
                  ], 200);
    }   

    public function projectStaffList(Request $request) {
        $table = Project_Staff::where('deleted_at', NULL);
        $totalCount = (clone $table)->count();
        $draw = $request->get('draw');
        $start = (!$request->get('start')) ? 0 : $request->get('start');
        $length = (!$request->get('length')) ? 900000 : $request->get('length');
         $data = $table
        ->skip($start)
        ->take($length)
        ->orderBy('id', 'ASC')
        ->get();
        return response()->json([
            'success' => true,
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $totalCount,
            'data' => $data,
        ], 200);

    }

    public function getProjectStaff($id)
    {
      return json_encode(PMS_Users::where('id',$id)->get());
    }

    public function addProjectStaff(Request $request)
    {
        try
        {
          $project_staff = new Project_Staff;
    
          $project_staff->username = $request->employee_id;
          $project_staff->fullname = $request->full_name;
          $project_staff->usertype = $request->account_type;
          $project_staff->division_acro = $request->division;
          $project_staff->position_desc_current = $request->position;
          $project_staff->save();
       
          return redirect()->back()->with('save-success-projectstaff', 'Successfully Saved!');
        } catch(Exception $e)
        {
          return "ERROR";
        }
    }


    public function editProjectStaff(Request $request)
    {
        $id = $request->update_projectstaff_id;
        DB::table('project_staff')->where('id', $id)
        ->update([
                'username' => $request->update_employee_id, 
                'fullname' => $request->update_full_name, 
                'usertype' => $request->update_account_type, 
                'division_acro' => $request->update_division, 
                'position_desc_current' => $request->update_position
                ]);
        return redirect()->back()->with('update-success-projectstaff', 'Successfully Updated!');
    } 

    public function deleteProjectStaff($id)
    {
        DB::table('project_staff')->where('id', $id)
        ->update([
                'deleted_at' => date('Y-m-d H:i:s')
                ]);
        return redirect()->back()->with('delete-success-projectstaff', 'Successfully Deleted!');
    }

}
