<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/public/pbo-eiti.ico">

    <!-- Bootstrap Css -->
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->

    <link href="/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/public/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    @yield('styles')
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box" style="background: #ffffff;">


                        <a href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="/public/logo.png" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="/public/logo.png" alt="" >
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="ri-menu-2-line align-middle"></i>
                    </button>


                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="/public/uploads/users/{{Auth::user()->avatar ? Auth::user()->avatar : 'default-avatar.jpg'}}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1">{{Auth::user()->name}}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="/admin/profile"><i class="ri-user-line align-middle mr-1"></i> Мой профиль</a>
                            <!-- <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle mr-1"></i> My Wallet</a> -->
                            <a class="dropdown-item d-block" href="/admin/setting"><span class="badge badge-success float-right mt-1"></span><i class="ri-settings-2-line align-middle mr-1"></i> Конфигурации </a>
                            <!-- <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle mr-1"></i> Lock screen</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="/logout"><i class=" ri-logout-box-line align-middle mr-1 text-danger"></i> Выход</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Меню</li>
                    <li>
                        <a href="/admin" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Панель управления</span>
                        </a>
                    </li>

                  @if(Auth::user()->role_id==1)

                    <li id="menu_category">
                        <a href="/admin/category" class="has-arrow waves-effect">
                            <i class="ri-share-line"></i>
                            <span>Категория</span>
                        </a>
                        <ul id="menu_pod_category" class="sub-menu" aria-expanded="true">
                            @foreach($categories as $cat)
                            <li id="{{$cat->slug}}" ><a href="/admin/category/{{$cat->slug}}/organizations" class="">{{$cat->title_ru}}</a>

                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    <li id="organization">
                        <a href="/admin/organizations" class="waves-effect">
                            <i class="mdi mdi-boom-gate-alert"></i>
                            <span>Ораганизация</span>
                        </a>
                    </li>
            @if(Auth::user()->role_id==1)
                    <li id="page">
                        <a href="/admin/pages" class="has-arrow waves-effect">
                            <i class="ri-pages-line"></i>
                            <span id="pages_click">Страницы</span>
                        </a>
                        <ul id="menu_pod_page" class="sub-menu mm-collapse" aria-expanded="false">
                            @foreach($pages as $item)
                            <li id="{{$item->slug}}"><a href="/admin/page/{{$item->slug}}">{{$item->title}}</a></li>
                            @endforeach

                        </ul>
                    </li>

                    <li id="menu_ministry">
                        <a href="/admin/ministry" class="waves-effect">
                            <i class="fas fa-university"></i>
                            <span>Министерство</span>
                        </a>
                    </li>
                    <li id="menu_links">
                        <a href="/admin/usefull_links" class="waves-effect">
                            <i class="fas fa-link"></i>
                            <span>Полезные ссылки</span>
                        </a>
                    </li>



                    <li id="menu_photogallery">

                        <a href="/admin/photogalleries" class="waves-effect">
                            <i class="fas fa-video "></i>
                            <span>Фотогалерея</span>
                        </a>
                    </li>
                    <li id="menu_videogallery">

                        <a href="/admin/videogalleries" class="waves-effect">
                            <i class="fas fa-video "></i>
                            <span>Видеогалерея</span>
                        </a>
                    </li>

                    <li id="menu_log">

                        <a href="/admin/log" class="waves-effect">
                            <i class="ri-inbox-archive-line"></i>
                            <span>История событий</span>
                        </a>
                    </li>
                    <li iid="menu_setting">
                        <a href="/admin/setting" class="waves-effect">
                            <i class="ri-settings-2-line"></i>
                            <span>Конфигурация</span>
                        </a>
                    </li>
                    <li id="menu_user">
                        <a href="/admin/user" class="waves-effect">
                            <i class="fas fa-users"></i>
                            <span>Пользователь</span>
                        </a>
                    </li>
                    @endif

                   <li id="menu_profile">
                        <a href="/admin/profile" class="waves-effect">
                            <i class="ri-user-line"></i>
                            <span>Мой профиль</span>
                        </a>
                    </li>
                       <li>
                        <a href="/logout" class="waves-effect">
                            <i class=" ri-logout-box-line"></i>
                            <span>Выход</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('content')
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © PBO-EITI.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Разработано в  <i class="mdi mdi-heart text-danger"></i> Gravity studio
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/public/assets/libs/jquery/jquery.min.js"></script>
    <script src="/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/public/assets/libs/node-waves/waves.min.js"></script>
    <script src="/public/assets/js/app.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            href = window.location.pathname;
            route = href.split('/');
            if (route.length == 3 && route[2] == "category") {
                $('#menu_pod_category').addClass('mm-show');
            }
            if (route[2] == "pages") {
                $('#menu_pod_page').addClass('mm-show');
            }
        });
    </script>

</body>

</html>
