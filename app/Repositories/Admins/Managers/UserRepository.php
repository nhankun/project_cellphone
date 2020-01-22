<?php

namespace App\Repositories\Admins\Managers;


use App\Models\Users\User;
use App\Services\Uploads\handleUploadImage;

class UserRepository
{
    use handleUploadImage;
    CONST WIDTH_IMG = 500;
    CONST HEIGHT_IMG = 500;

    public function create($request,$user)
    {
        if (!is_null($user))
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' =>bcrypt($request->password),
                'address' => $request->address,
                'status' => $request->active == 1 ? 1 : 0,
                'country' => $request->country,
                'city' => $request->city,
                'district' => $request->district,
            ]);
            $this->updateImage($request,$user);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' =>bcrypt($request->password),
                'address' => $request->address,
                'status' => $request->active == 1 ? 1 : 0,
                'country' => $request->country,
                'city' => $request->city,
                'district' => $request->district,
            ]);
            $user->roles()->attach(3); // default role 'user'
            $this->updateImage($request,$user);
        }

        return $user;
    }

    public function updateImage($request,$user)
    {
        $dir = 'uploads/users/' . $user->id . '/avatar/';
        $avatar = isset($request->avatar) ? $request->avatar : null;
        $fileLink = $this->handleUploadImage($avatar, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if (!is_null($fileLink)) {
            @unlink($user->avatar);
            $user->update(['avatar' => $fileLink]);
        }
    }

    public function getUserFirst()
    {
        return User::with('roles')->first();
    }
}
