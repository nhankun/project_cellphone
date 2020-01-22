@foreach($providers as $provider)
    <tr>
        <td class="text-center">{!! $provider->id !!}</td>
        <td>{!! $provider->name !!}</td>
        <td class="text-center">

            <label for="avatar">
                @if(isset($provider) && $provider->icon != '')
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset($provider->icon) !!}" alt="{!! $provider->name !!}"
                         width="80px" height="80px">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                         width="80px" height="80px" alt="User profile picture">
                @endif
            </label>
        </td>
        <td>{!! $provider->email !!}</td>
        <td class="text-center">
            <span class="tag tag-danger">
{{--                {!! isset($provider->expires_at) ? $user->getTimeLoggedIn($user->expires_at) : 'Not found'!!}--}}
            </span>
        </td>
        <td class="text-center">
                <span class="checkbox-active">
                    @if($provider->status == 1)
                        <button class="mb-2 mr-2 btn btn-success" onclick="cancel(this,{{ $provider->id }})">
                        <i class="fas fa-check-circle"></i>
                    </button>
                    @elseif($provider->status == 0)
                        <button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,{{ $provider->id }})">
                        <i class="fa fa-ban"></i>
                    </button>
                    @endif
                </span>
        </td>
        <td class="text-center">
            <a href="{!! route('providers.edit',$provider) !!}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="{!! route('manager_providers.destroy',$provider) !!}" class="mb-2 mr-2 btn btn-danger simpleConfirm"><i
                    class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach


