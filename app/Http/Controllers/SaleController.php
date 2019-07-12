<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Inventory;
use App\Item;
use App\ItemKitItem;
use App\Sale;
use App\SaleItem;
use App\SalePayment;
use App\SaleTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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
        $sales = Sale::orderBy('id', 'desc')->first();
        $customers = Customer::all();
        return view('sale.index')
            ->with('sale', $sales)
            ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validator($request->all())->validate();
        $saleItems = SaleTemp::all();
        if (empty($saleItems->toArray())) {
            Session::flash('message', 'Please Add some Items to create sale!');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $sales = new Sale;
        $sales->customer_id = Input::get('customer_id');
        $sales->user_id = Auth::user()->id;
        $sales->payment_type = Input::get('payment_type');
        $sales->comments = Input::get('comments');
        $discount = Input::get('discount');
        $discount_percent = Input::get('discount_percent');
        $subtotal = Input::get('subtotal');

        $total_discount = $discount + ($discount_percent * $subtotal)/100;
        $sales->discount = $total_discount;
        $tax = $sales->tax = ($subtotal*0)/100;
        $total = $sales->grand_total = $subtotal + $tax - $total_discount;
        //insert payment data in the payment table
        $payment = $sales->payment = Input::get('payment');
        $dues= $sales->dues = $total - $payment;
        if ($dues > 0) {
            $sales->status = 0;
        } else {
            $sales->status = 1;
        }
        $sales->save();
        $customer = Customer::findOrFail($sales->customer_id);
        $customer->prev_balance = $customer->prev_balance + $sales->dues;
        $customer->update();
        if (Input::get('payment') > 0) {
            $payment = new SalePayment;
            $paid = $payment->payment = Input::get('payment');
            $payment->dues = $total - $paid;
            $payment->payment_type = Input::get('payment');
            $payment->comments = Input::get('comments');
            $payment->sale_id = $sales->id;
            $payment->user_id = Auth::user()->id;
            $payment->save();
        }
        // process sale items

        foreach ($saleItems as $value) {
            $saleItemsData = new SaleItem;
            $saleItemsData->sale_id = $sales->id;
            $saleItemsData->item_id = $value->item_id;
            $saleItemsData->cost_price = $value->cost_price;
            $saleItemsData->selling_price = $value->selling_price;
            $saleItemsData->quantity = $value->quantity;
            $saleItemsData->total_cost = $value->total_cost;
            $saleItemsData->total_selling = $value->total_selling;
            $saleItemsData->save();
            //process inventory
            $items = Item::find($value->item_id);
            if ($items->type == 1) {
                $inventories = new Inventory;
                $inventories->item_id = $value->item_id;
                $inventories->user_id = Auth::user()->id;
                $inventories->in_out_qty = -($value->quantity);
                $inventories->remarks = 'SALE' . $sales->id;
                $inventories->save();
                //process item quantity
                $items->quantity = $items->quantity - $value->quantity;
                $items->save();
            } else {
                $itemkits = ItemKitItem::where('item_kit_id', $value->item_id)->get();
                foreach ($itemkits as $item_kit_value) {
                    $inventories = new Inventory;
                    $inventories->item_id = $item_kit_value->item_id;
                    $inventories->user_id = Auth::user()->id;
                    $inventories->in_out_qty = -($item_kit_value->quantity * $value->quantity);
                    $inventories->remarks = 'SALE' . $sales->id;
                    $inventories->save();
                    //process item quantity
                    $item_quantity = Item::find($item_kit_value->item_id);
                    $item_quantity->quantity = $item_quantity->quantity - ($item_kit_value->quantity * $value->quantity);
                    $item_quantity->save();
                }
            }
        }

        //delete all data on SaleTemp model
        SaleTemp::truncate();
        $itemssale = SaleItem::where('sale_id', $saleItemsData->sale_id)->get();
            Session::flash('message', 'You have successfully added sales');
            return view('sale.complete')
                ->with('sales', $sales)
                ->with('saleItemsData', $saleItemsData)
                ->with('saleItems', $itemssale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = 0;
        $sale->update();
        Session::flash('message', 'Sale Open Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = 1;
        $sale->update();
        Session::flash('message', 'Sale Close Successfully');
        return redirect()->back();
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'customer_id'=>'required',
            'payment_type'=>'required',
            'subtotal'=>'required',
            'payment'=>'required'
        ]);
    }
}
