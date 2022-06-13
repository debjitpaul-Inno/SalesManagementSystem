<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Repository\CustomerRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    private $repository;
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(CustomerRequest $request)
    {
//        $data = Customer::with(['members'])->get();
//        return $data;
        try {
            if ($request->ajax()) {
                $data = Customer::with(['members'])->get();
                return DataTables::of($data)
                    ->addColumn('membership_type_id', function ($row){
                        if ($row->members != null){
                            return '<div class="badges p-1"><a href="' . route('membership-type.show', $row->members->membershipTypes->uuid ?? '') . '" class="badge border border-theme" style="text-decoration: none; color:lawngreen">' .  $row->members->membershipTypes->title .   '</a>
                                    ' ?? 'N/A';  '</div>';
                        }else{
                            return  '<div class="badges p-1"><span class="badge border border-theme text-danger">' .  'N/A' .'</span>' .    '</div>';
                        }

                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('customer.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('customer.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('customer.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','nickname', 'membership_type_id'])
                    ->make(true);
            }
            return view('customer.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('customer.create');
    }

    public function store(CustomerRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated){
                $checkPhoneDuplication = $this->repository->findByPhoneNumber($data['phone_number']);
                if ($checkPhoneDuplication){
                    throw new Exception('Customer Already Exists');
                }else{
                    $this->repository->createCustomer($data);
                    return redirect()->route('customer.index')->with('success', 'Customer Created Successfully');
                }
            }else{
                throw new Exception('Not validated');
            }
        }catch (Exception $exception){
            return redirect()->route('customer.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $customer = $this->repository->findByUuid($uuid);
        return view('customer.info',['customer' => $customer]);
    }


    public function edit($uuid)
    {
        try {
            $customer = $this->repository->findByUuid($uuid);
            return view('customer.edit',['customer' => $customer]);
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }


    public function update(CustomerRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $update = $this->repository->updateCustomer($data, $uuid);
            if ($update){
                return redirect()->route('customer.index')->with('success', 'Customer Updated Successfully');
            }else{
                throw new Exception('Updated Failed');
            }
        }catch (Exception $exception){
            return redirect()->route('customer.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('customer.index')->with('success', 'Customer Deleted Successfully');
        }catch (Exception $exception){
            return $exception->getMessage();
            return redirect()->route('customer.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
