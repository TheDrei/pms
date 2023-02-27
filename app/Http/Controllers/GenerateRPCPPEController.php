<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment_Set_Components;
use App\View_PPE_Items;
use DB;

class GenerateRPCPPEController extends Controller
{
    public function generate($id){
      
      $data = Equipment_Set_Components::where('id', $id)->get();

      $fileName = 'PAR.pdf';
        $mpdf = new \Mpdf\Mpdf([
           'mode' => 'utf-8', 'format' => 'A4-L', 'default_font' => 'arial', //Landscape format
           'margin_left' => 15,
           'margin_right' => 15,
           'margin_top' => 15,
           'margin_bottom' => 20,
           'margin_header' => 20,
           'margin_footer' => 10
        ]);

        $html = \View::make('pdf.ppe-par')->with('data', $data)->with('data1', $data1);
        
        $html = $html->render();

        $mpdf->SetTitle($title);

        $stylesheet = file_get_contents(url('/css/mpdf.css'));
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->WriteHTML($html);


        $mpdf->Output($fileName, 'I');
    
    }

    public function rpcppe(int $year, string $ppe_type) {
        $data = View_PPE_Items::whereYear('date_par', $year)->where('component_classification', $ppe_type)->get();
        $unit_value_sum = View_PPE_Items::whereYear('date_par', $year)
        ->where('component_classification', $ppe_type)->sum('amount');
        $quantity = View_PPE_Items::whereYear('date_par', $year)
        ->where('component_classification', $ppe_type)->sum('quantity');
        $certified_by = DB::table('rpcppe_certified_correct_by')->get();

        $date =  date('F d, Y');

        return \View::make('pdf.rpcppe-report')
        ->with('quantity', $quantity)
        ->with('unit_value_sum', $unit_value_sum)
        ->with('data', $data)
        ->with('certified_by', $certified_by)
        ->with('date', $date);
    }
}
