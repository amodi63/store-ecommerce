<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {

        if ($type == 'main-category') {
            $categories = Category::Parent()->orderBy('id', 'desc')->get();
            Datatables::of($categories)
                ->addIndexColumn()
                ->make(true);
            return view('dashboard.categories.index', compact('categories'));
        } elseif ($type == 'sub-category') {
            $categories = Category::Child()->orderBy('id', 'desc')->get();
            Datatables::of($categories)
                ->addIndexColumn()
                ->make(true);
            return view('dashboard.subCategories.index', compact('categories'));
        } else {
            $categories = Category::Parent()->orderBy('id', 'desc')->get();
            Datatables::of($categories)
                ->addIndexColumn()
                ->make(true);
        }

        // $categories = Category::Parent()->orderBy('id', 'desc')->paginate(PATINATION_COUNT);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        if ($type == 'sub-category') {
            $categories = Category::Parent()->orderBy('id', 'desc')->get();
            return view('dashboard.subCategories.create', compact('categories'));
        } else {
            return view('dashboard.categories.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        try {

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            Category::create($request->all());
            DB::commit();
            return redirect()->back()->with([
                'success' => __('alerts/success.add'),

            ]);

        } catch (\Exception$exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }

    public function storeSub(SubCategoryRequest $request)
    {
        try {

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            Category::create($request->all());
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
    public function edit($type, $id)
    {
        $parents = Category::Parent()->orderBy('id', 'desc')->get();
        $category = Category::FindOrFail($id);
        if ($type == 'sub-category') {
            return view('dashboard.subCategories.edit', compact('category', 'parents'));
        } else {
            return view('dashboard.categories.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request, $type, $id)
    {
        $type = 'main-category';
        try {
            $category = Category::findOrFail($id);
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            $category->update($request->all());
            DB::commit();
            return redirect()->route('admin.categories.index', $type)->with([
                'success' => __('alerts/success.update'),

            ]);

        } catch (\Exception$exp) {
            return redirect()->back()->with(['error' => __('alerts/errors.update')]);
            DB::rollBack();
        }
    }
    public function updateSub(SubCategoryRequest $request, $type, $id)
    {
        $type = 'sub-category';
        try {
            $category = Category::findOrFail($id);
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            $category->update($request->all());
            DB::commit();
            return redirect()->route('admin.categories.index', $type)->with([
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
    public function destroy($type, $id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with(['success' => __('alerts/success.delete')]);
    }
}
