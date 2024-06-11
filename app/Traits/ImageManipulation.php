<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageManipulation
{
    public function updateImage($model, $request, &$validated, $file)
    {
        // If the user did not upload a new image, set the URL of the old image
        if (!$request->hasFile('image')) {
            $validated['image'] = $model->image;
        } else {

            // delete the old image and store the new image
            $this->deleteImage($model, $file);
            $this->storeImage($request, $validated, $file);
        }
    }

    public function storeImage($request, &$validated, $file)
    {
        $validated['image'] = $request->file('image')->store($file, 'public');
    }

    public function deleteImage($model, $file)
    {
        $path = public_path("storage/" . "$file/" . basename($model->image));
        File::exists($path) ? File::delete($path) : null;
    }
}
