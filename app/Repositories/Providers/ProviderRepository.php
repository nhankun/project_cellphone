<?php

namespace App\Repositories\Providers;

use App\Models\Providers\Provider;
use App\Services\Uploads\handleUploadImage;

class ProviderRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;

    public function getProviderFirst()
    {
        return Provider::first();
    }

    public function create($request, $provider)
    {
        if (!is_null($provider))
        {
            $provider->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "website" => $request->website,
                "address" => $request->address,
                "active" => $request->active,
                "country" => $request->country,
                "city" => $request->city,
                "district" => $request->district,
                "status" => 0,
            ]);
            $this->updateImage($request,$provider);
        }else{
            $provider = Provider::create([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "website" => $request->website,
                "address" => $request->address,
                "active" => $request->active,
                "country" => $request->country,
                "city" => $request->city,
                "district" => $request->district,
                "status" => 0,
            ]);
            $this->updateImage($request,$provider);
        }
        return $provider;
    }
    public function updateImage($request,$provider)
    {
        $dir = 'uploads/providers/' . $provider->id . '/avatar/';
        $avatar = isset($request->avatar) ? $request->avatar : null;
        $fileLink = $this->handleUploadImage($avatar, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if (!is_null($fileLink)) {
            @unlink($provider->icon);
            $provider->update(['icon' => $fileLink]);
        }
    }
}
