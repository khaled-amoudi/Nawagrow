<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);





        $fileName = $request->file('file')->store('uploaded_files');
        // $request->file->move(public_path("files") , $fileName)








        // if ($request->hasFile('image_base64')) {
        //     $this->validate($request, ['image_base64' => 'required|file|image|mimes:jpeg,png,gif,svg']);

        //     $file = $request->file('image_base64');
        //     $filename = time().'_'.$file->getClientOriginalName() .".".$file->getClientOriginalExtension();
        //     $response = Storage::putFileAs('images_base64',$file,Str::slug($filename));
        // } else {
        //     //
        // }

        // if ($request->image_base64) {
        //     $folderPath = "uploads/";

        //     $base64Image = explode(";base64,", $request->image_base64);
        //     $explodeImage = explode("image/", $base64Image[0]);
        //     $imageType = $explodeImage[1];
        //     $image_base64 = base64_decode($base64Image[1]);
        //     $file = $folderPath . uniqid() . '. '.$imageType;

        //     file_put_contents($file, $image_base64);
        // } else {
        //     $file = 'no no no';
        // }

        if ($request->hasFile('image_base64')) {
            if($request->file('image_base64')->isValid()) {
                try {
                    $image64 = base64_encode(file_get_contents($request->file('image_base64')));
                    $filename64 = 'base64_' . time() . '.' . $request->file('image_base64')->extension();
                    Storage::put('images_base64/', $filename64);
                } catch (FileNotFoundException $e) {
                    return "no no no";
                }
            }
        }




        $originalImage = $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        // save original image in images folder.
        // $originalPath = public_path() . '/images/';
        // $thumbnailImage->save($originalPath . time() . $originalImage->getClientOriginalName());
        $thumbnailImage->resize(150, 150);
        // save thumbnail image in thumbnail folder.
        $thumbnailPath = public_path() . '/thumbnail/';
        $thumbnailImage->save($thumbnailPath . time() . $originalImage->getClientOriginalName());

        $imageName = time() . $originalImage->getClientOriginalName();






        $uploaded = File::Create([
            'file' => $fileName,
            'image' => $imageName,
            'image_base64' => $filename64
        ]);


        if (!$uploaded) {
            return response()->fail(400, "something went wrong !");
        }
        return response()->success($uploaded);
    }



}
