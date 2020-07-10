<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from lotus-admin-templates.multipurposethemes.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 03:22:02 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('theme/main')}}/css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('theme/main')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('theme/main')}}/css/skin_color.css">
    @yield('css')
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    <header class="main-header">
        <div class="d-flex align-items-center logo-box pl-20">
            <a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block" data-toggle="push-menu" role="button">
                <i class="nav-link-icon mdi mdi-menu text-white"></i>
            </a>
            <!-- Logo -->
            <a href="{{route('dashboard')}}" class="logo">
                <!-- logo-->
                <div class="logo-lg">
                    <span class="light-logo"><img src="{{asset('theme/main/images/logo-light-text.png')}}" alt="logo"></span>
                </div>
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top pl-10">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group nav-item d-md-none">
                        <a href="#" class="waves-effect waves-light nav-link rounded" data-toggle="push-menu" role="button">
                            <i class="nav-link-icon mdi mdi-menu"></i>
                        </a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded" title="Full Screen">
                            <i class="nav-link-icon mdi mdi-crop-free"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <!-- full Screen -->

                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle p-5" data-toggle="dropdown" title="User">
                            @if(auth()->user()->avatar != null)
                                <img src="{{asset(auth()->user()->avatar)}}" class="rounded" alt="" />
                            @else
                                <img src="{{asset('theme/main/images/user.png')}}" class="rounded" alt="" />
                            @endif
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <!-- User image -->
                            <li class="user-header bg-img" style="background-image: url(http://lotus-admin-templates.multipurposethemes.com/images/user-info.jpg)" data-overlay="3">
                                <div class="flexbox align-self-center">
                                    @if(auth()->user()->avatar != null)
                                        <img src="{{asset(auth()->user()->avatar)}}" class="float-left rounded-circle" alt="User Image">
                                    @endif
                                    <h4 class="user-name align-self-center">
                                        <span>{{auth()->user()->name}}</span>
                                        <small>{{auth()->user()->email}}</small>
                                    </h4>
                                </div>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="dropdown-divider"></div>
                                <div class="p-10"><a href="{{ route('logout') }}" class="btn btn-sm btn-rounded btn-success" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Đăng xuất</a></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.include.left_sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->

            <section class="content">
                @include('layouts.include.flash_message')
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">

        </div>
        &copy; 2020 <a href="#">Multipurpose Themes</a>. All Rights Reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- Vendor JS -->
<script src="{{asset('theme/main/js/vendors.min.js')}}"></script>

<!-- Lotus Admin App -->
<script src="{{asset('theme/main/js/template.min.js')}}"></script>
@yield('js')

</body>

</html>
