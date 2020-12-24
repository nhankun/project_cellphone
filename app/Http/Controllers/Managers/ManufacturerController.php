<?php

namespace App\Http\Controllers\Managers;

use App\Http\Controllers\Controller;
use App\Repositories\Managers\ManufacturerRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(ManufacturerRepository $repository)
    {
        $this->table = "manufacturers";
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parameters = $this->getParameters($request);
        $records = $this->repository->getAll(config('app.nbrPages.back.'.$this->table),$parameters);

        $links = $records->appends($parameters)->links('pagination');

        if ($request->ajax())
        {
            return response()->json([
                'table' => view('backs.managers.manufacturers.table',['manufacturers'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.managers.manufacturers.index',['manufacturers'=>$records,'links'=>$links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backs.managers.manufacturers.create');
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
        return redirect()->route('manufacturers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturer = $this->repository->getManufacturerById($id);
        return view('backs.managers.manufacturers.edit',compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manufacturer = $this->repository->getManufacturerById($id);
        $this->repository->create($request,$manufacturer);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = $this->repository->getManufacturerById($id);
        $this->repository->delete($manufacturer);
    }
}
