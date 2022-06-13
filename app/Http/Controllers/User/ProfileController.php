<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Department;
use App\Models\DoctorCategory;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\User;
use App\Repository\ProfileRepositoryInterface;
use Exception;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    private $repository;

    public function __construct(ProfileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('profile.info');
    }


    public function edit($uuid)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $data = Profile::where('user_id', $user->id)->first();

        return view('profile.edit', ['data' => $data]);
    }


    public function store(ProfileRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated) {
                $checkPhoneDuplication = $this->repository->findByPhoneNumber($request->phone_number);
                $checkNidDuplication = $this->repository->findByNid($request->nid);
                if ($checkPhoneDuplication) {
                    throw new Exception('Phone Number Should Be Unique ');
                }
                elseif ($checkNidDuplication) {
                        throw new Exception('NID Should Be Unique');
                    }
                else {
                    $data = $this->repository->createProfile($request);
//                    return view('profile.info', ['data' => $data])->with('success', 'User Updated Successfully');
                    return redirect()->route('profile.show', $data->uuid)->with('success', 'Profile Updated Successfully');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('profile.edit', auth()->user()->uuid)->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function update(ProfileRequest $request, $uuid)
    {

        try {
            $profile = $this->repository->updateProfile($uuid, $request);
            return redirect()->route('profile.show', $profile->uuid)->with('success', 'Profile Updated Successfully');
        } catch (Exception $exception) {
//            return $exception->getMessage();
            $data = $this->repository->findByUuid($uuid);
            return view('profile.edit', ['data' => $data])->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        return view('profile.info', ['data' => $data]);

    }

    public function imageSubmit(Request $request)
    {
        try {
            $image = $this->repository->storeImage($request, 'public/images/profile');
            return $image;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function imageUpdate(Request $request, $uuid)
    {
        try {
            $image = $this->repository->updateProfileImage($request, $uuid, 'public/images/profile');
            return $image;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

}
