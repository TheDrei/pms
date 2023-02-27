<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment_Set_Components;
use App\View_ICS_Items;
use App\View_ICS;

class GenerateSemiExpendableCardController extends Controller
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

        $html = \View::make('pdf.semiexpendablecard')->with('data', $data)->with('data1', $data1);
        
        $html = $html->render();

        $mpdf->SetTitle($title);

        $stylesheet = file_get_contents(url('/css/mpdf.css'));
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->WriteHTML($html);


        $mpdf->Output($fileName, 'I');
    
    }

    public function semiexpendablecard(int $id) {
        $data = View_ICS_Items::where('set_id', $id)->get();

        $date =  date('F d, Y');

        return \View::make('pdf.semiexpendablecard')->with('data', $data)->with('date', $date);
    }
}
