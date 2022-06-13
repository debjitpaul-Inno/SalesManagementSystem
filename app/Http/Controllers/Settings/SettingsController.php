<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SettingsRequest;
use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private $repository;
    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $settings = Setting::find(1);
        return view('setting.edit', ['settings' => $settings]);
    }

    public function store(SettingsRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                 $this->repository->updateSettings($request);
                return redirect()->route('setting.create')->with('success', 'Settings Updated Successfully');
            }
        } catch (\Exception $exception) {
            return redirect()->route('setting.create')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

}
