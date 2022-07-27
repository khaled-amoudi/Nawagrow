<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartRequest;
use App\Http\Resources\PartResource;
use App\Models\Part;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts_res = Part::get();
        $parts = PartResource::collection($parts_res);

        if (!isset($parts)) {
            return response()->fail(404, 'There is no parts yet !!');
        }
        return response()->success($parts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartRequest $request)
    {

        $create_part = Part::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'category_id' => $request->category_id,
        ]);

        if (!$create_part) {
            // return redirect()->back()->with(['status' => 'category has been created succefully ✔️']);
            return response()->fail(400, "something went wrong !");
        }
        return response()->success($create_part);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part = new PartResource(Part::find($id));

        if (!$part) {
            return response()->fail(404, "this part does not exist !!");

        }
        return response()->success($part);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, $id)
    {
        $part = Part::find($id);

        if (!$part) {
            return response()->fail(404, "this part does not exist");
        }

        $update_part = $part->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'category_id' => $request->category_id,
        ]);

        if (!$update_part) {
            return response()->fail(400, "something went wrong !");
        }
        return response()->success($part);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = Part::find($id);

        if (!$part) {
            return response()->fail(404, "this part does not exist");
        }

        $delete_part = $part->delete();

        if (!$delete_part) {
            return response()->fail(400, "something went wrong !");
        }

        return response()->success($delete_part);
    }
}
