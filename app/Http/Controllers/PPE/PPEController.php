<?php

namespace App\Http\Controllers\PPE;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;

class PPEController 
{
    public function getPreviousId()
    {
      $previousId = DB::table('equipment_sets_components')->max('id');
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
 }



