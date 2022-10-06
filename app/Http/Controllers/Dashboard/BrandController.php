<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(PATINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            $img_name = '';
            if ($request->has('photo')) {
                $img_name = uplodeImage('brands', $request->photo);
            }
            $brand = Brand::create($request->except(['_token', 'photo']));
            $brand->photo = $img_name;
            $brand->save();
            DB::commit();
            return redirect()->back()->with([
                'success' => __('alerts/success.add'),

            ]);

        } catch (\Exception$exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::FindOrFail($id);
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::findOrFail($id);
            if ($request->has('photo')) {
                $img_name = uplodeImage('brands', $request->photo);
                Brand::where('id', $id)->update(['photo' => $img_name]);
                $path = public_path('assets/images/brands/' . $brand->photo);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            $brand->update($request->except(['photo', 'id', '_token']));
            DB::commit();
            return redirect()->route('admin.brands.index')->with([
                'success' => __('alerts/success.update'),

            ]);

        } catch (\Exception$exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        Brand::find($id)->delete();
        $path = public_path('assets/images/brands/' . $brand->photo);
        if (File::exists($path)) {
            File::delete($path);
        }
        return redirect()->back()->with(['success' => __('alerts/success.delete')]);

    }
}
