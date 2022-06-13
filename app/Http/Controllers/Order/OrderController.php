<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Account;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReturn;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Repository\OrderRepositoryInterface;
use Carbon\Carbon;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class OrderController extends Controller
{
    private $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(OrderRequest $request)
    {
        try {
                if ($request->ajax()) {
                        $data = Order::latest()->get();
                    return DataTables::of($data)
                        ->addColumn('status', function ($row) {
                            if ($row->status == "PAID") {
                                return '<span class="badge bg-success mb-1" >' . ($row->status == "PAID" ? "Paid" : "") . '</span>';
                            } elseif ($row->status == "UNPAID") {
                                return '<span class="badge bg-danger mb-1"  >' . ($row->status == "UNPAID" ? "Unpaid" : "") . '</span>';
                            } elseif ($row->status == "DUE") {
                                return '<span class="badge bg-warning mb-1" >' . ($row->status == "DUE" ? "Due" : "") . '</span>';
                            } else {
                                return '<span class="badge warning mb-1"  style="color: red"  >' . ($row->status == "CANCEL" ? "Cancel" : "") . '</span>';
                            }
                        })
                        ->addColumn('created_at',function ($row){
                            return date('d-m-Y', strtotime($row->created_at));
                        })
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                            $btn = '<a href="' . route('order.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('order.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('order.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                            return $btn;
                        })
                        ->rawColumns(['action', 'status'])
                        ->make(true);
                }
                return view('order.index');

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function posIndex(OrderRequest $request)
    {
        if ($request->ajax()) {
            $data = Order::latest()->get();
            return DataTables::of($data)
                ->addColumn('status', function ($row) {
                    if ($row->status == "PAID") {
                        return '<span class="badge bg-success mb-1" >' . ($row->status == "PAID" ? "Paid" : "") . '</span>';
                    } elseif ($row->status == "UNPAID") {
                        return '<span class="badge bg-danger mb-1"  >' . ($row->status == "UNPAID" ? "Unpaid" : "") . '</span>';
                    } elseif ($row->status == "DUE") {
                        return '<span class="badge bg-warning mb-1" >' . ($row->status == "DUE" ? "Due" : "") . '</span>';
                    } else {
                        return '<span class="badge warning mb-1"  style="color: red"  >' . ($row->status == "CANCEL" ? "Cancel" : "") . '</span>';
                    }
                })
                ->addColumn('created_at',function ($row){
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('order.pos.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('order.pos.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('order.pos.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'created_at'])
                ->make(true);
        }
        return view('order.pos.index');
    }


    public function create()
    {
        $subCategories = SubCategory::all();
        $products = Product::with(['subCategories'])->get();
        return view('order.create', ['products' => $products, 'subCategories' => $subCategories]);
    }
    public function posOrderCreate()
    {
        return view('order.pos.create');
    }

    public function store(OrderRequest $request)
    {
        try {
            $settings = Setting::where('id', 1)->first();
            if ($settings != null) {
                if (auth()->user()->profiles != null) {
                    $validated = $request->validated();
                    if ($validated) {
                        $data = $request->all();
                        $this->repository->createOrder($data);
                        return redirect()->route('order.index')->with('success', 'Order Created Successfully');

                    }
                } else {
                    throw new Exception('User does not have a name in system');
                }
            } else {
                throw new Exception('Settings data is required');
            }
        } catch (Exception $exception) {
            return redirect()->route('order.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
    public function posOrderStore(OrderRequest $request)
    {
        try {
            $settings = Setting::where('id', 1)->first();
            if ($settings != null) {
                if (auth()->user()->profiles != null) {
                    $validated = $request->validated();
                    if ($validated) {
                        $data = $request->all();
                         $this->repository->createOrder($data);
                        return redirect()->route('order.pos.create')->with('success', 'Order Created Successfully');
                    }
                } else {
                    throw new Exception('User does not have a name in system');
                }
            } else {
                throw new Exception('Settings data is required');
            }
        } catch (Exception $exception) {
            return redirect()->route('order.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $order = $this->repository->findByUuid($uuid);
        $account = Account::where('reference_number', 'sell-' . $order->order_number)->first();
        return view('order.info', ['order' => $order, 'account' => $account]);
    }
    public function posOrderShow($uuid)
    {
        $order = $this->repository->findByUuid($uuid);
        $account = Account::where('reference_number', 'sell-' . $order->order_number)->first();
        return view('order.pos.info', ['order' => $order, 'account' => $account]);
    }


    public function edit($uuid)
    {
        $order = $this->repository->findByUuid($uuid);
        $subCategories = SubCategory::all();
        $products = Product::with(['subCategories'])->get();
        $accounts = Account::where('reference_number', 'sell-' . $order->order_number)->first();
        return view('order.edit', ['order' => $order, 'subCategories' => $subCategories, 'products' => $products, 'accounts' => $accounts]);
    }

    public function update(OrderRequest $request, $uuid)
    {
        try {
            $settings = Setting::where('id', 1)->first();
            if ($settings != null) {
                if (auth()->user()->profiles != null) {
                    $data = $request->all();
                    $this->repository->updateOrder($data, $uuid);
                    return redirect()->route('order.index')->with('success', 'Order Updated Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            } else {
                throw new Exception('Settings data is required');
            }
        } catch (Exception $exception) {
            return redirect()->route('order.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }

    public function posOrderEdit($uuid)
    {
        $order = $this->repository->findByUuid($uuid);

        $products = Product::with(['subCategories'])->get();
        $accounts = Account::where('reference_number', 'sell-' . $order->order_number)->first();
        return view('order.pos.edit', ['order' => $order, 'products' => $products, 'accounts' => $accounts]);
    }

    public function posOrderUpdate(OrderRequest $request, $uuid)
    {
        try {
            $settings = Setting::where('id', 1)->first();
            if ($settings != null) {
                if (auth()->user()->profiles != null) {
                    $data = $request->all();
                     $this->repository->updateOrder($data, $uuid);
                    return redirect()->route('order.pos.index')->with('success', 'Order Updated Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            } else {
                throw new Exception('Settings data is required');
            }
        } catch (Exception $exception) {
            return redirect()->route('order.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteOrder($uuid);
            return redirect()->route('order.index')->with('success', 'Order Deleted Successfully');
        }catch (Exception $exception){
            return redirect()->route('order.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }

    public function posOrderDestroy($uuid)
    {
        try {
            $this->repository->deleteOrder($uuid);
            return redirect()->route('order.pos.index')->with('success', 'Order Deleted Successfully');
        }catch (Exception $exception){
            return redirect()->route('order.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }

    public function searchProduct(Request $request)
    {
        $date = Carbon::now()->toDateString();
        $search = $request->get('search');
        $products = Product::where('barcode_number', 'like', '%' . $search . '%')->first();
        $response = [];

//        foreach ($products as $product) {
//            $productOffers = DB::table('product_offers')->where('product_id', $product->id)->first();
//            $response[] = array( "title" => $product->title,"id"=>$product->id, 'price' => $product->price, 'quantity' => $product->quantity);
//        }

        $productOffers = DB::table('product_offers')->where('product_id', $products->id)->whereRaw('"'.$date.'" between `start_date` and `end_date`')->latest('created_at')->first();
        if ($productOffers != null) {
            $offer= Offer::where('id', $productOffers->offer_id)->first();
            if ($offer->type == 'BUY_GET'){
                $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'buy_quantity' => $offer->buy_quantity , 'get_quantity' => $offer->get_quantity, 'offer_name' => $offer->name, 'offer_type' => $offer->type);
            }elseif ($offer->type == 'FLAT' || $offer->type == 'PRODUCT_WISE' ){
                if ($offer->offer_on == 'PERCENTAGE'){
                    $cal_percentage = round(( $products->price * $offer->percentage )/100);
                    if ( $cal_percentage > $offer->discount_limit ){
                        $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'after_discount' => $offer->discount_limit, 'offer_name' => $offer->name, 'offer_type' => $offer->type);
                    }else{
                        $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'after_discount' => $cal_percentage, 'offer_name' => $offer->name, 'offer_type' => $offer->type);
                    }
                }else{
                    $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'after_discount' => $offer->amount, 'offer_name' => $offer->name, 'offer_type' => $offer->type);
                }
            }elseif ($offer->type == 'ORDER_AMOUNT' ){
                if ($offer->offer_on == 'AMOUNT'){
                    $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'order_amount' => $offer->order_amount, 'discount_amount' => $offer->amount, 'highest_discount' => $offer->discount_limit, 'offer_name' => $offer->name, 'offer_type' => $offer->type, 'offer_on' => $offer->offer_on);
                }else{
                    $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity, 'order_amount' => $offer->order_amount, 'discount_amount' => $offer->percentage, 'highest_discount' => $offer->discount_limit, 'offer_name' => $offer->name, 'offer_type' => $offer->type, 'offer_on' => $offer->offer_on);
                }
            }
        }else{
            $response[] = array( "title" => $products->title,"id"=>$products->id, 'price' => $products->price, 'quantity' => $products->quantity);
        }

//        foreach ($productOffers as $offer) {
//            return $offer->offers->type;
//        }


        return response()->json($response);
    }

    public function displayProduct($id)
    {
        if ($id === '*') {
            $products = Product::all();
        } else {
            $products = Product::where('sub_category_id', $id)->get();
        }
        return $products;
    }

    public function client(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::with(['members'])->where('phone_number', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($customers as $customer) {
            $response[] = array("value" => $customer->id, "label" => $customer->nickname, 'phone' => $customer->phone_number, 'membershipType' => $customer->members->membershipTypes->title ?? 'N/A', 'membershipDiscount' => $customer->members->membershipTypes->discount ?? '0');
        }
        return response()->json($response);

    }

    public function sellReturn(OrderRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = ProductReturn::latest()->get();
                return DataTables::of($data)
                    ->editColumn('product_id', function($row){
                        return $row->products->title ?? 'N/A';
                    })
                    ->editColumn('order_id', function($row){
//                                return $row->orders->order_number ?? 'N/A';
                        return '<a href="'.route('order.show',$row->orders->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->orders->order_number . '</a>' ?? 'N/A';
                    })
                    ->addColumn('date',function ($row){
                        return date('d-m-Y', strtotime($row->date));
                    }) ->addColumn('status',function ($row){
                        return '<span class="badge bg-warning mb-1" >' . ($row->status ?? 'N/A') . '</span>';
                    })


                    ->addIndexColumn()

                    ->rawColumns(['action', 'status', 'product_id', 'order_id', 'date'])
                    ->make(true);
            }
            return view('order.pos.sellReturn');

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

}
