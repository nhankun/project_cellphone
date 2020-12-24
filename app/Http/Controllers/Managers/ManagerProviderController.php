<?php

namespace App\Http\Controllers\Managers;

use App\Http\Controllers\Controller;
use App\Models\Providers\Provider;
use App\Repositories\Managers\ManagerProviderRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManagerProviderController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(ManagerProviderRepository $repository)
    {
        $this->table = 'providers';
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
                'table' => view('backs.managers.providers.table',['providers'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.providers.index',['providers'=>$records,'links'=>$links]);
    }

    public function destroy(Provider $manager_provider)
    {
        $this->repository->delete($manager_provider);
    }
}
