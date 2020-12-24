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
            <li class="nav-header" style="padding-left: 1em">MANAGE</li>
            <li class="nav-item">
                <a href="{!! route('manager_providers.index') !!}" class="nav-link">
                    <i class="nav-icon fas fa-people-carry"></i>
                    <p>
                        Providers
{{--                        <span class="badge badge-info right">2</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('manufacturers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Hãng sản xuất
                        {{--                        <span class="badge badge-info right">2</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{!! route('manager_products.index') !!}" class="nav-link">
                    <i class="nav-icon fas fa-mobile-alt"></i>
                    <p>
                        Sản phẩm
                    </p>
                </a>
            </li>
            <li class="nav-header">MISCELLANEOUS</li>
            <li class="nav-item">
                <a href="https://adminlte.io/docs/3.0" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                </a>
            </li>
            <li class="nav-header">MULTI LEVEL EXAMPLE</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
