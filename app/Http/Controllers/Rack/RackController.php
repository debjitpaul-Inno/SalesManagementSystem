<?php

namespace App\Http\Controllers\Rack;

use App\Http\Controllers\Controller;
use App\Http\Requests\RackRequest;
use App\Models\Rack;
use App\Models\Shelf;
use App\Repository\RackRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class RackController extends Controller
{
    private $repository;
    public function __construct(RackRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(RackRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Rack::latest()->get();
                return DataTables::of($data)
                    ->addColumn('shelf_id',  function($row) {
                        return '<a href="'.route('shelf.show',$row->shelves->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->shelves->shelf_number . '</a>' ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('rack.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('rack.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('rack.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','shelf_id'])
                    ->make(true);
            }
            return view('rack.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $shelves = Shelf::all();
        return view('rack.create', ['shelves' => $shelves]);
    }


    public function store(RackRequest $request)
    {
        try {

            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('rack.index')->with('success', 'Rack created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('rack.index')->withErrors(['error'=>$exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $rack = $this->repository->findByUuid($uuid);
        return view('rack.info', ['rack' => $rack]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        $shelves = Shelf::all();
        return view('rack.edit', ['data' => $data,'shelves'=>$shelves]);
    }


    public function update(RackRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('rack.index')->with('success', 'Rack Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('rack.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('rack.index')->with('success', 'Rack Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('rack.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
