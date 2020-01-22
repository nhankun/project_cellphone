<?php

namespace App\Http\Controllers\Backs\Admins\Managers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Admins\Managers\Users\UserRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Users\User;
use App\Repositories\Admins\Managers\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
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
        $user = $this->repository->getUserFirst();
        if ($user){
            return  redirect()->route('admin_users.index');
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
        $provinces = Province::all();
        return view('backs.admins.managers.users.create',compact(['provinces']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->repository->create($request,null);
        return redirect()->route('admin_users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $provinces = Province::all();
        return view('backs.admins.managers.users.edit',compact(['provinces','user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,User $user)
    {
        $record = $this->repository->create($request,$user);
        return redirect()->route('admin_users.index');
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

    public function getDistrictByProvince(Request $request)
    {
        if ($request->ajax()){
            return District::where('key_province',$request->key_province)->get(['key','name']);
        }
    }
}
