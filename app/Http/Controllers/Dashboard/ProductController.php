<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceRequest;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImages;
use App\Models\Tag;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'slug', 'price', 'created_at', 'is_active')->paginate(PATINATION_COUNT);

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['categories'] = Category::active()->select('id')->get();
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        return view('dashboard.products.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralProductRequest $request)
    {

        try {
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }

            $product = Product::create([
                'slug' => $request->slug,
                'brand_id' => $request->brand_id,
                'is_active' => $request->is_active,
            ]);
            //save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories
            $product->categories()->attach($request->categories);
            $product->tags()->attach($request->tags);
            DB::commit();
            return redirect()->back()->with([
                'success' => __('alerts/success.add'),

            ]);
        } catch (\Exception $exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getPrice($product_id)
    {
        $product = Product::find($product_id);

        return view('dashboard.products.price', compact('product'));
    }
    public function storePrice(ProductPriceRequest $request)
    {

        try {
            DB::beginTransaction();
            $product = Product::find($request->id);
            $product->update([
                'price' => $request->price,
                'special_price' => $request->special_price,
                'special_price_type' => $request->special_price_type,
                'special_price_start' => $request->special_price_start,
                'special_price_end' => $request->special_price_end,
            ]);
            DB::commit();
            return redirect()->route('admin.products.index')->with([
                'success' => __('alerts/success.add'),

            ]);
        } catch (\Exception $exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }
    public function getStock($product_id)
    {
        $product = Product::find($product_id);

        return view('dashboard.products.stock', compact('product'));
    }
    public function storeStock(ProductStockRequest $request)
    {

        try {
            DB::beginTransaction();
            $product = Product::find($request->id);
            $product->update($request->except(['_token', 'id']));
            DB::commit();
            return redirect()->route('admin.products.index')->with([
                'success' => __('alerts/success.add'),

            ]);
        } catch (\Exception $exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }
    public function getImages($product_id)
    {
        $product = Product::with('images')->find($product_id);


        return view('dashboard.products.images', compact('product'));
    }
    public function storeImages(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = uplodeImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function storeImagesDb(ProductImagesRequest $request)
    {

        try {
            DB::beginTransaction();
            if ($request->has('documents') && count($request->documents) > 0) {
                foreach ($request->documents as $document) {
                    $imgs = ProductImages::create([
                        'product_id' => $request->product_id,
                        'photo' => $document,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with([
                'success' => __('alerts/success.add'),

            ]);
        } catch (\Exception $exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }
    public function destroyImg(Request $request)
    {
        $image = ProductImages::find($request->id);
        $image_path = public_path() . '\assets\images\products\\' . $image->photo;
        
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $image->delete();       
        return redirect()->back()->with([
            'success' => __('alerts/success.delete'),
            
        ]);
    }
    
    
    
}
