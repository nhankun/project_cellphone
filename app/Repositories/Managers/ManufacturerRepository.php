<?php

namespace App\Repositories\Managers;

use App\Models\Products\Manufacturer;
use App\Services\Uploads\handleUploadImage;

class ManufacturerRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;

    public function getAll($nbrPages, $parameters)
    {
        return Manufacturer::when(($parameters['search'] != ''),function ($query) use ($parameters) {
            $query->where(function ($q) use ($parameters){
                $q->where('name','like','%'.$parameters['search'].'%')
                    ->orwhere('id','=',$parameters['search']);
            });
        })
            ->when($parameters['order'] != '',function ($query) use ($parameters){
                $query->orderBy($parameters['order'],$parameters['direction']);
            })->paginate($nbrPages);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function getManufacturerById($id)
    {
        return Manufacturer::findOrFail($id);
    }

    public function create($request, $model)
    {
        if (!is_null($model))
        {
            $model->update([
                "name" => $request->name,
                "description" => $request->description,
                "address" => $request->address,
                "website" => $request->website,
                "phone" => $request->phone,
                "email" => $request->email,
            ]);
            $this->updateImage($request,$model);
        }else{
            $model = Manufacturer::create([
                "name" => $request->name,
                "description" => $request->description,
                "address" => $request->address,
                "website" => $request->website,
                "phone" => $request->phone,
                "email" => $request->email,
            ]);
            $this->updateImage($request,$model);
        }
        return $model;
    }
    public function updateImage($request,$model)
    {
        $dir = 'uploads/manufacturer/' . $model->id . '/icon/';
        $avatar = isset($request->icon) ? $request->icon : null;
        $fileLink = $this->handleUploadImage($avatar, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if (!is_null($fileLink)) {
            @unlink($model->icon);
            $model->update(['icon' => $fileLink]);
        }
    }
}
