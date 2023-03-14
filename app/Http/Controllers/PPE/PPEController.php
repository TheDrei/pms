<?php

namespace App\Http\Controllers\PPE;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;

class PPEController 
{
    public function getPreviousIdPAR()
    {
      $previousId = DB::table('last_used_series')->where('id', 1)->max('last_used_series');
      return response()->json(['previous_id' => $previousId]);
    }

    public function for_disposal_ppe()
    {
        return view('disposal.equipment-for-disposal');
    }
    public function disposed_ppe()
    {
        return view('disposal.equipment-disposed');
    }

    public function delete_component($id)
    {
       
        $ppe_items = new App\Equipment_Set_Components;
        $ppe_items->where('id',$id)
        ->delete();
        return redirect()->back()->with('message-deleted','Success');
    }
 }



