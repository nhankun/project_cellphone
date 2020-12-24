<div class="card-body">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{!! isset($manufacturer) ? $manufacturer->name : old('name') !!}" placeholder="Enter name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-3">
            <div class="text-center">
                <label for="icon">
                    @if(isset($manufacturer) && $manufacturer->icon != '')
                        <img class="profile-user-img img-fluid img-circle" src="{{asset($manufacturer->icon)}}"
                             style="width: 80px;height: 80px;" alt="{{asset($manufacturer->name)}}">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{!! isset($manufacturer) ? $manufacturer->address : old('address') !!}" id="address" placeholder="Địa chỉ liên hệ">
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" value="{!! isset($manufacturer) ? $manufacturer->website : old('website') !!}" id="website" placeholder="Địa chỉ website">
                @error('website')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{!! isset($manufacturer) ? $manufacturer->phone : old('phone') !!}" id="phone" placeholder="Số điện thoại">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{!! isset($manufacturer) ? $manufacturer->email : old('email') !!}" id="email" placeholder="Địa chỉ email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>


    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="2" class="form-control description @error('description') is-invalid @enderror">{!! isset($manufacturer) ? $manufacturer->description : old('description') !!}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
    <div class="btn-group" style="width: 100%">
        <a href="{{ route("manufacturers.index") }}" class="btn btn-outline-secondary mr-1">Back list</a>
        <button type="submit" class="btn btn-primary ml-1">Save</button>
    </div>
</div>

@section('script')
    <script src="{!! asset('js/ckeditor/ckeditor.js') !!}"></script>
    <script !src="">

        CKEDITOR.replace( 'description', {
            // uiColor : '#007bff',
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            height: 200,
            width: '100%'

        });

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
