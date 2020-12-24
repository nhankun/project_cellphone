<?php

namespace App\Http\Controllers\Admins\Managers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backs\Admins\Managers\Users\UserRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\Users\User;
use App\Repositories\Admins\Managers\UserRepository;
use App\Services\Indexable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Indexable;

    private $table;
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->table = 'users';
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
                'table' => view('backs.admins.managers.users.table',['users'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.admins.managers.users.index',['users'=>$records,'links'=>$links]);
    }

    public function destroy(User $admin_user)
    {
        $this->repository->delete($admin_user);
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
        return redirect()->route('users.index');
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
        return redirect()->route('users.index');
    }

    public function getDistrictByProvince(Request $request)
    {
        if ($request->ajax()){
            return District::where('key_province',$request->key_province)->get(['key','name']);
        }
    }
}
