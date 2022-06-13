<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsTemplateRequest;
use App\Models\SmsTemplate;
use App\Repository\SmsTemplateRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SmsTemplateController extends Controller
{
    private $repository;

    public function __construct(SmsTemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(SmsTemplateRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = SmsTemplate::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('sms-template.edit', $row->uuid) . '" class="btn btn-outline-theme mt-1"><i class="fas fa-edit"></i></a>
                                <a href="' . route('sms-template.show', $row->uuid) . '" class="btn btn-outline-theme mt-1"><i class="fas fa-eye"></i></a>
                                <a href="' . route('sms-template.send', $row->uuid) . '" class="btn btn-outline-theme mt-1"><i class="fas bi-send-fill"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('sms-template.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger mt-1"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('smsTemplate.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function sendSms($uuid)
    {
        $template = $this->repository->findByUuid($uuid);
        return view('smsTemplate.send', ['template' => $template]);
    }

    public function create()
    {
        return view('smsTemplate.create');
    }


    public function store(SmsTemplateRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('sms-template.index')->with('success', 'Sms Template created successfully');
            }
        }
        catch (Exception $exception){
            return redirect()->route('sms-template.index')->withErrors(['error'=>$exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $template = $this->repository->findByUuid($uuid);
        return view('smsTemplate.info', ['template' => $template]);
    }

    public function edit($uuid)
    {
        $template = $this->repository->findByUuid($uuid);
        return view('smsTemplate.edit', ['template' => $template]);
    }

    public function update(SmsTemplateRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid,$data);
            return redirect()->route('sms-template.index')->with('success', 'Sms Template Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('sms-template.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('sms-template.index')->with('success', 'Sms Template Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('sms-template.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

}
