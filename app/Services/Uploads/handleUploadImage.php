<?php

namespace App\Services\Uploads;

use Image;
use File;

trait handleUploadImage
{
    public function handleUploadImage($image,$dir,$width,$height)
    {
        if (!is_null($image)) {
            $extension = $image->getClientOriginalExtension();
            $file_name = 'image' . time() . '.' . $extension;
            $file_link = $dir . $file_name;
            if (!File::exists($dir)) {
                mkdir($dir, 666, true);
            }
            Image::make($image->getRealPath())->resize($width, $height)->save($dir . $file_name);
            return $file_link;
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
                $file_name = $first_name . time() . $i . '.' . $extension;
                $file_link = $dir . $file_name;
                if (!File::exists($dir))
                {
                    mkdir($dir, 666, true);
                }
                Image::make($image->getRealPath())->resize($width, $height)->save($dir . $file_name);
                $i++;
                $file_links[] = $file_link;
            }

            return $file_links;
        }
    }
}
