<?php

namespace App\Services\Uploads;

use Image;
use File;

trait handleUploadImage
{
    public function handleUploadImage($image,$dir,$width,$height, $count = "")
    {
        if (!is_null($image)) {
            $extension = $image->getClientOriginalExtension();
            $fileType = $image->getMimeType();
            $image_valid_extensions = ['image/jpg','image/png','image/jpeg'];
            $file_name = $dir . 'image' . time() . $count . '.' . $extension;
            if (!File::exists($dir)) {
                mkdir($dir, 666, true);
            }
            if(in_array($fileType, $image_valid_extensions)) {
                Image::make($image->getRealPath())->resize($width, $height)->save($file_name);
            }
            return $file_name;
        }
        return null;
    }

    public function handleUploadImages($images,$first_name,$dir,$width,$height)
    {
        if (!is_null($images))
        {
            $i = 0;
            $file_links = [];
            foreach ($images as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $fileType = $image->getMimeType();
                $image_valid_extensions = ['image/jpg','image/png','image/jpeg'];
                $file_name = $first_name . time() . $i . '.' . $extension;
                $file_link = $dir . $file_name;
                if (!File::exists($dir))
                {
                    mkdir($dir, 666, true);
                }
                if(in_array($fileType, $image_valid_extensions)) {
                    Image::make($image->getRealPath())->resize($width, $height)->save($dir . $file_name);
                }
                $i++;
                $file_links[] = $file_link;
            }

            return $file_links;
        }
    }
}
