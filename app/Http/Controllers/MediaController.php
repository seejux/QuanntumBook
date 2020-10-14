<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;


class MediaController extends Controller

{
  public static function getReadableFileSize($size) {
        if($size >= 1<<30 ) return number_format($size/(1<<30),2)." GB";
        if($size >= 1<<20) return number_format($size/(1<<20),2)." MB";
        if($size >= 1<<10) return number_format($size/(1<<10),2)." KB";
        return number_format($size)." bytes";
  }

  public static function getAllImages() {
    $originalImages = Storage::disk('media-uploads')->files();
    $thumbnails = Storage::disk('thumbnail-uploads')->files();

    $images = [];
    $counter = 0;
    foreach($thumbnails as $thumbnail) {
      $image = [$thumbnail, strval(MediaController::getReadableFileSize(Storage::disk('media-uploads')->size($originalImages[$counter])))];
      $images[$counter] = $image;
      $counter++;
    }
    return $images;
  }

  public function index()
  {
    return view('media')->with("thumbnails" , MediaController::getAllImages());
  }

  public function deleteImages($imageNames) {
    $images = explode(",", $imageNames);
    foreach ($images as $imageName) {
      if(is_file(public_path() . '/' . 'media-uploader/' . $imageName)) unlink(public_path() . '/' . 'media-uploader/' . $imageName);
      if(is_file(public_path() . '/' . 'thumbnail-uploader/' . $imageName)) unlink(public_path() . '/' . 'thumbnail-uploader/' . $imageName);
    }
    return redirect()->to('/media');
  }

  public function store(Request $request) {
    if($request->hasFile('images')) {
      $files = $request->file('images');
      $thumbnailFolder = public_path() . '/thumbnail-uploader';
      $mediaFolder = public_path() . '/media-uploader';

      foreach ($files as $file) {
          $fileName = $file->getClientOriginalName();
          $fileSize = $file->getSize();
          Image::make($file)
          ->resize(200,200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
          })
          ->save($thumbnailFolder.'/'.$fileName);

          $file->move($mediaFolder,$fileName);
          // $images[] = [$fileName => $fileSize];
        }
    }
    return redirect()->to('/media');
  }

}
