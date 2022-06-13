<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Product;
use App\Models\Store;
use App\Repository\StoreRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    private $repository;

    public function __construct(StoreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(StoreRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Store::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('description',  function($row) {
                        return  $row->description ?? 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('store.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('store.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('store.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('store.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('store.index')->with('success', 'Store created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('store.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $store = $this->repository->findByUuid($uuid);
        return view('store.info', ['store' => $store]);
    }

    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        return view('store.edit', ['data' => $data]);
    }

    public function update(StoreRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('store.index')->with('success', 'Store Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('store.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('store.index')->with('success', 'Store Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('store.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

}
