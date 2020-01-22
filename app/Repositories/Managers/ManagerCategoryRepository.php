<?php

namespace App\Repositories\Managers;

use App\Models\Categories\Category;

class ManagerCategoryRepository
{
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

    public function delete($category)
    {
        return $category->delete();
    }
}
