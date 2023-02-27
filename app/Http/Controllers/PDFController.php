<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;

use App\Equipment_Set_Components;

use App\ICS_Components;
use App\ICS_Items;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function generatePDFPAR(Request $request, $set_id){

   $data = Equipment_Set_Components::where('set_id',$set_id)->get();

   $count = Equipment_Set_Components::where('set_id',$set_id)->count();

   $date =  date('F d, Y');


   $pdf = PDF::loadView('par', compact('data', 'count', 'date'));


   return $pdf->stream('PAR.pdf');
   }

   public function generatePDFICS(Request $request, $set_id){

   $data = ICS_Items::where('set_id',$set_id)->get();

   $count = ICS_Items::where('set_id',$set_id)->count();

    $data2 = ICS_Items::where('set_id',$set_id)->select('component_name')->get();
  
   $unique = $data2->unique('component_name');


   $date =  date('F d, Y');


   $pdf = PDF::loadView('ICS-Report', compact('data', 'count', 'unique', 'date'));


   return $pdf->stream('ICS.pdf');
   }


    public function generatePDFPropertyCard(Request $request, $equip_id)
    {

   $data = Equipment_Set_Components::where('equip_id',$equip_id)->get();

   $count = Equipment_Set_Components::where('equip_id',$equip_id)->count();

   $date =  date('F d, Y');

   $pdf = PDF::loadView('PropertyCard-Report', compact('data', 'count', 'date'))->setPaper('a4', 'landscape');;

   return $pdf->stream('PropertyCard.pdf');
   }

   
   public function generatePDFRPCPPE($date1){
   
   // $date1 = $request->date_from;

   $data = Equipment_Set_Components::whereDate('date_acquired','=', $date1)->get();

   // $count = Equipment_Set_Components::where('equip_id',$equip_id)->count();

   $date =  date('F d, Y');


   $pdf = PDF::loadView('RPCPPE-Report', compact('data'))->setPaper('legal', 'landscape');;


   return $pdf->stream('RPCPPE.pdf');
   }


    //  function generateDynamic($id,$q,$yr)
    // {
    //     $id = explode(",", $id);

    //     switch ($q) {
    //         case '1':
    //                 $mon1 = 1;
    //                 $mon2 = 3;
    //             break;
    //         case '2':
    //                 $mon1 = 4;
    //                 $mon2 = 6;
    //             break;
    //         case '3':
    //                 $mon1 = 7;
    //                 $mon2 = 9;
    //             break;
    //         default:
    //                 $mon1 = 10;
    //                 $mon2 = 12;
    //             break;
    //     }

    //     $divarray = App\View_project_completed::select('id')->whereIn('id',$id)->whereMonth('enddate','>=',$mon1)->whereMonth('enddate','>=',$mon2)->whereYear('enddate',$yr)->get()->toArray();
     
    //     $div = App\Project_agency::whereIn('project_id',$divarray)->get();

    //     $ctr = 0;
    //     foreach ($div as $key => $value) {
    //         if($value->type == 'Monitoring')
    //             $ctr++;
    //     }
    //   ;
    //     return $ctr;
    // }





}