<?php

namespace App\Http\Controllers\Damage;

use App\Http\Controllers\Controller;
use App\Http\Requests\DamageRequest;
use App\Models\Account;
use App\Models\Damage;
use App\Models\Product;
use App\Models\StockIn;
use App\Repository\DamageRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DamageController extends Controller
{
    private $repository;

    public function __construct(DamageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(DamageRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Damage::latest()->get();
                return DataTables::of($data)
                    ->addColumn('user_id', function ($row) {
                        return '<a href="' . route('user.show', $row->users->profiles->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->users->profiles->full_name . '</a>' ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('damage.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('damage.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('damage.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','user_id'])
                    ->make(true);
            }
            return view('damage.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $products = Product::all();
        $stockIns = StockIn::all();
        return view('damage.create', ['products' => $products,'stockIns'=>$stockIns]);
    }

    public function store(DamageRequest $request)
    {
//        return $request->all();
        try {
            if (auth()->user()->profiles != null) {
                $validated = $request->validated();
                if ($validated) {
                    $data = $request->all();
                    $this->repository->createDamage($data);
                    return redirect()->route('damage.index')->with('success', 'Damage Registered Successfully');
                }
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('damage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function edit($uuid)
    {
        $products = Product::all();
        $stockIns = StockIn::all();
        $damage = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'damage-' . $damage->reference_number)->first();
        return view('damage.edit', ['products' => $products, 'stockIns' => $stockIns, 'damage' => $damage, 'accounts' => $accounts]);
    }

    public function update(DamageRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profiles != null) {
                $data = $request->all();
                 $this->repository->updateDamage($data, $uuid);
                return redirect()->route('damage.index')->with('success', 'Damage Register Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('damage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $damage = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'damage-' . $damage->reference_number)->first();
        return view('damage.info', ['damage' => $damage, 'accounts' => $accounts]);
    }
    public function destroy($uuid)
    {
        try {
            $this->repository->deleteDamage($uuid);
            return redirect()->route('damage.index')->with('success', 'Damage Record Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('damage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function product(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('barcode_number', 'like', '%' . $search . '%')->get();
        $response = array();
        foreach ($products as $product) {
            $p = DB::table('product_stock_ins')->orderBy('id','DESC')->where('product_id',$product->id)->first();
            $price = $p->unit_price;
            $quantity = Product::where('id',$product->id)->pluck('quantity');
            $response[] = array( "title" => $product->title,"id"=>$product->id,"unit_price"=>$price,"quantity"=>$quantity);
        }
        return response()->json($response);
    }
    public function price($id)
    {
        $price = DB::table('product_stock_ins')->orderBy('id','DESC')->where('product_id',$id)->first();
        return response()->json($price);
    }

    public function posIndex(DamageRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Damage::latest()->get();
                return DataTables::of($data)
                    ->addColumn('user_id', function ($row) {
                        return '<a href="' . route('user.show', $row->users->profiles->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->users->profiles->full_name . '</a>' ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('damage.pos.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('damage.pos.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('damage.pos.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','user_id'])
                    ->make(true);
            }
            return view('damage.pos.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function posCreate()
    {
        $products = Product::all();
        $stockIns = StockIn::all();
        return view('damage.pos.create', ['products' => $products,'stockIns'=>$stockIns]);
    }

    public function posStore(DamageRequest $request)
    {
//        return $request->all();
        try {
            if (auth()->user()->profiles != null) {
                $validated = $request->validated();
                if ($validated) {
                    $data = $request->all();
                    $this->repository->createDamage($data);
                    return redirect()->route('damage.pos.index')->with('success', 'Damage Registered Successfully');
                }
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('damage.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function posEdit($uuid)
    {
        $products = Product::with(['subCategories'])->get();
        $stockIns = StockIn::all();
        $damage = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'damage-' . $damage->reference_number)->first();
        return view('damage.pos.edit', ['products' => $products, 'stockIns' => $stockIns, 'damage' => $damage, 'accounts' => $accounts]);
    }

    public function posUpdate(DamageRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profiles != null) {
                $data = $request->all();
                $this->repository->updateDamage($data, $uuid);
                return redirect()->route('damage.pos.index')->with('success', 'Damage Register Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('damage.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function posShow($uuid)
    {
        $damage = $this->repository->findByUuid($uuid);
        $accounts = Account::where('reference_number', 'damage-' . $damage->reference_number)->first();
        return view('damage.pos.info', ['damage' => $damage, 'accounts' => $accounts]);
    }
    public function posDestroy($uuid)
    {
        try {
            $this->repository->deleteDamage($uuid);
            return redirect()->route('damage.pos.index')->with('success', 'Damage Record Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('damage.pos.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
