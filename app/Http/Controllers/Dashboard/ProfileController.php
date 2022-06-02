<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function edit()
    {
        $auth_user = auth('admin')->user();
        $admin = Admin::findOrFail($auth_user->id);
        return view('dashboard.profile.edit', compact('admin'));
    }
    public function update(ProfileRequest $request)
    {

        try {
            $admin = Admin::findOrFail(Auth::user()->id);
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            $admin->update($request->all());
            DB::commit();
            return redirect()->back()->with([
                'success' => __('alerts/success.update'),

            ]);

        } catch (\Exception$exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }

}
