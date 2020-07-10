<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('dashboard')}}">
                    <i class="mdi mdi-minus-network"></i>
                    <span>Món ăn chờ làm</span>
                </a>
            </li>
            @if(auth()->user()->role_id === 1)
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-database"></i>
                    <span>Loại món ăn</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('category.create')}}"><i class="ti-more"></i>Tạo mới</a></li>
                    <li><a href="{{route('category.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-food"></i>
                    <span>Món ăn</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('food.create')}}"><i class="ti-more"></i>Tạo mới</a></li>
                    <li><a href="{{route('food.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-table"></i>
                    <span>Bàn ăn</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('table.create')}}"><i class="ti-more"></i>Tạo mới</a></li>
                    <li><a href="{{route('table.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-account-location"></i>
                    <span>Tài khoản</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.create')}}"><i class="ti-more"></i>Tạo mới</a></li>
                    <li><a href="{{route('user.index')}}"><i class="ti-more"></i>Nhân viên</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-account"></i>
                    <span>Khách hàng</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
{{--                    <li><a href="{{route('customer.create')}}"><i class="ti-more"></i>Tạo mới</a></li>--}}
                    <li><a href="{{route('customer.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-tag"></i>
                    <span>Voucher</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('voucher.create')}}"><i class="ti-more"></i>Tạo mới</a></li>
                    <li><a href="{{route('voucher.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
{{--            <li class="treeview">--}}
{{--                <a href="#">--}}
{{--                    <i class="mdi mdi-alert"></i>--}}
{{--                    <span>Notification</span>--}}
{{--                    <span class="pull-right-container">--}}
{{--                          <i class="fa fa-angle-right pull-right"></i>--}}
{{--                        </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="{{route('notification.create')}}"><i class="ti-more"></i>Tạo mới</a></li>--}}
{{--                    <li><a href="{{route('notification.index')}}"><i class="ti-more"></i>Danh sách</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-clipboard-outline"></i>
                    <span>Đơn hàng</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    {{--<li><a href="{{route('bill.create')}}"><i class="ti-more"></i>Tạo mới</a></li>--}}
                    <li><a href="{{route('bill.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="mdi mdi-chart-areaspline"></i>
                    <span>Thống kê</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    {{--<li><a href="{{route('bill.create')}}"><i class="ti-more"></i>Tạo mới</a></li>--}}
                    <li><a href="{{route('report.index')}}"><i class="ti-more"></i>Danh sách</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
</aside>
