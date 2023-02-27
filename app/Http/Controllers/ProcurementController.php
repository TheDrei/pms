<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\View_ICS_Items;
use DB;
use Session;
class ProcurementController extends Controller
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
    public function index()
    {
        return redirect('app');
    }

    public function app()
    {
        return view('procurement.annual-procurement-plan');
    }

    public function dppmp()
    {
        return view('procurement.divisional-procurement-plan');
    }

    public function generateDPPMP($division, $charging)
    {
        $data = View_ICS_Items::where('division', $division)->where('remarks_charged', $charging)->get();
        return view('pdf.dppmp-report')  
        ->with('title', 'PROJECT PROCUREMENT MANAGEMENT PLAN CY 2022')
        ->with('pcaarrd_title', 'Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (PCAARRD)')
        ->with('region')
        ->with('division', $division)
        ->with('charging', $charging)
        ->with('data', $data);
    }

    public function saveDPPMP(Request $request)
    {
        $dppmp_data = [];
        $dppmp_data[] = [
            'dppmp_division' => $request->dppmp_division,
            'dppmp_funding' => $request->dppmp_funding,
            'dppmp_charging' => $request->dppmp_charging,
            'months_from' => $request->months_from,
            'months_to' => $request->months_to,
            'dppmp_year' => $request->dppmp_year,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ];

        DB::table('dppmp_reports')->insert($dppmp_data);
        Session::flash('message',"Successfully Saved Data");

        return redirect()->back()->with('message-report', 'save-success');
    }

    public function deleteDPPMP($id)
    {
        DB::table('dppmp_reports')->where('id', $id)
        ->update([
                'deleted_at' => date('Y-m-d H:i:s')
                ]);
        return redirect()->back()->with('message-deleted', 'Successfully Deleted!');
    }

}
