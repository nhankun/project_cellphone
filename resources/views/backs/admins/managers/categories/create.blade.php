@extends('backs.admins.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Loại sản phẩm
                        <small></small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                        <li class="breadcrumb-item"><a href="#">Loại sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm</li>
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
{{--                        <div class="card-header">--}}
{{--                            <h3 class="card-title">--}}
{{--                                <i class="fas fa-user-alt"></i>--}}
{{--                                Create category--}}
{{--                            </h3>--}}
{{--                        </div>--}}
                        <form role="form" action="{!! route('categories.store') !!}" method="post" enctype="multipart/form-data">
                            @csrf

                            @include('backs.admins.managers.categories.template')

                        </form>
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
