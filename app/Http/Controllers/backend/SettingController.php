<?php

namespace App\Http\Controllers\backend;

use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update-settings');
        $this->middleware('permission:view-activity-log', ['only' => ['activity']]);
    }

    public function index()
    {

        $roles = Role::pluck('name', 'id');
        return view('backend.settings.edit', compact('roles'));
    }

    public function update(Request $request)
    {

        foreach ($request->all() as $key => $value) {
            if ($key !== "_token") {
                if ($key === "company_logo") {
                    if (!is_null($value)) {
                        Setting::set($key, parse_url($value, PHP_URL_PATH));
                    }
                } else {
                    Setting::set($key, $value);
                }
            }
        }
        Setting::save();
        activity('settings')
            ->causedBy(Auth::user())
            ->withProperties($request->all())
            ->log('updated');
        flash('Settings updated successfully!')->success();
        return back();

    }

    public function activity(Request $request)
    {
        $activities = Activity::paginate(setting('record_per_page', 15));
        return view('backend.settings.activity', compact('activities'));
    }
}
