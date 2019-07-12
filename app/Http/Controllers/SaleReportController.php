<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use \Auth, \Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
            $salesReport = Sale::latest()->paginate('10');


        return view('report.sale')->with('saleReport', $salesReport);
    }

    public function getSales(Request $request)
    {
        if ($request->ajax()) {
            $saleReport = Sale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('report.listssale')->with('saleReport', $saleReport);
        }
    }


    public function getSale()
    {
        $saleReport = Sale::pluck('created_at');
        return view('report.getsale')->with('saleReport', $saleReport);
    }



    public function getSaleReport(Request $request)
    {
        if ($request->ajax()) {
            $saleReport = Sale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('report.listsale')->with('saleReport', $saleReport);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}