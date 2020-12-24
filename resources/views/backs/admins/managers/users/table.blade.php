@foreach($users as $user)
    <tr>
        <td class="text-center">{!! $user->id !!}</td>
        <td>{!! $user->name !!}</td>
        <td class="text-center"><img src="{!! asset($user->avatar) !!}" alt="{!! $user->name !!}" width="80px" height="80px"></td>
        <td>{!! $user->email !!}</td>
        <td class="text-center">
            <span class="tag tag-danger">
                {!! isset($user->expires_at) ? $user->getTimeLoggedIn($user->expires_at) : 'Not found'!!}
            </span>
        </td>
        <td class="text-center">
                <span class="checkbox-active">
                    @if($user->status == 1)
                        <button class="mb-2 mr-2 btn btn-success" onclick="cancel(this,{{ $user->id }})">
                        <i class="fas fa-check-circle"></i>
                    </button>
                    @elseif($user->status == 0)
                        <button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,{{ $user->id }})">
                        <i class="fa fa-ban"></i>
                    </button>
                    @endif
                </span>
        </td>
        <td class="text-center">
            <a href="{!! route('users.edit',$user) !!}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="{!! route('users.destroy',$user) !!}" class="mb-2 mr-2 btn btn-danger simpleConfirm"><i
                    class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach


