<?php

namespace App\Repositories\Admins\Users;

use App\Models\Users\User;

class UserRepository
{
    public function getAll($nbrPages, $parameters)
    {
        return User::when(($parameters['search'] != ''),function ($query) use ($parameters) {
            $query->where(function ($q) use ($parameters){
                $q->where('name','like','%'.$parameters['search'].'%')
                    ->orwhere('id','=',$parameters['search']);
            });
        })
            ->when($parameters['order'] != '',function ($query) use ($parameters){
                $query->orderBy($parameters['order'],$parameters['direction']);
            })->paginate($nbrPages);
    }

    public function delete($user)
    {
        return $user->delete();
    }
}
