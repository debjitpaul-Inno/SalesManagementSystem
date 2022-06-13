<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repository\RoleRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    private $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(RoleRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Role::with('permissions')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)->editColumn('description',  function(Role $role) {
                    return  $role->description ?? 'N/A';
                })
                    ->editColumn('status', function ($row) {
                        if ($row->status == "ACTIVE"){
                            return '<span class="badge bg-success mb-1">'.($row->status == "ACTIVE" ? "Active" : "Inactive") .'</span>';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($row->status == "ACTIVE" ? "Active" : "Inactive" ) .'</span>';
                        }
                    })
                    ->addColumn('permissions', function ($row){
                        return '<div class="badges p-1">'.$row->permissions->map(function($permission){
                                return '
                                   <a href="'.route('permission.show',$permission->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $permission->title . '</a>
                                ' ?? 'N/A';
                            })->implode('') . '</div>';

                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('role.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('role.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('role.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status','permissions'])
                    ->make(true);
            }
            return view('role.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', ['permissions' => $permissions]);
    }


    public function store(RoleRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated) {
                $checkDuplication = $this->repository->findByTitle($data['title']);
                if ($checkDuplication) {
                    throw new \Exception('Title should be unique');
                } else {
                    $this->repository->createRole($data);
                    return redirect()->route('role.index')->with('success', 'Role Created Successfully');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('role.index')->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $role = $this->repository->findByUuid($uuid);
        return view('role.info', ['role' => $role]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->roleByUuid($uuid);
        $permissions = Permission::where(function ($query){
            $query->where('id', '!=', 2);
            $query->where('id', '!=', 3);
            $query->where('id', '!=', 4);
            $query->where('id', '!=', 5);
        })->get();
        return view('role.edit', ['data'=> $data, 'permissions' => $permissions ]);
    }


    public function update(RoleRequest $request, $uuid)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated) {
                $this->repository->updateRole($uuid, $data);
                return redirect()->route('role.index')->with('success', 'Role Updated Successfully');
            }
            else {
                throw new Exception('Validation Failed');
            }
        } catch (\Exception $e) {
            return redirect()->route('role.index')->withErrors(['errors' => $e->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('role.index')->with('success', 'Role Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('role.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
