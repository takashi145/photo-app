<?php

namespace App\Service;

use Image;
use Illuminate\Support\Facades\Storage;

Class ImageService
{
  public static function image_upload($image_name)
  {
        $fileName = uniqid(rand().'_');
        $extension = $image_name->extension();
        $fileNameToStore = $fileName. '.' . $extension;
        $resizedImage = Image::make($image_name)
                        ->resize(1920, 1080)
                        ->encode();
        Storage::put('public/photo/'.$fileNameToStore, $resizedImage);
        return $fileNameToStore;
  }
}