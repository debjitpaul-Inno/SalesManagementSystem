<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Account;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{

    public function debit(ReportRequest $request)
    {
        try {
            $query = "SELECT t.account_id, t.amount , t.payment_date, t.tx_number, a.id as account_id,
                a.type , a.account_name, a.reference_number,a.uuid
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'DEBIT'";

            $query2 = "SELECT t.account_id, t.amount , t.payment_date, t.tx_number, a.id as account_id,
                a.type , a.account_name, a.reference_number,a.uuid
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'DEBIT'
                AND t.payment_date BETWEEN '{$request->from_date}' AND '{$request->to_date}'";

            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of(DB::select($query))->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->addColumn('tx_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->tx_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number', 'tx_number'])->make(true);
                } else {
                    return DataTables::of(DB::select($query2))->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->addColumn('tx_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->tx_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number', 'tx_number'])->make(true);
                }
            }
            return view('accountManager.report.debit');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function credit(ReportRequest $request)
    {
        try {
            $query = "SELECT t.account_id, t.amount , t.payment_date, t.tx_number, a.id as account_id,
                a.type , a.account_name, a.reference_number,a.uuid
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'CREDIT'";

            $query2 = "SELECT t.account_id, t.amount , t.payment_date, t.tx_number, a.id as account_id,
                a.type , a.account_name, a.reference_number,a.uuid
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'CREDIT'
                AND t.payment_date BETWEEN '{$request->from_date}' AND '{$request->to_date}'";

            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of(DB::select($query))->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        }) ->addColumn('tx_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->tx_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number', 'tx_number'])->make(true);
                } else {
                    return DataTables::of(DB::select($query2))->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        }) ->addColumn('tx_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->tx_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number', 'tx_number'])->make(true);
                }
            }
            return view('accountManager.report.credit');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function creditDue(ReportRequest $request)
    {

        try {
            $query = Account::where('type', 'CREDIT')->where('status', 'DUE')->get();
            $query2 = Account::where('type', 'CREDIT')->where('status', 'DUE')->whereBetween('date', [$request->from_date, $request->to_date])->get();

            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of($query)->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number'])->make(true);
                } else {
                    return DataTables::of($query2)->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number'])->make(true);
                }
            }
            return view('accountManager.report.creditDue');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function debitDue(ReportRequest $request)
    {
        try {
            $query = Account::where('type', 'DEBIT')->where('status', 'DUE')->get();
            $query2 = Account::where('type', 'DEBIT')->where('status', 'DUE')->whereBetween('date', [$request->from_date, $request->to_date])->get();

            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of($query)->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number'])->make(true);
                } else {
                    return DataTables::of($query2)->addIndexColumn()
                        ->editColumn('reference_number', function ($row) {
                            return '<a href="' . route('account.show', $row->uuid) . '" class="badge border border-theme text-theme" style="text-decoration: none">' . $row->reference_number . '</a>' ?? 'N/A';
                        })
                        ->rawColumns(['reference_number'])->make(true);
                }
            }
            return view('accountManager.report.debitDue');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
