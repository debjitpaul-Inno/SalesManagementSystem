<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Rack;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Repository\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private $repository;
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index(ProductRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Product::latest()->get();
                return DataTables::of($data)
                    ->editColumn('status', function ($row) {
                        if ($row->status == "AVAILABLE"){
                            return '<span class="badge bg-warning mb-1">'.($row->status == "AVAILABLE" ? "Available" : "Not Available") .'</span>';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($row->status == "AVAILABLE" ? "Available" : "Not Available" ) .'</span>';
                        }
                    })
                    ->editColumn('model',  function($row) {
                        return  $row->model ?? 'N/A';
                    })
                    ->editColumn('brand',  function($row) {
                        return  $row->brand ?? 'N/A';
                    }) ->editColumn('image',  function($row) {
                        if ($row->image != null){
                            $url= asset('storage/images/product/'.$row->image);
                            return '<img src="'.$url.'" alt="image" height=45 width=45 style="border-radius:25% "></img>' ;
                        }else{
                            $url= asset('assets/img/no-image/no-image-available.jpg');
                            return '<img src="'.$url.'" alt="image" height=45 width=45 style="border-radius:25% "></img>' ;
                        }

                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('product.barcode', $row->uuid) . '" class="btn btn-outline-theme"><i class="bi bi-upc-scan"></i></a>
                                <a href="' . route('product.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('product.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('product.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status', 'image'])
                    ->make(true);
            }
            return view('product.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        $vendors = Vendor::all();
        $subCategories = SubCategory::all();
        $racks = Rack::all();
        return view('product.create', ['subCategories' => $subCategories,'racks'=> $racks, 'vendors' => $vendors]);
    }

    public function store(ProductRequest $request)
    {
        try {
            $rack_id =[];
            foreach ($request->rack_id as $rack){
                array_push($rack_id, $rack[0]);
            }

            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                $this->repository->createProduct($data,$rack_id);
                return redirect()->route('product.index')->with('success', 'Product created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('product.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $product = $this->repository->findByUuid($uuid);
        return view('product.info', ['product' => $product]);
    }

    public function edit($uuid)
    {
        $vendors = Vendor::all();
        $data = $this->repository->findByUuid($uuid);
        $subCategories = SubCategory::all();
        $racks = Rack::all();

        return view('product.edit', ['data' => $data,'subCategories' => $subCategories,'racks'=> $racks, 'vendors' => $vendors]);
    }

    public function update(ProductRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateProduct($uuid,$data);
            return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('product.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('product.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function imageSubmit(Request $request){

        try {
            $image = $this->repository->storeImage($request,'public/images/product');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }
    public function imageUpdate(Request $request, $uuid)
    {
        try {
            $image = $this->repository->updateImage($request,$uuid, 'public/images/product');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    public function closeToStockOut(Request $request)
    {
        try {
            if (\request()->route()->uri() == 'product/close-to-stock-out/list'){
                if ($request->ajax()) {

                        $data = Product::whereBetween('quantity', [1,20])->get();
                        return DataTables::of($data)
                            ->addIndexColumn()
                            ->make(true);
                    }
                return view('product.closeToStockOut');
            }else{
                if ($request->ajax()) {
                    $data = Product::where('quantity', 0)->get();
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->make(true);
                }
                return view('product.unavailableProduct');
            }

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function barcode($uuid)
    {
        try {

            $data = $this->repository->findByUuid($uuid);
            $barcode_number = [$data->barcode_number];
            $fileName = 'Barcode.pdf';

            $mpdf = new Mpdf([
                'format' => [80,20],
                'margin_top' => 2,
                'margin_left' => 2,
                'margin_right' => 2,
                'margin_bottom' => 2,
            ]);

            $html = \view('product.barcodePdf', compact('barcode_number'));
            $html = $html->render();
            $mpdf->SetTitle('Barcode');
            $mpdf->WriteHTML($html, 0);
            $mpdf->Output($fileName, 'I');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
