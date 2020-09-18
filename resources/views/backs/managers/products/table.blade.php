@foreach($products as $product)
    <tr>
        <td class="text-center">{!! $product->id !!}</td>
        <td>{!! $product->name !!}</td>
        <td class="text-center">

            <label for="avatar">
                @if(isset($product) && $product->imageSmall != '')
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset($product->imageSmall->link) !!}" alt="{!! $product->name !!}"
                         width="80px" height="80px">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                         width="80px" height="80px" alt="User profile picture">
                @endif
            </label>
        </td>
        <td class="text-center">
            <span class="tag tag-danger">
{{--                {!! isset($product->expires_at) ? $user->getTimeLoggedIn($user->expires_at) : 'Not found'!!}--}}
            </span>
        </td>
        <td class="text-center">
                <span class="checkbox-active">
                    @if($product->status == 1)
                        <button class="mb-2 mr-2 btn btn-success" onclick="cancel(this,{{ $product->id }})">
                        <i class="fas fa-check-circle"></i>
                    </button>
                    @elseif($product->status == 0)
                        <button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,{{ $product->id }})">
                        <i class="fa fa-ban"></i>
                    </button>
                    @endif
                </span>
        </td>
        <td class="text-center">
            <a href="{!! route('products.edit',$product) !!}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="{!! route('manager_products.destroy',$product) !!}" class="mb-2 mr-2 btn btn-danger simpleConfirm"><i
                    class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach


