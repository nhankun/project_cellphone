<?php

namespace App\Repositories\Categories;

use App\Models\Categories\Category;
use App\Services\Uploads\handleUploadImage;

class CategoryRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;

    public function getCategoryFirst()
    {
        return Category::first();
    }

    public function create($request, $category)
    {
        if (!is_null($category))
        {
            $category->update([
                "name" => $request->name,
                "properties" => isset($request->properties) ? json_encode($request->properties) : null,
                "status" => isset($request->active) ? $request->active : 0,
            ]);
            $this->updateImage($request,$category);
        }else{
            $category = Category::create([
                "name" => $request->name,
                "properties" => isset($request->properties) ? json_encode($request->properties) : null,
                "status" => 0,
            ]);
            $this->updateImage($request,$category);
        }
        return $category;
    }
    public function updateImage($request,$category)
    {
        $dir = 'uploads/categories/' . $category->id . '/icon/';
        $avatar = isset($request->icon) ? $request->icon : null;
        $fileLink = $this->handleUploadImage($avatar, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if (!is_null($fileLink)) {
            @unlink($category->icon);
            $category->update(['icon' => $fileLink]);
        }
    }
}
