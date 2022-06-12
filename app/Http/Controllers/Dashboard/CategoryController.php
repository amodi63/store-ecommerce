<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\CategoryRequest;
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
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id', 'desc')->get();
        Datatables::of($categories)
            ->addIndexColumn()
            ->make(true);
        return view('dashboard.categories.index', compact('categories'));

        // $categories = Category::Parent()->orderBy('id', 'desc')->paginate(PATINATION_COUNT);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('parent_id', 'id')->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {

            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            if ($request->type == CategoryType::mainCategory) {
                $request->request->add(['parent_id' => null]);
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
    public function edit($id)
    {
         $parents = Category::select('parent_id', 'id')->get();
         $category = Category::FindOrFail($id);
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // return $request;
        try {
            $category = Category::findOrFail($id);
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            }
            if ($request->type == CategoryType::mainCategory) {
                $request->request->add(['parent_id' => null]);
            }
            $category->update($request->except('_token', 'id'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with(['success' => __('alerts/success.delete')]);
    }
}
