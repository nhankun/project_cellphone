<style>
    .iti--allow-dropdown {
        width: 100%;
    }
</style>
<div class="card-body">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{!! isset($provider) ? $provider->name : old('name') !!}" placeholder="Enter name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{!! isset($provider) ? $provider->email : old('email') !!}" placeholder="Enter email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <label for="avatar">
                    @if(isset($provider) && $provider->avatar != '')
                        <img class="profile-user-img img-fluid img-circle" src="{{asset($provider->avatar)}}"
                             style="width: 158px;height: 158px;" alt="{{asset($provider->name)}}">
                    @else
                        <img class="profile-user-img img-fluid img-circle"
                             src="{!! asset('backs/assets/dist/img/user4-128x128.jpg') !!}"
                             style="width: 158px;height: 158px;" alt="User profile picture">
                    @endif
                </label>
                <input type="file" name="avatar" id="avatar" style="display: none;" onChange="readerFileImages(this)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group row">
                <label for="phone" class="col-12">Số điện thoại</label>
                <div class="col-12">
                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"value="{!! isset($provider) ? $provider->phone : old('phone') !!}" placeholder="Số điện thoại">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="website">Website</label>
                <input name="website" type="text" class="form-control @error('website') is-invalid @enderror" id="website"value="{!! isset($provider) ? $provider->website : old('website') !!}" placeholder="Enter website">
                @error('website')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address"value="{!! isset($provider) ? $provider->address : old('address') !!}" placeholder="Enter address">
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-2">
            <div class="form-group text-center" style="margin-top: 1.8em;">
                <div class="custom-control custom-switch">
                    <input name="active" type="checkbox" class="custom-control-input" value="1" id="active"
                        {!! (isset($provider) && $provider->status == 1) ? 'checked' : '' !!}
                    >
                    <label class="custom-control-label" for="active">Active</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>Country</label>
                <select name="country" class="form-control select2bs4" style="width: 100%;">
                    <option value="VIET_NAM" selected="selected">Việt Nam</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>City</label>
                <select name="city" class="form-control select2bs4" id="city" style="width: 100%;" onchange="changeprovince();">
                    @foreach($provinces as $province)
                        <option value="{{ $province->key }}"
                                @if(old('city', isset($provider) ? $provider->city : '') == $province->key)
                                selected="selected"
                            @endif
                        >{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>District</label>
                <select name="district" class="form-control select2bs4" id="district" style="width: 100%;">

                </select>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
</div>

@section('script')
    <script !src="">
        $(window).bind('load',function () {
            changeprovince();
        });

        //setting phone pakage
        var input_phone_ct = document.querySelector("#phone");
        var iti = window.intlTelInput(input_phone_ct, {
            initialCountry: "vn",
        });

        $("#phone").on('change', function(){
            input_phone_ct.value =  iti.getNumber();
            $("#phone").parent().next().attr('style','color: red;display:none;');
        })
        //reload
        $(window).bind("load", function() {
            $("#phone").trigger('change');
        });

        function changeprovince(){
            var value= $("#city option:selected").val();
            var text= $("#city option:selected").text();
            $.ajax({
                method: "GET",
                url: "{{route('manager-user.district')}}",
                data: {"key_province":value},
                success: function (response) {
                    var newOptions = response;

                    var select = $('#district');
                    if(select.prop) {
                        var options = select.prop('options');
                    }
                    else {
                        var options = select.attr('options');
                    }
                    $('option', select).remove();
                    $.each(newOptions, function(val, text) {
                        options[options.length] = new Option(text.name, text.key);
                    });
                    select.prop('selectedIndex',0);
                    @if(isset($provider))
                    if("{{$provider->city}}" == value) {
                        select.val("{{$provider->district}}");
                    }
                    @endif

                },
                error: function (err) {
                    console.log(err);
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
                    makeup = "<img class='profile-user-img img-fluid img-circle' src='"+event.target.result+"' alt='User profile picture' style='width: 158px;height: 158px;'>";
                    $("label[for='avatar']").html('');
                    $("label[for='avatar']").append(makeup)
                };
                reader.readAsDataURL(file);
            }
        }

        function showPassword(e) {
            $('#password').attr('type','text');
            $(e).replaceWith('<p class="btn btn-outline-primary" onclick="hidePassword(this);"><i class="fas fa-eye-slash"></i></p>');
        }
        function hidePassword(e) {
            $('#password').attr('type','password');
            $(e).replaceWith('<p class="btn btn-outline-primary" onclick="showPassword(this);"><i class="fas fa-eye"></i></p>');
        }
    </script>


@endsection
