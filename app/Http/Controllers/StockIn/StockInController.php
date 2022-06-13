<?php

namespace App\Http\Controllers\StockIn;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockInRequest;
use App\Models\Account;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Repository\StockInRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockInController extends Controller
{
    private $repository;

    public function __construct(StockInRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(StockInRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = StockIn::latest()->get();
                return DataTables::of($data)
                    ->addColumn('vendor_id', function ($row) {
                        return '<a href="' . route('vendor.show', $row->vendors->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->vendors->vendor_name . '</a>' ?? 'N/A';
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "PAID") {
                            return '<span class="badge bg-success mb-1">' . ($row->status == "PAID" ? "Paid" : "Unpaid") . '</span>';
                        } elseif ($row->status == "UNPAID") {
                            return '<span class="badge bg-danger mb-1" >' . ($row->status == "UNPAID" ? "Unpaid" : "Paid") . '</span>';
                        } else {
                            return '<span class="badge bg-warning mb-1">' . ($row->status == "DUE" ? "Due" : "Paid") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('stock-in.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('stock-in.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('stock-in.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'vendor_id'])
                    ->make(true);
            }
            return view('stockIn.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $subCategories = SubCategory::all();
        $products = Product::with(['subCategories'])->get();
        return view('stockIn.create', ['products' => $products, 'subCategories' => $subCategories]);
    }

    public function store(StockInRequest $request)
    {
        try {
            if (auth()->user()->profiles != null) {
                $validated = $request->validated();
                if ($validated) {
                    $data = $request->all();
                    $this->repository->createStock($data);
                    return redirect()->route('stock-in.index')->with('success', 'Stock Created Successfully');
                }
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('stock-in.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function edit($uuid)
    {
        $subCategories = SubCategory::all();
        $products = Product::with(['subCategories'])->get();
        $stock = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'stock-' . $stock->voucher_number)->first();
        return view('stockIn.edit', ['subCategories' => $subCategories, 'products' => $products, 'stock' => $stock, 'accounts' => $accounts]);
    }

    public function update(StockInRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profiles != null) {
                $data = $request->all();
                $this->repository->updateStock($data, $uuid);
                return redirect()->route('stock-in.index')->with('success', 'Stock Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('stock-in.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $stock = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'stock-' . $stock->voucher_number)->first();
        return view('stockIn.info', ['stock' => $stock, 'accounts' => $accounts]);
    }
    public function destroy($uuid)
    {
        try {
            $this->repository->deleteStock($uuid);
            return redirect()->route('stock-in.index')->with('success', 'Stock In Record Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('stock-in.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
    public function vendor(Request $request)
    {
        $search = $request->get('search');
        $vendors = Vendor::where('phone_number', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($vendors as $vendor) {
            $response[] = array("value" => $vendor->id, "label" => $vendor->vendor_name . ' (' . $vendor->phone_number . ')', "name" => $vendor->vendor_name, 'phone' => $vendor->phone_number, 'country' => $vendor->vendor_address['country'], 'district' => $vendor->vendor_address['district'], 'ps' => $vendor->vendor_address['ps'], 'zip' => $vendor->vendor_address['zip'], 'address_line' => $vendor->vendor_address['address_line']);
        }
        return response()->json($response);
    }
    public function product(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('barcode_number', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($products as $product) {
            $response[] = array( "title" => $product->title,"id"=>$product->id);
        }
        return response()->json($response);
    }



    public function posIndex(StockInRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = StockIn::latest()->get();
                return DataTables::of($data)
                    ->addColumn('vendor_id', function ($row) {
                        return '<a href="' . route('vendor.show', $row->vendors->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->vendors->vendor_name . '</a>' ?? 'N/A';
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "PAID") {
                            return '<span class="badge bg-success mb-1">' . ($row->status == "PAID" ? "Paid" : "Unpaid") . '</span>';
                        } elseif ($row->status == "UNPAID") {
                            return '<span class="badge bg-danger mb-1" >' . ($row->status == "UNPAID" ? "Unpaid" : "Paid") . '</span>';
                        } else {
                            return '<span class="badge bg-warning mb-1">' . ($row->status == "DUE" ? "Due" : "Paid") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('stockIn.pos.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('stockIn.pos.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('stockIn.pos.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'vendor_id'])
                    ->make(true);
            }
            return view('stockIn.pos.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function posStockCreate()
    {
        return view('stockIn.pos.create');
    }

    public function posStockStore(StockInRequest $request)
    {
        try {
            if (auth()->user()->profiles != null) {
                $validated = $request->validated();
                if ($validated) {
                     $voucher = StockIn::where('voucher_number',$request->voucher_number)->first();
                    if($voucher == null){
                        $data = $request->all();
                        $this->repository->createStock($data);
                        return redirect()->route('stockIn.pos.index')->with('success', 'Stock Created Successfully');
                    }else{
                        throw new Exception('Already have a Stock-In Record against this voucher.');
                    }
                }
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {

            return redirect()->route('stockIn.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function posStockEdit($uuid)
    {
        $stock = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'stock-' . $stock->voucher_number)->first();
        return view('stockIn.pos.edit', ['stock' => $stock, 'accounts' => $accounts]);
    }

    public function posStockUpdate(StockInRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profiles != null) {
                $data = $request->all();
                $this->repository->updateStock($data, $uuid);
                return redirect()->route('stockIn.pos.index')->with('success', 'Stock Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('stockIn.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function posStockShow($uuid)
    {
        $stock = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'stock-' . $stock->voucher_number)->first();
        return view('stockIn.pos.info', ['stock' => $stock, 'accounts' => $accounts]);
    }
    public function posStockDestroy($uuid)
    {
        try {
            $this->repository->deleteStock($uuid);
            return redirect()->route('stockIn.pos.index')->with('success', 'Stock In Record Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('stockIn.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


}
