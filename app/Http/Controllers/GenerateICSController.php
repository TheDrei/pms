<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment_Set_Components;
use App\View_ICS_Items;
use App\View_ICS;
use Carbon\Carbon;

class GenerateICSController extends Controller
{

    public function generate($id){
      
      $data = Equipment_Set_Components::where('id', $id)->get();

      $fileName = 'ICS.pdf';
        $mpdf = new \Mpdf\Mpdf([
           'mode' => 'utf-8', 'format' => 'A4', 'default_font' => 'arial', //Landscape format
           'margin_left' => 15,
           'margin_right' => 15,
           'margin_top' => 15,
           'margin_bottom' => 20,
           'margin_header' => 20,
           'margin_footer' => 10
        ]);

        $html = \View::make('pdf.icsreport')->with('data', $data)->with('data1', $data1);
        
        $html = $html->render();

        $mpdf->SetTitle($title);

        $stylesheet = file_get_contents(url('/css/mpdf.css'));
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->WriteHTML($html);


        $mpdf->Output($fileName, 'I');
    
    }

    public function ics(int $set_id) {
        $set = View_ICS_Items::where('set_id', $set_id)->value('date_ics');
        $date = Carbon::createFromFormat('Y-m-d', $set)->format('F d, Y');

        $data = View_ICS_Items::where('set_id', $set_id)->get();
        $data1 = View_ICS_Items::where('set_id', $set_id)->get();
       
        $total_cost = number_format($data->sum('unit_cost'),2);
       
        return \View::make('pdf.icsreport')
        ->with('data', $data)
        ->with('data1', $data1)
        ->with('total_cost', $total_cost)
        ->with('date', $date);
    }

    public function ics_division(int $set_id, string $division) {
        $set = View_ICS_Items::where('set_id', $set_id)->value('date_ics');
        $date = Carbon::createFromFormat('Y-m-d', $set)->format('F d, Y');

        $data = View_ICS_Items::where('set_id', $set_id)->where('division', $division)->get();
        $data1 = View_ICS_Items::where('set_id', $set_id)->where('division', $division)->get();
        $total_cost = number_format($data->sum('unit_cost'),2);
       
        return \View::make('pdf.icsreport')
        ->with('data', $data)
        ->with('data1', $data1)
        ->with('total_cost', $total_cost)
        ->with('date', $date);
    }

    public function ics_staff(int $set_id, string $empcode) {
        $data = View_ICS_Items::where('set_id', $set_id)->where('employee_code', $empcode)->get();
        $data1 = View_ICS_Items::where('set_id', $set_id)->where('employee_code', $empcode)->get();
        $date =  date('F d, Y');
        $total_cost = number_format($data->sum('unit_cost'),2);
       
        return \View::make('pdf.icsreport')
        ->with('data', $data)
        ->with('data1', $data1)
        ->with('total_cost', $total_cost)
        ->with('date', $date);
    }
}
