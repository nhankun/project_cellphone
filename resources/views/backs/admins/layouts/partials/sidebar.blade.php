<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{!! asset('backs/assets/dist/img/user2-160x160.jpg') !!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @guest<a href="{!! route('login') !!}" class="d-block"> Login </a>@else<a href="#" class="d-block"> {!! auth::user()->name !!} </a>@endguest
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            {{--menu-open--}}
            @can('admin')
                <li class="nav-header" style="padding-left: 1em">MANAGE</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Người dùng
                            {{--                        <span class="badge badge-info right">2</span>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('categories.index') !!}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Loại sản phẩm
                        </p>
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
