<?php

namespace App\Repositories\Managers;

use App\Models\Categories\Category;
use App\Services\Uploads\handleUploadImage;

class CategoryRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;

    public function getAll($nbrPages, $parameters)
    {
        return Category::when(($parameters['search'] != ''),function ($query) use ($parameters) {
            $query->where(function ($q) use ($parameters){
                $q->where('name','like','%'.$parameters['search'].'%')
                    ->orwhere('id','=',$parameters['search']);
            });
        })
            ->when($parameters['order'] != '',function ($query) use ($parameters){
                $query->orderBy($parameters['order'],$parameters['direction']);
            })->paginate($nbrPages);
    }

    public function delete($category_id)
    {
        $category = $this->getCategoryById($category_id);
        return $category->delete();
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function create($request, $category_id)
    {
        if (!is_null($category_id))
        {
            $category = $this->getCategoryById($category_id);
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

    public function approved($categoryId)
    {
        $category = $this->getCategoryById($categoryId);
        if (!$category){
            return false;
        }else{
            $category->update([
                "status" => 1,
            ]);
            return true;
        }
    }

    public function cancel($categoryId)
    {
        $category = $this->getCategoryById($categoryId);
        if (!$category){
            return false;
        }else{
            $category->update([
                "status" => 0,
            ]);
            return true;
        }
    }
}
