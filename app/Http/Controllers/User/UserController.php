<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\AuthenticationException;

use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;



class UserController extends Controller
{
//    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository,ProfileRepositoryInterface $profileRepository)
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }


    public function index(UserRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::with('roles')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->addColumn('name', function (User $user) {
                        if ($user->profiles != null) {
                            return $user->profiles->first_name . ' ' . $user->profiles->last_name;
                        } else {
                            return 'N/A';
                        }
                    })
                    ->addColumn('roles', function ($row) {
                        return '<div class="badges p-1">' . $row->roles->map(function ($role) {
                                return '
                                   <a href="' . route('role.show', $role->uuid) . '" class="badge bg-warning mb-1" style="text-decoration: none">' . $role->title . '</a>
                                ' ?? 'N/A';
                            })->implode('') . '</div>';

                    })
                    ->addIndexColumn()
                    ->addColumn('action', function (User $user) {
                        if ($user->profiles != null) {
                            $btn = '<a href="' . route('user.edit', $user->profiles->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('user.show', $user->profiles->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('user.destroy', $user->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        }
                        else{
                            $btn = '<button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('user.destroy', $user->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'roles'])
                    ->make(true);
            }
            return view('user.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function loginPage()
    {
        $setting = Setting::first();
        return view('user.login', ['setting' => $setting]);
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function logIn(LoginRequest $request, Route $route)
    {

        if ($route->methods()[0] == "POST") {
            try {
                $validated = $request->validated();
                $loggedIn = $this->userRepository->login($validated);

                if ($loggedIn === true) {
                    $request->session()->push('user.info', auth()->user());
                    if ($request->hasSession() === true){
                        //store permission in session
                        $user = \auth()->user()->id;
                        $data = User::with(['roles', 'roles.permissions'])->where('id', $user)->first();
                        $role = Arr::get($data, 'roles.0.slug');
                        $permission = Arr::get($data, 'roles');
                        $permissions =[];
                        foreach ($permission as $item){
                            $x = $item['permissions'];
                            array_push($permissions, $x);
                        }
                        $slugs = [];
                        foreach ($permissions as $item){
                            foreach ($item as $i){
                                $permissionsSlug = $i->slug;
                                array_push($slugs,$permissionsSlug);
                            }
                        }
                        $permissionTitle = [];
                        array_push($permissionTitle, 'profile.store', 'profile.edit', 'profile.update', 'profile.show');
                        if ($role == 'owner') {
                            $all_permission = Permission::pluck('slug');
                            foreach ($all_permission as $p) {
                                array_push($permissionTitle, $p);
                            }
                        } else {
                            foreach ($slugs as $item) {
                                array_push($permissionTitle, $item);
                            }
                        }
                        $request->session()->put('permissionTitle', $permissionTitle);
                        return redirect()->route('dashboard')->with('success', 'Welcome');
                    }else{
                        throw new Exception('Please Log In Again');
                    }

                } else {
                    throw new AuthenticationException($loggedIn);
                }
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => $exception->getMessage()
                ]);
            }
        } else {
            return back();
        }

    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles' => $roles]);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();
            $checkDuplication = $this->userRepository->findByEmail($data['email']);
            if ($checkDuplication) {
                throw new Exception('This user is already exist');
            } else {
                $request->validated();
                $this->userRepository->register($request->all());
                return redirect()->route('user.index')->with('success', 'User Created Successfully');
            }
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);

        }
    }

    public function edit($uuid)
    {
        $data = Profile::where('uuid',$uuid)->first();
        $roles = Role::all();
        return view('user.edit', ['data' => $data,'roles'=>$roles]);
    }

    public function update(UpdateUserRequest $request, $uuid)
    {
        try {
             $data = $this->userRepository->updateUser($uuid, $request);
             return redirect()->route('user.index')->with('success', 'User Updated Successfully');
        } catch (Exception $exception) {
            $data = $this->profileRepository->findByUuid($uuid);
            return view('user.edit',['data' => $data])->withErrors(['error'=> $exception->getMessage()]);
        }
    }
    public function show($uuid)
    {
        $data = $this->profileRepository->findByUuid($uuid);
        return view('user.info', ['data' => $data]);
    }
    public function logout(UserRequest $request)
    {
        try {
            Auth::logout();
            if ($request->session()->has(auth()->user())) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login-page');
            } else {
                return 'Logout Failed';
            }
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();
            $user_id = $user->id;
            $this->userRepository->deleteByUuid($uuid);
            profile::where('user_id', $user_id)->delete();
            return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('user.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
