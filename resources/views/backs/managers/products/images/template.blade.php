<link rel="stylesheet" href="{{ asset('backs/css/images.css') }}">

<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Thêm hình ảnh</h4>
                Thêm hình ảnh cho sản phẩm !
            </div>
        </div>
        <div class="col-sm-12">
            <div class="container--border-dashed" onclick="selectFile()">
                <div class="gallery row" id="general">
                    <?php $i=0;?>
                    @if(isset($images) && $images->link != '')
                        @foreach(explode(',',$images->link) as $image)
                            <div class='col-sm-3' id='{{$i}}'>
                                <img src="{{asset($image)}}" style='height:150px;width:100%;border:1px solid grey' onclick="showModal(event, '{{$image}}')">
                                <a href="javascript:;" data-url="{{route('images.destroy',[$images->id])}}" onclick="deleteImage(event, '{{$i}}', '{{$image}}')" class="deleteImage"><p style="text-align: center;padding-top: 5px"><i class="fa fa-trash" style='font-size:1.5em'></i>@lang('public.remove')</p></a>
                            </div>
                            <?php $i++; ?>
                        @endforeach
                    @endif
                </div>
                <div class="center-parent ">
                    <i class="far fa-fw fa-plus-square fa-2x center-me"></i></i>
                </div>
            </div>
{{--            {!! Form::file('images[]', ['style'=>'display:none', 'id' => 'imgInp', 'accept' => 'image/x-png, image/jpeg,image/jpg','multiple','onChange' => "imagesPreview(this,'general')"]) !!}--}}
            <input type="file" name="images[]" style="display: none" id="imgInp" onchange="imagesPreview(this,'general')" accept="image/x-png, image/jpeg,image/jpg" multiple>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
</div>

<div id="modal_image" class="modal">
    <div class="modal-content">
        <div class="row" style="height: 100%">
            <div class="col-sm-12" style="text-align: center; height:100%">
{{--            {!!Form::button('<em style="font-size: 1.5em;color:gray" class="fa fa-times"></em>',['id'=>'btnclose','style'=>'float:right;/* background-color:rgba(0,0,0,0.005)*/;border:none','onclick'=>"hideModal()"])!!}--}}
{{--            <!-- {!!Form::button('Ä�Ã³ng',['onclick'=>'hideModal()','style'=>'float:right'])!!} -->--}}
                <button id="btnclose" style="float: right;border: none" onclick="hideModal();"><em style="font-size: 1.5em;color:gray" class="fa fa-times"></em></button>
                <div class="flex-center" style="height: 100%">
                    <img src="{{asset('backs/images/noimages.png')}}" id="imgModal" width="40%" height="40%"/>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')

    <script type="text/javascript" src="{{asset('backs/js/images.js')}}"></script>
    <script type="text/javascript">
        $(window).ready(function(){
            changeDisplayIcon()
        })
    </script>

@endsection

