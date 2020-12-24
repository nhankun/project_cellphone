@extends('backs.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Hãng sản xuất
                        {{--                        <small>list all</small>--}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                        <li class="breadcrumb-item active">Hãng sản xuất</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{!! route('manufacturers.create') !!}" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i>
                                    Thêm mới
                                </a>
                            </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 100%;">
                                    <input type="text" name="search" id="search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" id="btnsearch" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                            <span id="id" class="fa fa-fw fa-sort-asc pull-right">
                                                <i class="fa fa-sort"></i>
                                            </span>
                                        #
                                    </th>
                                    <th class="text-center">
                                             <span id="name" class="fa fa-fw fa-sort-asc pull-right">
                                                <i class="fa fa-sort"></i>
                                            </span>
                                        Name
                                    </th>
                                    <th class="text-center">icon</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="pannel">
                                @include('backs.managers.manufacturers.table')
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="row justify-content-center">
                            <div id="spinner"></div>
                        </div>
                        <div class="card-footer clearfix" id="pagination">
                            {!! isset($links) ? $links : ''!!}
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
    {{--    <script src="{!! asset('backs/admin/js/category.js') !!}"></script>--}}
    {{-- Chưa làm order by theo current pages  --}}
    <script !src="">
            {{--var url_approved = "{!! route('AdminCategory.approved') !!}";--}}
            {{--var url_cancel = "{!! route('AdminCategory.cancel') !!}";--}}

        var categories = (function () {

                var url = '{{ route('manufacturers.index') }}';
                var title = "Are you sure?";
                var text = "You won't be able to revert this!";
                var cancelButtonText = "Cancel";
                var confirmButtonText = "Yes, delete it!";
                var errorAjax = "server_issue";
                var errorDelete = "error_delete";

                var onReady = function () {
                    $('#pagination').on('click', 'ul.pagination a', function (event) {
                        back.pagination(event, $(this), errorAjax)
                    });
                    $('#pannel').on('change', function () {
                    }).on('click', '.simpleConfirm', function (event) {
                        back.destroy(event, $(this), url, title, text, confirmButtonText, cancelButtonText, errorDelete)
                    });
                    $('th span').click(function () {
                        back.ordering(url, $(this), errorAjax)
                    });
                    $('#btnsearch').click(function () {
                        back.filters(url, errorAjax)
                    });
                    $('#search').keypress(function (event) {
                        var keycode = (event.keyCode ? event.keyCode : event.which);
                        // console.log(keycode);
                        if (keycode == '13') {
                            event.preventDefault();
                            $('#btnsearch').focus().click();
                        }
                    });
                };

                return {
                    onReady: onReady
                }

            })();

        $(document).ready(categories.onReady)
    </script>
@endsection

