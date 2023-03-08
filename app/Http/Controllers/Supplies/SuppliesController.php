<?php

namespace App\Http\Controllers\Supplies;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;

class SuppliesController 
{
    public function getPreviousId()
    {
      $previousId = DB::table('ics_components_items')->max('id');
      return response()->json(['previous_id' => $previousId]);
    }

    public function for_disposal_supplies()
    {
        return view('disposal.supplies-for-disposal');
    }
    public function disposed_supplies()
    {
        return view('disposal.supplies-disposed');
    }
 }