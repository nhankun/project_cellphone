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
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{!! isset($product) ? $product->name : old('name') !!}" placeholder="Enter name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <label for="avatar">
                    @if(isset($product) && $product->imageSmall)
                        <img class="profile-user-img img-fluid img-circle" src="{{asset($product->imageSmall->link)}}"
                             style="width: 80px;height: 80px;" alt="{{asset($product->name)}}">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                             src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                             style="width: 80px;height: 80px;" alt="User profile picture">
                    @endif
                </label>
                <input type="file" name="avatar" id="avatar" style="display: none;" onChange="readerFileImages(this)">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control select2bs4" id="category" style="width: 100%;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if(old('category', isset($product) ? $product->category_id : '') == $category->id)
                                selected="selected"
                            @endif
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Provider</label>
                <select name="provider" class="form-control select2bs4" id="provider" style="width: 100%;">
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id }}"
                                @if(old('provider', isset($product) ? $product->provider_id : '') == $provider->id)
                                selected="selected"
                            @endif
                        >{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name">Quantity</label>
                <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{!! isset($product) ? $product->quantity : old('quantity') !!}" placeholder="Enter quantity">
                @error('quantity')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="name">Price</label>
                <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price" value="{!! isset($product) ? $product->price : old('price') !!}" placeholder="Enter price">
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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
                @if(isset($product->properties))
                    @foreach($product->properties as $property)
                        <div class="row general" id="{!! $property->id !!}">
                            <div class="col-1 text-center">
                                <p><i class="fa fa-plus"></i></p>
                            </div>
                            <div class="col-5">
                                <input name="properties[{!! $property->id !!}][name]" type="text" value="{!! $property->name !!}" class="form-control" id="name_{!! $property->id !!}}">
                            </div>
                            <div class="col-5">
                                <input name="properties[{!! $property->id !!}][value]" type="text" value="{!! $property->value !!}" class="form-control" id="value_{!! $property->id !!}">
                            </div>
                            <div class="col-1">
                                <p class="btn btn-danger" onclick="deleteProperty(this,{{$property->id}})"><i class="fa fa-trash-alt"></i></p>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{--                <input type="hidden" name="tmp_id" value="">--}}
            </div>
        </fieldset>

    </div>


</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
</div>

@section('script')
    <script !src="">
        $(window).bind('load',function () {
            sortDiv();
            getPropertyByCategorySelected();
            //reload
            @if(!isset($product))
                $("#category").trigger('change');
            @endif
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
                    <input name="properties[new_${c}][name]" type="text" class="form-control" id="name_${c}">
                </div>
                <div class="col-5">
                    <input name="properties[new_${c}][value]" type="text" class="form-control" id="value_${c}">
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
                        $.ajax({
                            url: "{!! route('products.deleteProperty') !!}",
                            method: "DELETE",
                            data: {'id': id},
                            success: function (rs) {
                                if (rs.result == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                } else {
                                    console.log(rs.result);
                                }
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
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
                    $("label[for='avatar']").html('');
                    $("label[for='avatar']").append(makeup)
                };
                reader.readAsDataURL(file);
            }
        }

        function getPropertyByCategorySelected() {
            let input = $('#category');
            $(input).on('change',(e)=>{
                let category_id = input.val();
                e.preventDefault();
                $.ajax({
                    method: "GET",
                    url: "{{route('products.getPropertyByCategory')}}",
                    data: {"category_id":category_id},
                    success: function (response) {
                        let datas = JSON.parse(response.result);
                        // console.log(datas)
                        $(".properties").children().remove();
                        Object.keys(datas).forEach(key=>{
                            // console.log(datas[key],key);
                            renderPropertyByCategory(datas[key],key);
                        });
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
        }

        function renderPropertyByCategory(data,key) {
            let make_up = `
            <div class="row general" id="${key}">
                <div class="col-1 text-center">
                    <p><i class="fa fa-plus"></i></p>
                </div>
                <div class="col-5">
                    <input name="properties[new_${key}][name]" type="text" class="form-control" value="${data.name}" id="name_${key}">
                </div>
                <div class="col-5">
                    <input name="properties[new_${key}][value]" type="text" class="form-control" value="${data.value}" id="value_${key}">
                </div>
                <div class="col-1">
                    <p class="btn btn-danger" onclick="deleteProperty(this,null)"><i class="fa fa-trash-alt"></i></p>
                </div>
            </div>
            `;
            $(".properties").append(make_up);
        }

    </script>


@endsection
