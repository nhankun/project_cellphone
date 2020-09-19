<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{!! asset('backs/assets/dist/img/user1-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{!! asset('backs/assets/dist/img/user8-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{!! asset('backs/assets/dist/img/user3-128x128.jpg') !!}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <!-- Language Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="flag-icon flag-icon-us"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="#" class="dropdown-item active">
                    <i class="flag-icon flag-icon-us mr-2"></i> English
                </a>
                <a href="#" class="dropdown-item">
                    <i class="flag-icon flag-icon-de mr-2"></i> German
                </a>
                <a href="#" class="dropdown-item">
                    <i class="flag-icon flag-icon-fr mr-2"></i> French
                </a>
                <a href="#" class="dropdown-item">
                    <i class="flag-icon flag-icon-es mr-2"></i> Spanish
                </a>
            </div>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
{{--                <i class="fas fa-th-large"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
        <style>
            #page-header-user-dropdown:hover{
                border-radius: 50px;
                background: #4b545c;
                color: #fff !important;
            }
        </style>
        @guest
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{!! route('login') !!}" class="nav-link"><i class="fas fa-sign-in-alt"></i> <span> Login</span></a>
            </li>
        @else
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img id="common-avatar" src="https://res.cloudinary.com/howkteam/image/upload/c_fill,g_face,h_120,w_120/v1581341810/avatar_user/onwflwyvuxpzmpgyxai2.jpg" class="avatar-xs align-middle mr-2">
                <span id="common-fullname" class="mr-1">{!! auth::user()->name !!} </span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right min-width-150">
                <a class="dropdown-item" href="/users/cd33743f-8c10-40e0-aba9-c75916e523d5">
                    <i class="far fa-user mr-2"></i> Hồ sơ
                </a>

                <a class="dropdown-item" href="/users/edit/cd33743f-8c10-40e0-aba9-c75916e523d5">
                    <i class="fas fa-wrench mr-2"></i> Cài đặt
                </a>
                <!-- END Side Overlay -->

                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" id="logoutForm" method="post">
                    @csrf
                    <a class="dropdown-item" href="javascript:document.getElementById('logoutForm').submit()">
                        <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                    </a>
                </form>
            </div>
        </div>
    @endguest
    </ul>
</nav>
