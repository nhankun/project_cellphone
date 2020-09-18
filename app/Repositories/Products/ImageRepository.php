<?php

namespace App\Repositories\Products;

use App\Models\Products\Image;
use App\Models\Products\Product;
use App\Services\Uploads\handleUploadImage;

class ImageRepository
{
    use handleUploadImage;

    CONST WIDTH_IMG = 800;
    CONST HEIGHT_IMG = 600;
    CONST TYPE_IMG = 'general';

    public function createAndUpdate($request, $imageId)
    {
        $stringName = '';
        $datas = [];
        $datas['title'] = '';
        $datas['type'] =  self::TYPE_IMG;
        $productId = $request->product_id;
        $datas['product_id'] = $productId;
        $productImage = self::getProductImageByIdOrProductId($imageId, $productId);

        if ($request->hasFile('images')) {
            $stringName = $this->forEachFile($request, $productId, $stringName, 'images');
            $datas['link'] = ($productImage && $productImage->link != '') ? $productImage->link.','.$stringName : $stringName;
        }
        if ($productImage) {
            $productImage = $productImage->update($datas);
        }else {
            $productImage = Image::create($datas);
        }

        return [
            'image_id' => $imageId,
            'link' => $stringName
        ];
    }

    public function uploadImage($file, $productId, $imageId, $count = '')
    {
        $dir = 'uploads/products/'.$productId.'/general/'.self::TYPE_IMG.'/'.$imageId.'/';
        $file_name = $this->handleUploadImage($file,$dir,self::WIDTH_IMG,self::HEIGHT_IMG,$count);
        return $file_name;
    }

    public function forEachFile($request, $productId, $stringName, $input_name)
    {
        foreach ($request->file($input_name) as $index=>$image) {
            $stringName .= ','.$this->uploadImage($image, $productId, $index);
        }

        return ltrim($stringName, ',');
    }

    public function delete($request, $id)
    {
        $image = $request->image;
        $productImage = self::getProductImageByIdOrProductId($id, null);
        if($productImage->link != ''){
            $images = explode(',', $productImage->link);
            if(in_array($image, $images)){
                $key = array_search($image, $images);
                unset($images[$key]);
                $productImage->link = implode(',', $images);
                $productImage->update();
            }
        }
        return $productImage;
    }

    public static function getProductImageByIdOrProductId($productImageId, $productId)
    {
        return Image::when($productImageId != null, function($query) use ($productImageId){
            $query->where('id', $productImageId)->where('type', self::TYPE_IMG);
        }, function($query) use ($productId){
            $query->where('product_id', $productId)->where('type', self::TYPE_IMG);
        })->first();
    }
}
