<?php

namespace App\Repositories\Products;

use App\Models\Categories\Category;
use App\Models\Products\Image;
use App\Models\Products\Manufacturer;
use App\Models\Products\Product;
use App\Models\Products\Property;
use App\Models\Providers\Provider;
use App\Services\Uploads\handleUploadImage;

class ProductRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;
    CONST TYPE_IMG = 'small';

    public function getProductFirst()
    {
        return Product::first();
    }

    public function create($request, $product)
    {
        if (!is_null($product))
        {
            $product->update([
                'category_id'=>$request->category,
                'provider_id'=>$request->provider,
                'manufacturer_id' => $request->manufacturer,
                "name" => $request->name,
                'quantity'=>$request->quantity,
                'price'=>$request->price,
                'description'=>$request->description,
                "status" => isset($request->active) ? $request->active : 0,
            ]);
            $this->createOrUpdateProperties($request,$product->id);
            $this->updateImageTypeSmall($request,$product);
        }else{
            $product = Product::create([
                'category_id'=>$request->category,
                'provider_id'=>$request->provider,
                'manufacturer_id' => $request->manufacturer,
                "name" => $request->name,
                'quantity'=>$request->quantity,
                'price'=>$request->price,
                'description'=>$request->description,
                "status" => isset($request->active) ? $request->active : 0,
            ]);
            $this->createOrUpdateProperties($request,$product->id);
            $this->updateImageTypeSmall($request,$product);
        }
        return $product;
    }

    public function getProductById($product_id)
    {
        return Product::findOrFail($product_id);
    }

    public function getImageByTypeAndProduct($type,$product_id)
    {
        return Image::where('type',$type)->where('product_id',$product_id)->first();
    }

    public function updateImageTypeSmall($request,$product)
    {
        $image = $this->getImageByTypeAndProduct(self::TYPE_IMG,$product->id);

        $dir = 'uploads/products/' . $product->id . '/general/'.self::TYPE_IMG.'/';
        $avatar = isset($request->avatar) ? $request->avatar : null;
        $fileLink = $this->handleUploadImage($avatar, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if (!is_null($fileLink)) {
            if ($image){
                @unlink($image->link);
                $image->update(['link' => $fileLink,'type'=> self::TYPE_IMG]);
            }else{
                Image::create(['product_id' => $product->id,'link' => $fileLink,'title'=> $product->name,'type'=> self::TYPE_IMG]);
            }

        }
    }

    public function createOrUpdateProperties($request, $product_id)
    {
        $product = $this->getProductById($product_id);
        foreach ($request->properties as $key => $value) {
            if (strpos($key, 'new') !== false) {
                Property::create([
                    'product_id' => $product->id,
                    'name' => $value['name'],
                    'value' => $value['value'],
                    'sort' => 1,
                ]);
            } else {
                $property = Property::find($key);
                $property->update([
                    'product_id' => $product->id,
                    'name' => $value['name'],
                    'value' => $value['value'],
                    'sort' => 1,
                ]);
            }
        }
    }

    public function getSelectionData()
    {
        return [
            "categories" => Category::actived()->get(),
            "manufacturers" => Manufacturer::actived()->get(),
            "providers" => Provider::actived()->get()
        ];
    }

    public function deleteProperty($id)
    {
        return Property::findOrFail($id)->delete();
    }
}
