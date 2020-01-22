<?php

namespace App\Http\Controllers\Backs\Managers;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Models\Providers\Provider;
use App\Repositories\Managers\ManagerCategoryRepository;
use App\Repositories\Managers\ManagerProviderRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManagerCategoryController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(ManagerCategoryRepository $repository)
    {
        $this->table = 'categories';
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.'.$this->table),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax())
        {
            return response()->json([
                'table' => view('backs.managers.categories.table',['categories'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.categories.index',['categories'=>$records,'links'=>$links]);
    }

    public function destroy(Category $manager_category)
    {
        $this->repository->delete($manager_category);
    }
}
