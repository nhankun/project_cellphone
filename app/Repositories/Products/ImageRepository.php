<?php

namespace App\Repositories\Products;

use App\Models\Products\Product;
use App\Services\Uploads\handleUploadImage;

class ImageRepository
{
    use handleUploadImage;

    CONST WIDTH_IMG = 800;
    CONST HEIGHT_IMG = 600;
    CONST TYPE_IMG = 'big';

    public function createAndUpdate($request, $tourCompanyImageId)
    {
        $stringName = '';
        $datas = [];
        $tourCompanyId = $request->tour_company_id;
        $tourCompanyImage = self::getTourCompanyImageByIdOrTourCompanyId($tourCompanyImageId, $tourCompanyId);
        if ($request->hasFile('images')) {
            $stringName = $this->forEachFile($request, $tourCompanyId, $stringName, 'images');
            $datas['images'] = ($tourCompanyImage && $tourCompanyImage->images != '') ? $tourCompanyImage->images.','.$stringName : $stringName;
        }
        if ($tourCompanyImage) {
            $oldLinkAvatar = $tourCompanyImage->avatar;
            $tourCompanyImage->update($datas);
            if(array_key_exists('avatar', $datas) && !empty($oldLinkAvatar)){
                UploadFileToS3::delete($oldLinkAvatar);
            }
        }else {
            $datas['tour_company_id'] = $tourCompanyId;
            $tourCompanyImage = TourCompanyImage::create($datas);
        }

        return [
            'tour_company_image_id' => $tourCompanyImage->id,
            'link' => $stringName
        ];
    }

    public function uploadImage($file, $productId, $imageId, $count)
    {
        $dir = 'images/products/'.$productId.'/general/'.self::TYPE_IMG.'/'.$imageId.'/';
        $file_name = $this->handleUploadImage($file,$dir,self::WIDTH_IMG,self::HEIGHT_IMG,$count);
        return $file_name;
    }

    public function forEachFile($request, $tourCompanyId, $stringName, $input_name)
    {
        foreach ($request->file($input_name) as $index=>$image) {
            $stringName .= ','.$this->uploadImage($image, $tourCompanyId, $index);
        }

        return ltrim($stringName, ',');
    }

    public function delete($request, $id)
    {
        $image = $request->image;
        $tourCompanyImage = self::getTourCompanyImageByIdOrTourCompanyId($id, null);
        $result = false;
        if($tourCompanyImage->images != ''){
            $images = explode(',', $tourCompanyImage->images);
            if(in_array($image, $images)){
                $key = array_search($image, $images);
                unset($images[$key]);
                $tourCompanyImage->images = implode(',', $images);
                $tourCompanyImage->update();
                $result = UploadFileToS3::delete($image);
            }
        }
        return ($result != false) ? $result['@metadata']['statusCode']: $result;
    }

    public static function getTourCompanyImageByIdOrTourCompanyId($tourCompanyImageId, $tourCompanyId)
    {
        return TourCompanyImage::when($tourCompanyImageId != null, function($query) use ($tourCompanyImageId){
            $query->where('id', $tourCompanyImageId);
        }, function($query) use ($tourCompanyId){
            $query->where('tour_company_id', $tourCompanyId);
        })->first();
    }
}
