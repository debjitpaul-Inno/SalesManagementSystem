<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Customer;
use App\Models\Member;
use App\Models\MembershipType;
use App\Repository\MemberRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    private $repository;
    public function __construct(MemberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(MemberRequest $request)
    {

        try {
            if ($request->ajax()) {
                $data = Member::latest()->get();
                return DataTables::of($data)
                    ->addColumn('customer_id',  function($row) {
                        if ($row->customers != null){
                            return '<a href="'.route('customer.show',$row->customers->uuid ?? '').'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->customers->nickname  . '</a>' ?? 'N/A' ;
                        }else{
                            return '<span class="badge border border-theme text-theme" style="text-decoration: none">'. 'N/A'   . '</a>' ;
                        }
                    })
                    ->addColumn('membership_type_id',  function($row) {
                        if ($row->membershipTypes != null){
                            return '<a href="'.route('membership-type.show',$row->membershipTypes->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->membershipTypes->title ?? '' . '</a>' ?? 'N/A';
                        }else{
                            return '<span class="badge border border-theme text-theme" style="text-decoration: none">'. 'N/A'   . '</a>' ;
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('member.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('member.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('member.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','customer_id', 'membership_type_id'])
                    ->make(true);
            }
            return view('member.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $membershipTypes = MembershipType::all();
        $customers = Customer::all();
        return view('member.create', ['customers' => $customers, 'membershipTypes' => $membershipTypes]);
    }


    public function store(MemberRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('member.index')->with('success', 'Member created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('member.index')->withErrors(['error'=>$exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $member = $this->repository->findByUuid($uuid);
        return view('member.info', ['member' => $member]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);

        $customers = Customer::all();
        $membershipTypes = MembershipType::all();

        return view('member.edit', ['data' => $data,'customers'=>$customers, 'membershipTypes' => $membershipTypes]);
    }


    public function update(MemberRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('member.index')->with('success', 'Member Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('member.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('member.index')->with('success', 'Member Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('member.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
