@foreach($manufacturers as $manufacturer)
    <tr>
        <td class="text-center">{!! $manufacturer->id !!}</td>
        <td>{!! $manufacturer->name !!}</td>
        <td class="text-center">
            <label for="avatar">
                @if($manufacturer->icon != '')
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset($manufacturer->icon) !!}" alt="{!! $manufacturer->name !!}"
                         style="width:60px; height:60px">
                @else
                    <img class="profile-user-img img-fluid img-circle"
                         src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                         style="width:60px; height:60px" alt="User profile picture">
                @endif
            </label>
        </td>
        <td class="text-center">
            <a href="{!! route('manufacturers.edit',$manufacturer) !!}" class="mb-2 mr-2 btn btn-info"><i class="fas fa-edit"></i>
            </a>
            <a href="{!! route('manufacturers.destroy',$manufacturer) !!}" class="mb-2 mr-2 btn btn-danger simpleConfirm"><i
                    class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endforeach


