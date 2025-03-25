<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ImageUploadTrait {


    public function uploadImage(Request $request, $inputName, $path)
    {
        if($request->hasFile($inputName)){

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path('uploads'), $imageName);
            $path = "public/uploads/".$imageName;
            return $path;
       }
    }


    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];
        
        if($request->hasFile($inputName)){

            $images = $request->{$inputName};

            foreach($images as $image){

                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_'.uniqid().'.'.$ext;

                $image->move(public_path('uploads'), $imageName);

                $imagePaths[] =  "public/uploads/".$imageName;
            }

            return $imagePaths;
       }
    }


    public function updateImage(Request $request, $inputName, $path, $oldPath=null)
    {
        // if($request->hasFile($inputName)){
        //     if(File::exists(public_path($oldPath))){
        //         File::delete(public_path($oldPath));
        //     }

        if($request->hasFile($inputName)){
            if(File::exists($oldPath)){
                File::delete($oldPath);
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path('uploads'), $imageName);
            $path = "public/uploads/".$imageName;
           return $path;
       }
    }

    /** Handle Delte File */
    public function deleteImage(string $path)
    {
        if(File::exists($path)){
            File::delete($path);
        }
    }
}

