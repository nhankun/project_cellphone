<?php

namespace App\Http\Controllers\Admins\Managers;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Repositories\Admins\Managers\CategoryRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(CategoryRepository $repository)
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
                'table' => view('backs.admins.managers.categories.table',['categories'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.admins.managers.categories.index',['categories'=>$records,'links'=>$links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backs.admins.managers.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->create($request, null);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId)
    {
        $category = $this->repository->getCategoryById($categoryId);
        return view('backs.admins.managers.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId)
    {
        $this->repository->create($request,$categoryId);
        return redirect()->back();
    }

    public function destroy($categoryId)
    {
        return $this->repository->delete($categoryId);
    }

    public function approved($categoryId)
    {
        $results = $this->repository->approved($categoryId);
        if($results){
            return response(["success" => true]);
        }else{return response(["success" => false]);}
    }

    public function cancel($categoryId)
    {
        $results = $this->repository->cancel($categoryId);
        if($results){
            return response(["success" => true]);
        }else{return response(["success" => false]);}
    }
}
