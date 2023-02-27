<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon;
use Session;
class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function spissued_report()
    {
        return view('reports.spissued_report');
    }

    public function propertyledger_report()
    {
        return view('reports.propertyledger_report');
    }

    public function pdf_spissued_report_post(Request $request)
    {
        $rspi_data = [];
        $rspi_data[] = [
            'rspi_serial_number' => $request->rspi_serial_number,
            'fund_cluster' => $request->fund_cluster,
            'start_date' => $request->start_date_issued,
            'end_date' => $request->end_date_issued,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];

        DB::table('spissued_reports')->insert($rspi_data);
        Session::flash('message',"Successfully Saved Data");

        return redirect()->back()->with('message-report', 'save-success');

    }


    public function pdf_spissued_report(Request $request, $start_date, $end_date, $fund_cluster)
    {
        $start_date_get = \Carbon\Carbon::parse($start_date);
        $end_date_get = \Carbon\Carbon::parse($end_date);

        $rspi_serial_number = DB::table('spissued_reports')
        ->where('fund_cluster', $fund_cluster)
        ->where('start_date', $start_date)
        ->where('end_date', $end_date)
        ->pluck('rspi_serial_number')[0]; 
        
        $date_range = $start_date_get->format('F d, Y') . " - " . $end_date_get->format('F d, Y');
        $date =  date('F d, Y');
        $data = DB::table('view_ics_components_items')
        ->where('fund_cluster', $fund_cluster)
        ->whereBetween('date_ics', [$start_date, $end_date])
        ->get();

        return \View::make('pdf.spissued-report')->with('data', $data)
        ->with('date', $date)
        ->with('rspi_serial_number', $rspi_serial_number)
        ->with('date_range', $date_range);
    }

    public function table_spissued_report(Request $request, $start_date, $end_date, $fund_cluster)
    {
        // SELECT * FROM ics_components_items WHERE DATE(date_ics) BETWEEN '2022-06-01' AND '2022-06-01';        
        $tb = DB::table('view_ics_components_items')
        ->where('fund_cluster', $fund_cluster)
        ->whereBetween('date_ics', [$start_date, $end_date])
        ->whereBetween('date_ics', [$start_date, $end_date]);

        $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb
                ->skip($start)
                ->take($length)->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function table_spissued_generated(Request $request)
    {
        
        $tb = DB::table('spissued_reports');

        $totalCount = (clone $tb)->count();
                $draw = $request->get('draw');
                $start = (!$request->get('start')) ? 0 : $request->get('start');
                $length = (!$request->get('length')) ? 10 : $request->get('length');
                $data = $tb
                ->skip($start)
                ->take($length)->get();
                return response()->json([
                    'success' => true,
                    'draw' => $draw,
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $totalCount,
                    'data' => $data,
                ], 200);
    }

    public function table_spissued_generated_by_id($id)
    {
        $tb = DB::table('spissued_reports')->where('id', $id)->get();
        return $tb;
    }

    public function delete_rspi($id)
    {
        $tb = DB::table('spissued_reports')->where('id', $id)->delete();
        return redirect()->back()->with('message-deleted', 'delete-success');
    }

    public function update_rspi(Request $request)
    {
        $id = $request->update_rspi_id;
        $tb = DB::table('spissued_reports');
        $tb->where('id',$id)
        ->update([
          'rspi_serial_number' => $request->update_rspi_serial_number, 
          'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect()->back()->with('message-updated', 'update-success');
    }

    public function pdf_semi_expendable_ledger(Request $request)
    {
       
        $data = DB::table('view_ics_components_items')
        ->get();

        return \View::make('pdf.semiexpendableledger')->with('data', $data);
    }

    public function pdf_ledger_card(Request $request, $set_id)
    {
        $date =  date('F d, Y');
        $data = DB::table('view_ics_components_items')
        ->where('set_id', $set_id)
        ->get();

        return \View::make('pdf.spledgercard-report')->with('data', $data)
        ->with('date', $date);
    }

    public function save_ledgercard_details(Request $request)
    {
        $id = $request->generate_ledgercard_id;
        $tb = DB::table('ics_components_items');
        $tb->where('id',$id)
        ->update([
          'ledger_uacs_code' => $request->ledger_uacs_code, 
          'ledger_date' => $request->ledger_date, 
          'ledger_reference' => $request->ledger_reference, 
          'ledger_issues_transfer_adjustments' => $request->ledger_issues_transfer_adjustments, 
          'ledger_accumulated_impairment_losses' => $request->ledger_accumulated_impairment_losses, 
          'ledger_adjusted_cost' => $request->ledger_adjusted_cost, 
          'ledger_nature_of_repair' => $request->ledger_nature_of_repair, 
          'ledger_amount' => $request->ledger_amount, 
          'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('message-ledgercard', 'save-success');
    }
}
