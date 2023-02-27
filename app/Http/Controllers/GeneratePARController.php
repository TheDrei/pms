<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment_Set_Components;
use App\View_PPE_Items;
use Carbon\Carbon;

class GeneratePARController extends Controller
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

    public function par(int $id) {
        $data = View_PPE_Items::where('set_id', $id)->get();

        $set = View_PPE_Items::where('set_id', $id)->value('date_par');
        $date = Carbon::createFromFormat('Y-m-d', $set)->format('F d, Y');

        // $date =  View_PPE_Items::where('set_id', $id)->value('created_at')->format('F d, Y');
      

        return \View::make('pdf.par')->with('data', $data)->with('date', $date);
    }
}
