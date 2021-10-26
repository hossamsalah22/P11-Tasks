<?php

namespace app\Http\Traits;

trait media
{
    public function uploadImage($image, $folder)
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images\\' . $folder), $imageName);
        return $imageName;
    }

    public function deleteImage($oldImageName, $folder)
    {
        $oldImagePath = public_path('images\\' . $folder . '\\' . $oldImageName);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
            return TRUE;
        }else {
            return FALSE;
        }
    }
}
