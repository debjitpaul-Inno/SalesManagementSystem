<?php

namespace App\Http\Controllers\Shelf;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShelfRequest;
use App\Models\Shelf;
use App\Models\Store;
use App\Repository\ShelfRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ShelfController extends Controller
{
    private $repository;
    public function __construct(ShelfRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(ShelfRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Shelf::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('store_id',  function($row) {
                        return '<a href="'.route('store.show',$row->stores->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->stores->title . '</a>' ?? 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('shelf.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('shelf.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('shelf.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','store_id'])
                    ->make(true);
            }
            return view('shelf.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        $stores = Store::all();
        return view('shelf.create',['stores'=>$stores]);
    }


    public function store(ShelfRequest $request)
    {
        try {

            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                    $this->repository->create($data);
                    return redirect()->route('shelf.index')->with('success', 'Shelf created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('shelf.index')->withErrors(['error'=>$exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $shelf = $this->repository->findByUuid($uuid);
        return view('shelf.info', ['shelf' => $shelf]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        $stores = Store::all();
        return view('shelf.edit', ['data' => $data,'stores'=>$stores]);
    }


    public function update(ShelfRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('shelf.index')->with('success', 'Shelf Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('shelf.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('shelf.index')->with('success', 'Shelf Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('shelf.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
