<?php

namespace App\Http\Controllers;
use App\Library\PPE_Category;
use App\Library\PPE_SubCategory;
use App\Library\FundCluster_Lib;
use App\Library\ICSType_Lib;

use Illuminate\Http\Request;
use Auth;
use DB;
class LibraryController extends Controller
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

    // CATEGORY LIBRARY CRUD
    public function ppeCategoryLibrary(Request $request)
    {
      $table = DB::table('lib_category')->where('deleted_at',null);
      $totalCount = (clone $table)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 900000 : $request->get('length');
                 $data = $table
                ->skip($start)
                ->take($length)
                ->orderBy('type', 'ASC')
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function save(Request $request)
    {
        try
        {
          $categories = new PPE_Category;
    
          $categories->type = $request->category_description;
          $categories->save();
          $category_id = $categories->id;

          return redirect()->back()->with('save-success-ppe-category', 'Successfully Saved!');
        } catch(Exception $e)
        {
          return "ERROR";
        }
    }

    public function delete($id)
    {
        DB::table('lib_category')->where('id', $id)
        ->update([
                'deleted_at' => date('Y-m-d H:i:s')
                ]);
        return redirect()->back()->with('delete-success-ppe-category', 'Successfully Deleted!');
    }

    public function update(Request $request)
    {
        $id = $request->update_category_id;
        DB::table('lib_category')->where('id', $id)
        ->update([
                'type' => $request->update_category_description 
                ]);
        return redirect()->back()->with('update-success-ppe-category', 'Successfully Updated!');
    } 

    public function updateShowData($id)
    {
        return json_encode(PPE_Category::where('id',$id)->whereNull('deleted_at', )->get()); 
    } 
    // End


    // START SUBCATEGORY CRUD
    public function ppeSubCategoryLibrary(Request $request)
    {
      $table = DB::table('lib_subcategory')->where('deleted_at',null);
      $totalCount = (clone $table)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 900000 : $request->get('length');
                 $data = $table
                ->skip($start)
                ->take($length)
                ->orderBy('type', 'ASC')
                ->orderBy('sub_type', 'ASC')
                ->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function saveSubCategory(Request $request)
    {
        try
        {
          $categories = new PPE_SubCategory;
          $categories->type = $request->parent_category;
          $categories->sub_type = $request->category_description;
          $categories->estimated_useful_life = $request->estimated_useful_life;
          $categories->save();
          $category_id = $categories->id;

          return redirect()->back()->with('save-success-ppe-category', 'Successfully Saved!');
        } catch(Exception $e)
        {
          return "ERROR";
        }
    }

    public function deleteSubCategory($id)
    {
        DB::table('lib_subcategory')->where('id', $id)
        ->update([
                'deleted_at' => date('Y-m-d H:i:s')
                ]);
        return redirect()->back()->with('delete-success-ppe-category', 'Successfully Deleted!');
    }

    public function updateSubCategory(Request $request)
    {
        $id = $request->update_category_id;
        DB::table('lib_subcategory')->where('id', $id)
        ->update([
                'type' => $request->update_parent_category,
                'sub_type' => $request->update_category_description,
                'estimated_useful_life' => $request->update_estimated_useful_life 
                ]);
        return redirect()->back()->with('update-success-ppe-category', 'Successfully Updated!');
    } 

    public function updateSubCategoryShowData($id)
    {
        return json_encode(PPE_SubCategory::where('id',$id)->whereNull('deleted_at', )->get()); 
    } 
    // End

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

    public function fundClusterLibrary(Request $request)
    {
        $table = DB::table('fund_cluster_lib')->where('deleted_at',null);
        $totalCount = (clone $table)->count();
                  $draw = $request->get('draw');
                  $start = (!$request->get('start')) ? 0 : $request->get('start');
                  $length = (!$request->get('length')) ? 900000 : $request->get('length');
                   $data = $table
                  ->skip($start)
                  ->take($length)
                  ->orderBy('fund_cluster', 'ASC')
                  ->get();
                  return response()->json([
                      'success' => true,
                      'draw' => $draw,
                      'recordsTotal' => $totalCount,
                      'recordsFiltered' => $totalCount,
                      'data' => $data,
                  ], 200);
    }   

    public function saveFundCluster(Request $request)
    {
        try
        {
          $fund_cluster = new FundCluster_Lib;
          $fund_cluster->fund_cluster = $request->fund_cluster;
          $fund_cluster->status = $request->status;
          $fund_cluster->save();
          $fund_cluster_id = $fund_cluster->id;

          return redirect()->back()->with('save-success-fundcluster', 'Successfully Saved!');
        } catch(Exception $e)
        {
          return "ERROR";
        }
    }

    public function deleteFundCluster($id)
    {
        DB::table('fund_cluster_lib')->where('id', $id)
        ->update([
                'deleted_at' => date('Y-m-d H:i:s')
                ]);
        return redirect()->back()->with('delete-success-fund-cluster', 'Successfully Deleted!');
    }

    public function updateFundCluster(Request $request)
    {
        $id = $request->update_fund_cluster_id;
        DB::table('fund_cluster_lib')->where('id', $id)
        ->update([
                'fund_cluster' => $request->update_fund_cluster,
                'status' => $request->update_status
                ]);
        return redirect()->back()->with('update-success-fund-cluster', 'Successfully Updated!');
    } 

    public function updateFundClusterShowData($id)
    {
        return json_encode(FundCluster_Lib::where('id',$id)->whereNull('deleted_at', )->get()); 
    } 
    // End

     // ICS Type Library CRUD 
     public function icsType()
     {
         return view('library.icstype-library');
     }   

     public function icsTypeLibrary(Request $request)
     {
         $table = DB::table('ics_type_lib')->where('deleted_at',null);
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

     public function saveICSType(Request $request)
     {
         try
         {
           $ics_type = new ICSType_Lib;
           $ics_type->ics_type = $request->ics_type;
           $ics_type->status = $request->status;
           $ics_type->save();
           $ics_type_id = $ics_type->id;
 
           return redirect()->back()->with('save-success-icstype', 'Successfully Saved!');
         } catch(Exception $e)
         {
           return "ERROR";
         }
     }

     public function updateICSType(Request $request)
     {
         $id = $request->update_ics_type_id;
         DB::table('ics_type_lib')->where('id', $id)
         ->update([
                 'ics_type' => $request->update_ics_type,
                 'status' => $request->update_status
                 ]);
         return redirect()->back()->with('update-success-icstype', 'Successfully Updated!');
     } 
 
     public function updateICSTypeShowData($id)
     {
         return json_encode(ICSType_Lib::where('id',$id)->whereNull('deleted_at', )->get()); 
     } 

     public function deleteICSType($id)
     {
         DB::table('ics_type_lib')->where('id', $id)
         ->update([
                 'deleted_at' => date('Y-m-d H:i:s')
                 ]);
         return redirect()->back()->with('delete-success-fund-cluster', 'Successfully Deleted!');
     }
     // End

     public function lastUsedSeriesNumber()
     {
        return view('library.last-used-series');
     }    
     
     public function lastUsedSeriesNumberTable(Request $request)
     {
        $table = DB::table('last_used_series')->where('deleted_at',null);
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
     
     public function lastUsedSeriesNumberShowData($id)
     {
         return json_encode(DB::table('last_used_series')->where('id',$id)->whereNull('deleted_at', )->get()); 
     } 

     public function lastUsedSeriesNumberUpdate(Request $request)
     {
         $id = $request->update_last_used_series_id;
         DB::table('last_used_series')->where('id', $id)
         ->update([
                 'last_used_series' => $request->update_last_used_series,
                 'type' => $request->update_type
                 ]);
         return redirect()->back()->with('update-success-last-used-series', 'Successfully Updated!');
     } 

   // Charging Library CRUD 
    //    public function charging()
    //    {
    //        return view('library.charging-library');
    //    }   
  
    //    public function chargingLibrary(Request $request)
    //    {
    //        $table = DB::table('ics_type_lib')->where('deleted_at',null);
    //        $totalCount = (clone $table)->count();
    //                  $draw = $request->get('draw');
    //                  $start = (!$request->get('start')) ? 0 : $request->get('start');
    //                  $length = (!$request->get('length')) ? 900000 : $request->get('length');
    //                   $data = $table
    //                  ->skip($start)
    //                  ->take($length)
    //                  ->orderBy('id', 'ASC')
    //                  ->get();
    //                  return response()->json([
    //                      'success' => true,
    //                      'draw' => $draw,
    //                      'recordsTotal' => $totalCount,
    //                      'recordsFiltered' => $totalCount,
    //                      'data' => $data,
    //                  ], 200);
    //    }   
  
    //    public function saveCharging(Request $request)
    //    {
    //        try
    //        {
    //          $fund_cluster = new Charging_Lib;
    //          $fund_cluster->ics_type = $request->ics_type;
    //          $fund_cluster->status = $request->status;
    //          $fund_cluster->save();
    //          $fund_cluster_id = $fund_cluster->id;
   
    //          return redirect()->back()->with('save-success-Charging', 'Successfully Saved!');
    //        } catch(Exception $e)
    //        {
    //          return "ERROR";
    //        }
    //    }
  
    //    public function deleteCharging($id)
    //    {
    //        DB::table('ics_type_lib')->where('id', $id)
    //        ->update([
    //                'deleted_at' => date('Y-m-d H:i:s')
    //                ]);
    //        return redirect()->back()->with('delete-success-fund-cluster', 'Successfully Deleted!');
    //    }
       // End

    
}
