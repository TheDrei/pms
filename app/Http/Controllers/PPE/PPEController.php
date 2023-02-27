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
 }



