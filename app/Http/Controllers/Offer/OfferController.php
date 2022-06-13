<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Repository\OfferRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    private $repository;

    public function __construct(OfferRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(OfferRequest $request)
    {

        try {
            if ($request->ajax()) {
                $data = Offer::latest()->get();
                return DataTables::of($data)
                    ->editColumn('status', function ($row) {
                        if ($row->status == "AVAILABLE"){
                            return '<span class="badge bg-success mb-1" style="font-size: 13px;font-weight: normal">Available</span>';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1" style="font-size: 13px;font-weight: normal">Not Available</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('offer.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('offer.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('offer.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('offer.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $products = Product::all();
        return view('offer.create', ['products' => $products]);
    }


    public function store(OfferRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                 $data = $request->all();
                 $this->repository->createOffer($data);
                return redirect()->route('offer.index')->with('success', 'Offer created successfully');
            }
        } catch (Exception $exception) {
            return redirect()->route('offer.index')->withErrors(['error' => $exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $offer = $this->repository->findByUuid($uuid);
        return view('offer.info', ['offer' => $offer]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        $selects = DB::table('product_offers')->where('offer_id',$data->id)->get();
        $products = Product::all();
        return view('offer.edit', ['data' => $data, 'products' => $products,'selects'=>$selects]);
    }


    public function update(OfferRequest $request, $uuid)
    {
        try {
             $data = $request->all();
             $this->repository->updateOffer($uuid, $data);
            return redirect()->route('offer.index')->with('success', 'Offer Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->route('offer.index')->withErrors(['error' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteOffer($uuid);
            return redirect()->route('offer.index')->with('success', 'Offer Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('offer.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
