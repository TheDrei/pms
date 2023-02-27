<?php

namespace App\Http\Controllers\ICS;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;

class ICSController 
{
    public function getPreviousId()
    {
      $previousId = DB::table('ics_components_items')->max('id');
      return response()->json(['previous_id' => $previousId]);
    }
 }