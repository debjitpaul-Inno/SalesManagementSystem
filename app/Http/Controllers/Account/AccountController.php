<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Repository\AccountRepositoryInterface;
use Exception;
use Yajra\DataTables\DataTables;


class AccountController extends Controller
{
    private $repository;

    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(AccountRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Account::latest()->get();
                return DataTables::of($data)->editColumn('reference_number', function (Account $account) {
                    return ucfirst($account->reference_number) ?? 'N/A';
                })->editColumn('type', function (Account $account) {
                    return ucfirst(strtolower($account->type)) ?? 'N/A';
                })->addColumn('status', function ($row) {
                    if ($row->status == "PAID") {
                        return '<span class="badge bg-success mb-1" style="color: green">' . ($row->status == "PAID" ? "Paid" : "Unpaid") . '</span>';
                    }elseif($row->status == "DUE") {
                        return '<span class="badge bg-warning mb-1">' . ($row->status == "DUE" ? "Due" : "Paid") . '</span>';
                    }
                    else {
                        return '<span class="badge bg-danger mb-1" style="color: red">' . ($row->status == "UNPAID" ? "Unpaid" : "Paid") . '</span>';
                    }
                })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('account.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                            <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('account.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('accountManager.account.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function show($uuid)
    {
        $account = $this->repository->findByUuid($uuid);
        return view('accountManager.account.info', ['account' => $account]);
    }
    
    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('account.index')->with('success', 'Account Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('account.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
