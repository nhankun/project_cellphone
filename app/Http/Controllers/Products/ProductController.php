<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Models\Products\Manufacturer;
use App\Models\Products\Product;
use App\Models\Providers\Provider;
use App\Repositories\Products\ProductRepository;
use App\Services\GetSession;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = $request->cookie('product_id');
        if ($product){
            return $this->edit($product);
        }else{
            return $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = $this->repository->getSelectionData();
        $categories = $results['categories'];
        $manufacturers = $results['manufacturers'];
        $providers = $results['providers'];
        return view('backs.managers.products.basic-infos.create',compact(['categories', 'providers','manufacturers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->repository->create($request,null);
        if($request->ajax()) {
            return response()->json([
                'results' => $product,
                'view' => $product ? view('managers.products.images.create')->render() : null
            ])->withCookie('product_id', $product->id);
        }
        return redirect()->route('images.index')
            ->withCookie(
                'product_id', $product->id
            );
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
        $product = $this->repository->getProductById($id);
        $categories = Category::actived()->get();
        $providers = Provider::actived()->get();
        $manufacturers = Manufacturer::all();
        return response(
            view('backs.managers.products.basic-infos.edit',compact(['product','categories','providers','manufacturers']))
                )->withCookie('product_id', $product->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = $this->repository->create($request, $product);
        return redirect()->route('images.index')
            ->withCookie(
                'product_id', $product->id
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setPropertyByCategoried(Request $request)
    {
        $propertyDefault = Category::findOrFail($request->category_id)->properties;
        if ($request->ajax())
        {
            return Response()->json(['result'=>$propertyDefault],200);
        }
        return $propertyDefault;
    }

    public function deleteProperty(Request $request)
    {
        $result = $this->repository->deleteProperty($request->id);
        if ($request->ajax())
        {
            return Response()->json(['result'=>$result],200);
        }
    }

}
