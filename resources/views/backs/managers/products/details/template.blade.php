<div class="card-body">
    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description"
               value="{!! isset($product) ? $product->name : old('description') !!}" placeholder="Enter description">
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <textarea name="des" id="" cols="30" rows="10" class="des"> </textarea>
    </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
</div>

@section('script')
    <script src="{!! asset('js/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('js/ckfinder/ckfinder.js') !!}"></script>
    <script !src="">
        $(window).bind('load',function () {
        });

        CKEDITOR.replace( 'des');
    </script>


@endsection
