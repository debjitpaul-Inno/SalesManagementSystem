<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\Models\Sms;
use App\Repository\SmsRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SmsController extends Controller
{
    private $repository;

    public function __construct(SmsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(SmsRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Sms::latest()->get();
                return DataTables::of($data)
                    ->editColumn('created_at', function ($row) {
                        return ucwords($row->created_at->format('d/m/Y') ?? 'N/A');
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('sms.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('sms.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('sms.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('sms.create');
    }

    public function store(SmsRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated) {
                if (auth()->user()->profiles != null) {
                    $this->repository->createSms($data);
                    return redirect()->route('sms.index')->with('success', 'Sms Send Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('sms.index')->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $sms = $this->repository->findByUuid($uuid);
        return view('sms.info', ['sms' => $sms]);
    }

    public function destroy($uuid)
    {
        try {
            $data = $this->repository->deleteByUuid($uuid);
            if (!$data) {
                return back()->withErrors([
                    'message' => "Sms cannot be deleted",
                ]);
            } else {
                return back()->with('success', 'Sms deleted successfully');
            }
        } catch (Exception $exception) {
            return redirect()->route('sms.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
