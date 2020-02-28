<div class="card-body">
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="2" class="form-control description @error('description') is-invalid @enderror">{!! isset($product) ? $product->description : old('description') !!}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

{{--    <input type="hidden" name="productId" value="{!! $product->id !!}">--}}
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
</div>
@section('script')
    <script src="{!! asset('js/ckeditor/ckeditor.js') !!}"></script>
    <script !src="">
        $(window).bind('load',function () {
        });

        CKEDITOR.replace( 'description', {
            // uiColor : '#007bff',
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            height: 500

        });
    </script>

    @include('ckfinder::setup')

@endsection

{{-- https://vietlaravel.com/huong-dan-tich-hop-ckeditor-va-ckfinder-chuan-nhat-cho-laravel.html--}}
