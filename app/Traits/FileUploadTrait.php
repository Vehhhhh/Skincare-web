<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

//handles image upload
trait FileUploadTrait
{
    function uploadImage(Request $request, $inputName, $oldPath = NULL, $path = "/uploads")
    {
        if ($request->hasFile($inputName)) {
            //uploads image
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext; //image . extension (jpg, png, etc...)
            $image->move(public_path($path), $imageName); //move to paths "/uploads"


            //deletes old image if exists
            if ($oldPath && File::exists(public_path($oldPath))) // this line says if $oldPath has value and if $oldPath exists. also using public_path because
            //$oldPath of the old image is also in /uploads which is in public folder.
            {
                File::delete(public_path($oldPath)); //then if it exists, deletes it (for image updating: delete old image & uploads new image);
            }
            return $path . '/' . $imageName;
        }
        return NULL;
    }

    function removeImage(string $path): void
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
