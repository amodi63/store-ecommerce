<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;



class SliderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $images = Slider::get(['image', 'id']);
        return view('dashboard.slider.create', compact('images'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function storeImages(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = uplodeImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function storeImagesDb(SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->has('documents') && count($request->documents) > 0) {
                foreach ($request->documents as $document) {
                    $imgs = Slider::create([
                        'image' => $document,
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with([
                'success' => __('alerts/success.add'),

            ]);
        } catch (\Exception $exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }
    public function destroyImg(Request $request)
    {
        $slider = Slider::find($request->id);
        $image_path = public_path() . '\assets\images\sliders\\' . $slider->image;
        
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $slider->delete();       
        return redirect()->back()->with([
            'success' => __('alerts/success.delete'),
            
        ]);
    }
    
    
    
}
