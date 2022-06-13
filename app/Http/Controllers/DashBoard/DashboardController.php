<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $account =  Account::where('type', 'DEBIT')->select('net_total', 'due')->get();
        $revenues=DB::table('transactions')->select(['transactions.id', 'accounts.type', 'transactions.amount'])
            ->join('accounts','transactions.account_id','=','accounts.id')
            ->where('accounts.type', '=', 'DEBIT')
            ->sum('amount');

        $dueCount =  $account->where('due', '!=', 0)->sum('due');
        if ($dueCount > 0){
            $duePercentage =  round($dueCount * 100 / $account->sum('net_total'), 2) ;
        }else{
            $duePercentage = 0;
        }
        $customer = Customer::all();
        $countCustomer = count($customer);
        $members = Member::with('membershipTypes')->get();
        $countMembers = count($members);

        //SELL INCREASE & DECREASE
        $dateFrom = Carbon::now()->subMonth(1);
        $dateTo = Carbon::now();


        $monthly = Transaction::whereBetween('created_at', [$dateFrom, $dateTo])->sum('amount');
        $monthlyCustomer = $customer->whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $monthlyOrder = Order::whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $monthlyProduct = DB::table('product_orders')->whereBetween('created_at', [$dateFrom, $dateTo])->sum('quantity');



        $previousDateFrom = Carbon::now()->subMonth(2);
        $previousDateTo = Carbon::now()->subMonth(1);

        $previousMonthly = Transaction::whereBetween('created_at', [$previousDateFrom,$previousDateTo])->sum('amount');
        $previousMonthCustomer = $customer->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();
        $previousMonthOrder = Order::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();
        $productOrders = DB::table('product_orders')->get();
        $previousMonthProduct = $productOrders->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('quantity');



        //account//
        $percentIncrease = 0;
        $percentDecrease = 0;
        if($previousMonthly < $monthly){
            if($previousMonthly > 0){
                $percent_from = $monthly - $previousMonthly;
                $percentIncrease = $percent_from / $previousMonthly * 100; //increase percent
            }else{
                $percentIncrease = 100; //increase percent
            }
        }else{
            $percent_from = $previousMonthly - $monthly;
            if ($percent_from > 0){
                $percentDecrease = $percent_from / $previousMonthly * 100; //decrease percent
            }else{
                $percentDecrease=0;
            }
        }

        //customer//
        $customerIncrease = 0;
        $customerDecrease = 0;

        if($previousMonthCustomer < $monthlyCustomer){
            if($previousMonthCustomer > 0){
                $customer_percentage = $monthlyCustomer - $previousMonthCustomer;
                $customerIncrease = $customer_percentage / $previousMonthCustomer * 100; //increase percent
            }else{
                $customerIncrease = 100; //increase percent
            }
        }else{
            $customer_percentage = $previousMonthCustomer - $monthlyCustomer;
            if ($customer_percentage > 0){
                $customerDecrease = $customer_percentage / $previousMonthCustomer * 100; //decrease percent
            }else{
                $customerDecrease = 0;
            }

        }

        $order = Order::all();
        $totalOrder = count($order);
        $todaysOrder = Order::whereDate('created_at', $dateTo)->count();

        //order//
        $orderIncrease = 0;
        $orderDecrease = 0;

        if($previousMonthOrder < $monthlyOrder){
            if($previousMonthOrder > 0){
                $order_percentage = $monthlyOrder - $previousMonthOrder;
                $orderIncrease = $order_percentage / $previousMonthOrder * 100; //increase percent
            }else{
                $orderIncrease = 100; //increase percent
            }
        }else{
            $order_percentage = $previousMonthOrder - $monthlyOrder;
            if ($order_percentage > 0){
                $orderDecrease = $order_percentage / $previousMonthOrder * 100; //decrease percent
            }else{
                $orderDecrease = 0;
            }
        }
        //product//
        $products = Product::all();
        $totalProducts = $products->where('quantity', '!=', 0)->count();
        $aboutToStockOut = $products->whereBetween('quantity', [1, 20])->count();
        $unavailableProducts = $products->where('quantity',  0)->count();

        $sellIncrease = 0;
        $sellDecrease = 0;
        if($previousMonthProduct < $monthlyProduct){
            if($previousMonthProduct > 0){
                $product_percentage = $monthlyProduct - $previousMonthProduct;
                $sellIncrease = ($product_percentage / $previousMonthProduct) * 100; //increase percent

            }else{
                $sellIncrease = 100; //increase percent
            }
        }else{
            $product_percentage = $previousMonthProduct - $monthlyProduct;
            if ($product_percentage > 0){
                $sellDecrease = $product_percentage / $previousMonthProduct * 100; //decrease percent
            }else{
                $sellDecrease = 0;
            }
        }


        return view('dashboard.index', ['account' => $account, 'revenues' => $revenues, 'countCustomer' => $countCustomer,
            'customerIncrease' => $customerIncrease, 'customerDecrease' => $customerDecrease,
            'countMembers' => $countMembers, 'percentIncrease' => $percentIncrease,
            'percentDecrease' =>$percentDecrease, 'duePercentage' => $duePercentage,
            'totalOrder' => $totalOrder, 'orderIncrease' => $orderIncrease,
            'orderDecrease' => $orderDecrease, 'todaysOrder' => $todaysOrder,
            'totalProducts' => $totalProducts, 'aboutToStockOut' => $aboutToStockOut, 'unavailableProducts' => $unavailableProducts,
            'sellIncrease' => $sellIncrease, 'sellDecrease' => $sellDecrease
        ]);
    }

    public function accounts($from,$to)
    {
        $account=DB::table('transactions')->select(['transactions.id', 'accounts.type', 'transactions.amount'])
            ->join('accounts','transactions.account_id','=','accounts.id')
            ->where('accounts.type', '=', 'DEBIT')
            ->whereBetween('date', [$from, $to])
            ->sum('amount');
        return $account;

    }

    public function accountCredit()
    {
        $month = Carbon::now()->subDays(30) ;
        $creditAccount =   Account::where('type', 'CREDIT')->whereBetween('created_at',[$month, now()])->limit(30)->orderBy('id', 'desc')->pluck('net_total');
        return $creditAccount;
    }
    public function accountDebit()
    {
        $month = Carbon::now()->subDays(30) ;
        $debitAccount =  Account::where('type', 'DEBIT')->whereBetween('created_at',[$month, now()])->limit(30)->orderBy('id', 'desc')->pluck('net_total');
        return $debitAccount;
    }

    public function earningsForChart()
    {
        $earning = Account::where('type', 'DEBIT')->pluck('net_total');
        return $earning;
    }

    public function customerForChart()
    {
        $customer = Customer::all()->count();
        return $customer;
    }
    public function memberForChart()
    {
        $customer = Customer::all();
        $memberNumbers= $customer->where('members', '!=', null)->count();
        return $memberNumbers;
    }

    public function totalOrdersForChart()
    {

        //last 48 hours orders net total
        $order = Order::whereBetween('created_at', [now()->subMinutes(2880), now()])->pluck('net_total');
        return $order;
    }

    public function stockInAmount()
    {
        //10 descending stock In amount
        $stockIn = DB::table('product_stock_ins')->limit(10)->orderBy('id', 'desc')->pluck('amount');
        return $stockIn;
    }

    public function topProducts()
    {
        $tops = DB::table('product_orders')
            ->leftJoin('products','products.id','=','product_orders.product_id')
            ->selectRaw('products.*, sum(product_orders.quantity) total') // total means as total
            ->groupBy('product_orders.product_id')
            ->orderBy('total','desc')
            ->take(10)
            ->get();

        return $tops;
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
