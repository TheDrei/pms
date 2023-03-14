<?php

namespace App\Http\Controllers\Supplies;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;

class SuppliesController 
{
    public function getPreviousIdICS()
    {
      $previousId = DB::table('last_used_series')->where('id', 2)->max('last_used_series');
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

    public function delete_component($id)
    {
        $ics_items = new App\ICS_Items;
        $ics_items->where('id',$id)
        ->delete();
        return redirect()->back()->with('message-deleted','Success');
    }
 }