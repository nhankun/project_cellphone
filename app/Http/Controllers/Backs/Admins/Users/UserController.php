<?php

namespace App\Http\Controllers\Backs\Admins\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Repositories\Admins\Users\UserRepository;
use App\Services\Indexable;
use Carbon\Carbon;
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
                'table' => view('backs.admins.users.table',['users'=>$records])->render(),
                'pagination' => $links->toHtml(),
            ]);
        }
        return view('backs.admins.users.index',['users'=>$records,'links'=>$links]);
    }

    public function destroy(User $admin_user)
    {
        $this->repository->delete($admin_user);
    }

}
