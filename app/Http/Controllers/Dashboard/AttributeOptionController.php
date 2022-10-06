<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AttributeOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionsRequest;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AttributeOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = AttributeOption::latest()->with(array('product' => function($q){
            $q->select(array('id'));
        }))->with(array('attributes' => function($q){
            $q->select(array('id'));
        }))->paginate(PATINATION_COUNT); 
        return view('dashboard.attributes.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['attributes'] = Attribute::select('id')->latest()->get();
        $data['products'] = Product::active()->select('id')->latest()->get(); 
        return view('dashboard.attributes.options.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeOptionsRequest $request)
    {
          
        try {
            DB::beginTransaction();
            $option = AttributeOption::create([
                'name' => $request->name,
                'price' => $request->price,
                'product_id' => $request->product_id,
                'attribute_id' => $request->attribute_id,
            ]); 
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
     * @param  \App\Models\AttributeOption  $attributeOption
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeOption $attributeOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeOption  $attributeOption
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['option'] = AttributeOption::find($id); 
        $data['attributes'] = Attribute::select('id')->latest()->get();
        $data['products'] = Product::active()->select('id')->latest()->get(); 
        
        return view('dashboard.attributes.options.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeOption  $attributeOption
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeOptionsRequest $request ,$id)
    {
        try {
            DB::beginTransaction();
            $option = AttributeOption::find($id);
            $option->update($request->except(['id', '_token']));
            DB::commit();
            return redirect()->route('admin.products.attributeoption.index')->with([
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
     * @param  \App\Models\AttributeOption  $attributeOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        AttributeOption::destroy($id);
        return redirect()->back()->with(['success' => __('alerts/success.delete')]);
    }
}
