<?php

namespace App\Http\Controllers\Backs\Products;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Models\Products\Product;
use App\Models\Providers\Provider;
use App\Repositories\Products\DetailRepository;
use App\Repositories\Products\ProductRepository;
use App\Services\GetSession;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;
    private $repositoryDetail;

    public function __construct(ProductRepository $repository, DetailRepository $repositoryDetail)
    {
        $this->repository = $repository;
        $this->repositoryDetail = $repositoryDetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->repository->getProductFirst();
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
        $categories = Category::actived()->get();
        $providers = Provider::actived()->get();
        GetSession::putSessionProduct(null);
        return view('backs.managers.products.basic-infos.create',compact(['categories','providers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $product = $this->repository->create($request,null);
        GetSession::putSessionProduct($product->id);
        return redirect()->route('details.create',$product);
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
    public function edit(Product $product)
    {
        $categories = Category::actived()->get();
        $providers = Provider::actived()->get();
        GetSession::putSessionProduct($product->id);
        return view('backs.managers.products.basic-infos.edit',compact(['product','categories','providers']));
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
        return redirect()->route('details.edit',$product);
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

    // product detail

    public function createProductDetail(Product $product)
    {
        return view('backs.managers.products.details.create',compact('product'));
    }

    public function storeProductDetail(Request $request, Product $product)
    {
        $result = $this->repositoryDetail->create($request, $product);
        if ($result == true){
            return 'ok';
        }else{
            return 'err';
        }
    }

    public function editProductDetail(Product $product)
    {
        return view('backs.managers.products.details.edit',compact('product'));
    }

    public function updateProductDetail(Request $request, Product $product)
    {
        $result = $this->repositoryDetail->update($request, $product);
        if ($result == true){
            return 'ok(update)';
        }else{
            return 'err(update)';
        }
    }
}
