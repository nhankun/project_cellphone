<style>
    .iti--allow-dropdown {
        width: 100%;
    }
     fieldset.scheduler-border {
         border: 1px groove #007bff !important;
         padding: 0 1em 1em 1em !important;
         margin: 0 0 1em 0 !important;
         -webkit-box-shadow:  0px 0px 0px 0px #000;
         box-shadow:  0px 0px 0px 0px #000;
         border-radius: 12px;
     }

    legend.scheduler-border {
        font-size: 1rem !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>
<div class="card-body">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{!! isset($category) ? $category->name : old('name') !!}" placeholder="Enter name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-1">
            <div class="form-group" style="margin-top: 1.8em;">
                <div class="custom-control custom-switch">
                    <input name="active" type="checkbox" class="custom-control-input" value="1" id="active"
                        {!! (isset($category) && $category->status == 1) ? 'checked' : '' !!}
                    >
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="text-center">
                <label for="icon">
                    @if(isset($category) && $category->icon != '')
                        <img class="profile-user-img img-fluid img-circle" src="{{asset($category->icon)}}"
                             style="width: 80px;height: 80px;" alt="{{asset($category->name)}}">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                             src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                             style="width: 80px;height: 80px;" alt="User profile picture">
                    @endif
                </label>
                <input type="file" name="icon" id="icon" style="display: none;" onChange="readerFileImages(this)">
            </div>
        </div>
    </div>


    <div class="row">
        <fieldset class="scheduler-border container-fluid">
            <legend class="scheduler-border">Properties</legend>
            <div class="col-md-12">
                <div class="form-group">
                    <p class="btn btn-outline-secondary" onclick="addNewProperty()" >
                        Add property &nbsp;<i class="fa fa-plus-circle"></i>
                    </p>
                </div>
            </div>
            <div class="col-12 properties">
                @if(isset($category) && !is_null($category->properties))
                    @foreach(json_decode($category->properties) as $key => $value)
                        <div class="row general" id="{!! $key !!}">
                            <div class="col-1 text-center">
                                <p><i class="fa fa-plus"></i></p>
                            </div>
                            <div class="col-5">
                                <input name="properties[{!! $key !!}][name]" type="text" value="{!! $value->name !!}" class="form-control" id="name_{!! $key !!}}">
                            </div>
                            <div class="col-5">
                                <input name="properties[{!! $key !!}][value]" type="text" value="{!! $value->value !!}" class="form-control" id="value_{!! $key !!}">
                            </div>
                            <div class="col-1">
                                <p class="btn btn-danger" onclick="deleteProperty(this,null)"><i class="fa fa-trash-alt"></i></p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row general" id="1">
                        <div class="col-1 text-center">
                            <p><i class="fa fa-plus"></i></p>
                        </div>
                        <div class="col-5">
                            <input name="properties[1][name]" type="text" class="form-control" id="name_1">
                        </div>
                        <div class="col-5">
                            <input name="properties[1][value]" type="text" class="form-control" id="value_1">
                        </div>
                        <div class="col-1">
                            <p class="btn btn-danger" onclick="deleteProperty(this,null)"><i class="fa fa-trash-alt"></i></p>
                        </div>
                    </div>
                @endif
                {{--                <input type="hidden" name="tmp_id" value="">--}}
            </div>
        </fieldset>

    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <div class="btn-group" style="width: 100%">
        <a href="{{ route("categories.index") }}" class="btn btn-outline-secondary mr-1">Back list</a>
        <button type="submit" class="btn btn-primary ml-1">Save</button>
    </div>
</div>

@section('script')
    <script !src="">
        $(window).bind('load',function () {
            sortDiv();
        });
        function addNewProperty() {
            let max = 0;
            let c = $('.general:last').attr('id');
            $('.properties').find('.general').each((ind,val) => {
                if(val.getAttribute('id') > max)
                    max = val.getAttribute('id');
                }
            );
            c = max;
            if (typeof c === 'undefined')
            {
                c = 0;
            }
            c++;
            let new_property = `<div class="row general" id="${c}">
                <div class="col-1 text-center">
                    <p><i class="fa fa-plus"></i></p>
                </div>
                <div class="col-5">
                    <input name="properties[${c}][name]" type="text" class="form-control" id="name_${c}">
                </div>
                <div class="col-5">
                    <input name="properties[${c}][value]" type="text" class="form-control" id="value_${c}">
                </div>
                <div class="col-1">
                    <p class="btn btn-danger" onclick="deleteProperty(this,null)"><i class="fa fa-trash-alt"></i></p>
                </div>
            </div>`;

            $(".properties").append(new_property);
        }

        function sortDiv()
        {
            $(".properties").sortable({
                cancel: ":input",
                items: ".general",
                start: function( event, ui ) {

                },
                stop: function( event, ui ) {

                }
            });
        }

        function deleteProperty(e, id) {
            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    if (id != null) {
                        $(e).parents('#'+id).remove();
                    } else {
                        $(e).parents('.general').remove();
                    }
                }
            });
        }

        function validationFormatImage(input)
        {
            let valid_extensions = ['jpg','png','jpeg']; //array of valid extensions
            if (input.files) {
                let file_length = input.files.length;
                for (let g = 0; g < file_length; g++)
                {
                    let file = input.files[g];
                    let name = input.files[g].name;
                    let file_name_ext = name.substr(name.lastIndexOf('.') + 1);
                    let file_size = input.files[g].size / 1024 / 1024; // in MB
                    if (file_size > 40) {
                        Swal.fire(error_image);
                        input.value = '';
                        return false;
                    }
                    if ($.inArray(file_name_ext, valid_extensions) == -1) {
                        input.value = '';
                        Swal.fire('image_file' + valid_extensions.join(', '));
                        return false;
                    }
                }
            }
            return true;
        }
        function readerFileImages(input){
            let validation = validationFormatImage(input);
            if(validation){
                let reader = new FileReader();
                let file = input.files[0];
                let makeup;
                reader.onload = function(event)
                {
                    makeup = "<img class='profile-user-img img-fluid img-circle' src='"+event.target.result+"' alt='User profile picture' style='width: 80px;height: 80px;'>";
                    $("label[for='icon']").html('');
                    $("label[for='icon']").append(makeup)
                };
                reader.readAsDataURL(file);
            }
        }

    </script>


@endsection
