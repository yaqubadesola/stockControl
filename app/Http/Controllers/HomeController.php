<?php namespace App\Http\Controllers;

use App\Item, App\Customer, App\Sale;
use App\Supplier, App\Receiving, App\User;
use App;
use App\Expense;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

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
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $items = Item::where('type', 1)->count();
        $expenses = Expense::count();
        $customers = Customer::count();
        $suppliers = Supplier::count();
        $receivings = Receiving::count();
        $sales = Sale::count();
        $employees = User::count();
        $incomeexpensechart = $this->incomeExpenseChart();
        return view('home')
            ->with('items', $items)
            ->with('expenses', $expenses)
            ->with('customers', $customers)
            ->with('suppliers', $suppliers)
            ->with('receivings', $receivings)
            ->with('sales', $sales)
            ->with('employees', $employees)
            ->with('incomeexpensechart', $incomeexpensechart);
    }

    public function test()
    {
        return view('layouts.admin');
    }

    private function getDatesOfWeek()
    {
        $days = array();
        $days[] = date("Y-m-d", strtotime('-14 days'));
        $days[] = date("Y-m-d", strtotime('-13 days'));
        $days[] = date("Y-m-d", strtotime('-12 days'));
        $days[] = date("Y-m-d", strtotime('-11 days'));
        $days[] = date("Y-m-d", strtotime('-10 days'));
        $days[] = date("Y-m-d", strtotime('-9 days'));
        $days[] = date("Y-m-d", strtotime('-8 days'));
        $days[] = date("Y-m-d", strtotime('-7 days'));
        $days[] = date("Y-m-d", strtotime('-6 days'));
        $days[] = date("Y-m-d", strtotime('-5 days'));
        $days[] = date("Y-m-d", strtotime('-4 days'));
        $days[] = date("Y-m-d", strtotime('-3 days'));
        $days[] = date("Y-m-d", strtotime('-2 days'));
        $days[] = date("Y-m-d", strtotime('-1 days'));
        $days[] = date("Y-m-d", strtotime('0 days'));

        return $days;
    }

    public function incomeExpenseChart()
    {
        $daysOfWeek = $this->getDatesOfWeek();
        $incomes = Sale::whereBetween('created_at', [ $daysOfWeek[0].' 00:00:00', $daysOfWeek[6].' 23:59:59'])->get();
        $expenses = Receiving::whereBetween('created_at', [ $daysOfWeek[0].' 00:00:00', $daysOfWeek[6].' 23:59:59'])->get();
        $chartArray = array();
        foreach ($daysOfWeek as $day) {
            $weeklyincome = "0";
            $weeklyexpense = "0";
            $weeklyincome = Sale::whereBetween('created_at', [ $day.' 00:00:00', $day.' 23:59:59'])->count();
            $weeklyexpense = Receiving::whereBetween('created_at', [ $day.' 00:00:00', $day.' 23:59:59'])->count();
            $chart = [
                'y' => $day,
                'a' => $weeklyexpense,
                'b'=>$weeklyincome,
            ];
            $chartArray[] =  $chart;
           
        }
        return $chartArray;
    }

}
