<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee_Equipment;
use App\Viewequipmentemployee;
use App\Equipment_History;


class AndroidController extends Controller
{
	public function index($prop_num)
	{
		$response = array();

		$equip = new viewequipmentemployee;

		$equip = $equip
					->where('prop_num',$prop_num)
					->first()
					->toArray();

		$response["success"] = 1;
		$response["data"] = $equip;

		return json_encode($response);
	}

    public function create(Request $request)
    {
        $equip = new Equipment_History;

        $user_empcode = $request->current_empcode;
        if($request->user_empcode != null)
        {
        	$user_empcode = $request->user_empcode;
        }

        //STATUS
        switch ($request->equip_status) {
        	case 'Active':
        	case 'Transfer to Staff':
        			$status = 1;
        		break;
        	
        	case 'Donate':
        			$status = 3;
        		break;
        	case 'For Disposal':
        			$status = 2;
        		break;
        	case 'Dispose':
        			$status = 4;
        		break;
        }

        $equip->equip_serial_num = $request->equip_serial_num;
        $equip->last_known_user = $user_empcode;
        $equip->date_created = $request->equip_date_acquired;
        $equip->equip_remarks = $request->equip_remarks;

        $equip->save();

        $response = array();
        $response["success"] = 1;			
		$response["message"] = "Updated Successfully";	

		return json_encode($response);
    }

}
