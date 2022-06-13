<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use App\Repository\VendorRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    private $repository;
    public function __construct(VendorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function index(VendorRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Vendor::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('vendor.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('vendor.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('vendor.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('vendor.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('vendor.create');
    }


    public function store(VendorRequest $request)
    {

        try {
            $validated = $request->validated();
            if ($validated){
                $data = $request->all();
                $checkPhoneDuplication = $this->repository->findByPhoneNumber($data['phone_number']);
                if ($checkPhoneDuplication){
                    throw new Exception('Phone Number already exists');
                }else{
                    $this->repository->create($data);
                    return redirect()->route('vendor.index')->with('success', 'Vendor Created Successfully');
                }
            }
        }catch (Exception $exception){
            return redirect()->route('vendor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $vendor = $this->repository->findByUuid($uuid);
        return view('vendor.info', ['vendor' => $vendor]);
    }


    public function edit($uuid)
    {
        $vendor = $this->repository->findByUuid($uuid);
        return view('vendor.edit', ['vendor' => $vendor]);

    }


    public function update(VendorRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('vendor.index')->with('success','Vendor Updated Successfully');
        }catch (Exception $exception){
            return redirect()->route('vendor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('vendor.index')->with('success','Vendor Deleted Successfully');

        }catch (Exception $exception){
            return redirect()->route('vendor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
