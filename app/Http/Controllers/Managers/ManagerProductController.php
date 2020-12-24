<?php

namespace App\Http\Controllers\Backs\Managers;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Repositories\Managers\ManagerProductRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManagerProductController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(ManagerProductRepository $repository)
    {
        $this->table = 'products';
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
                'table' => view('backs.managers.products.table',['products'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.products.index',['products'=>$records,'links'=>$links]);
    }

    public function destroy(Product $manager_product)
    {
        $this->repository->delete($manager_product);
    }
}
