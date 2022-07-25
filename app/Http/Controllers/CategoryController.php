<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        if ($search) {
            $categories  = Category::where('name', 'LIKE', "%{$search}%")->with('parts')->withCount('parts')->get();
        } elseif (!$search || $search == '') {
            $categories = Category::get(['name']);
            // $categories = Category::with('parts')->withCount('parts')->get();
        }


        if (!isset($categories)) {
            return response()->json(Session::get('errors'));
        }
        // $categories_count = Category::count();  // use {{ $categories->count() }} instead in blade
        // return view('category.show-categories', compact('categories'))->with('i', 1);
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return ["error" => "this category does not exist !!"];
        }
        return response()->json($category);
    }

    public function create(CategoryRequest $request)
    {

        $create_category = Category::create([
            'name' => $request->name
        ]);

        if ($create_category) {
            return redirect()->back()->with(['status' => 'category has been created succefully ✔️']);
            // return response()->json($create_category);
        } else {
            // return ["error" => "Worng"];
            return redirect()->back();
        }
    }

    public function update(CategoryRequest $request, $id)
    {

        $category = Category::find($id);

        if (!$category) {
            return ['error' => 'this category does no exist'];
        }
        $update_category = $category->update([
            'name' => $request->name,
        ]);
        if (!$update_category) {
            return $request->errors();
        }
        return response()->json($category);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return ['error' => 'this category does no exist'];
        }
        $delete_category = $category->delete();
        if (!$delete_category) {
            return ['errors'=> 'ERROR'];
        }
        return response()->json($delete_category);
    }
}
