<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function editShipping($type)
    {
        if ($type === 'free') {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'local') {
            $shippingMethod = Setting::where('key', 'local_label')->first();
        } elseif ($type === 'outer') {
            $shippingMethod = Setting::where('key', 'outer_label')->first();
        } else {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        }
        return view('dashboard.settings.shippings.edit', compact('shippingMethod'));

    }
    public function updateShipping(ShippingsRequest $request, $id)
    {
        try {
            $shippingMethod = Setting::findOrFail($id);
            DB::beginTransaction();
            $shippingMethod->update(['plain_value' => $request->plain_value]);
            $shippingMethod->value = $request->value;
            $shippingMethod->save();
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
