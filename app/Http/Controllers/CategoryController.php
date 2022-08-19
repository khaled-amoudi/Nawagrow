<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->query('search');
        if ($search) {
            $categories_res  = Category::where('name', 'LIKE', "%{$search}%")->with('parts')->withCount('parts')->get();
            $categories = CategoryResource::collection($categories_res);
        } elseif (!$search || $search == '') {
            $categories_res = Category::with('parts')->get();
            $categories = CategoryResource::collection($categories_res);
            // $categories = Category::with('parts')->withCount('parts')->get();
        }


        if (!isset($categories)) {
            return response()->fail(404, Session::get('errors'));
        }
        // $categories_count = Category::count();  // use {{ $categories->count() }} instead in blade
        // return view('category.show-categories', compact('categories'))->with('i', 1);
        return response()->success($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $create_category = Category::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
        ]);

        if (!$create_category) {
            // return redirect()->back()->with(['status' => 'category has been created succefully ✔️']);
            return response()->fail(400, "something went wrong !");
        }
        return response()->success($create_category);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $category = new CategoryResource(Category::find($id));
        $category = DB::select('CALL get_category_by_id('.$id.')');
        if (!$category) {
            return response()->fail(404, "this category does not exist !!");
        }
        return response()->success($category);
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

        $category = Category::find($id);

        if (!$category) {
            return response()->fail(404, "this category does not exist");
        }

        $update_category = $category->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]
        ]);


        if (!$update_category) {
            return response()->fail(400, "something went wrong !");
        }
        return response()->success($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->fail(404, "this category does not exist");
        }

        $delete_category = $category->delete();

        if (!$delete_category) {
            return response()->fail(400, "something went wrong !");
        }

        return response()->success($delete_category);
    }
}
