@foreach($categories as $category)
    <tr>
        <td class="text-center">{!! $category->id !!}</td>
        <td>{!! $category->name !!}</td>
        <td class="text-center">
            <label for="avatar">
                @if($category->icon != '')
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset($category->icon) !!}" alt="{!! $category->name !!}"
                         style="width:60px; height:60px">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                         style="width:60px; height:60px" alt="User profile picture">
                @endif
            </label>
        </td>
        <td class="text-center">
            <span class="tag tag-danger">
                {!! isset($provider->expires_at) ? $user->getTimeLoggedIn($user->expires_at) : 'Not found'!!}
            </span>
        </td>
        <td class="text-center">
                <span class="checkbox-active">
                    @if($category->status == 1)
                        <button class="mb-2 mr-2 btn btn-success" onclick="cancel(this,{{ $category->id }})">
                        <i class="fas fa-check-circle"></i>
                    </button>
                    @elseif($category->status == 0)
                        <button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,{{ $category->id }})">
                        <i class="fa fa-ban"></i>
                    </button>
                    @endif
                </span>
        </td>
        <td class="text-center">
            <a href="{!! route('categories.edit',$category) !!}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="{!! route('categories.destroy',$category) !!}" class="mb-2 mr-2 btn btn-danger simpleConfirm"><i
                    class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach


