<?php

namespace App\Http\Controllers\MembershipType;

use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipTypeRequest;
use App\Models\MembershipType;
use App\Repository\MembershipTypeRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MembershipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;
    public function __construct(MembershipTypeRepositoryInterface $repository){
        $this->repository = $repository;
    }
    public function index(MembershipTypeRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = MembershipType::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('membership-type.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('membership-type.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('membership-type.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('membershipType.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function create()
    {
        return view('membershipType.create');
    }


    public function store(MembershipTypeRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated){
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('membership-type.index')->with('success', 'Membership Type Created Successfully');
            }
        }catch (Exception $exception){
            return redirect()->route('membership-type.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $membershipType = $this->repository->findByUuid($uuid);
        return view('membershipType.info', ['membershipType' => $membershipType]);
    }


    public function edit($uuid)
    {
        $membershipType = $this->repository->findByUuid($uuid);
        return view('membershipType.edit', ['membershipType' => $membershipType]);
    }


    public function update(MembershipTypeRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('membership-type.index')->with('success', 'Membership Type Updated successfully');

        }catch (Exception $exception){
            return redirect()->route('membership-type.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('membership-type.index')->with('success', 'Membership Type Deleted successfully');
        }catch (Exception $exception){
            return redirect()->route('membership-type.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }
}
