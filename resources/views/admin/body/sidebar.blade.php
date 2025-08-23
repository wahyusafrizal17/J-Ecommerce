@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Sonbill</b> Store</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ ($route == 'dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ ($prefix == '/brand') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="tag"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.brand') ? 'active' : '' }}">
                        <a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brand</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ ($prefix == '/category') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="layers"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.category') ? 'active' : '' }}">
                        <a href="{{ route('all.category') }}"><i class="ti-more"></i>Manage Category</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ ($prefix == '/products') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.add') ? 'active' : '' }}">
                        <a href="{{ route('product.add') }}"><i class="ti-more"></i>Add Products</a>
                    </li>
                    <li class="{{ ($route == 'product.manage') ? 'active' : '' }}">
                        <a href="{{ route('product.manage') }}"><i class="ti-more"></i>Manage Products</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ ($prefix == '/slider') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="sliders"></i> {{-- Ikon untuk Slider --}}
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.slider') ? 'active' : '' }}">
                        <a href="{{ route('manage.slider') }}"><i class="ti-more"></i>Manage Slider</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ ($prefix == '/kupon') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="percent"></i> {{-- Ikon untuk Kupon --}}
                    <span>Kupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.kupon') ? 'active' : '' }}">
                        <a href="{{ route('manage.kupon') }}"><i class="ti-more"></i>Manage Kupon</a>
                    </li>
                </ul>
            </li>

            <!-- <li class="treeview {{ ($prefix == '/shipping') ? 'active' : '' }}"> -->
<!--     <a href="#"> -->
<!--         <i data-feather="map-pin"></i> {{-- Ikon untuk Shipping Area --}} -->
<!--         <span>Shipping Area</span> -->
<!--         <span class="pull-right-container"> -->
<!--             <i class="fa fa-angle-right pull-right"></i> -->
<!--         </span> -->
<!--     </a> -->
<!--     <ul class="treeview-menu"> -->
<!--         <li class="{{ ($route == 'manage.area') ? 'active' : '' }}"> -->
<!--             <a href="{{ route('manage.area') }}"><i class="ti-more"></i>Manage Area</a> -->
<!--         </li> -->
<!--     </ul> -->
<!-- </li> -->


            <li class="treeview {{ ($prefix == '/orders') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="shopping-bag"></i> {{-- Ikon untuk Orders --}}
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.orders') ? 'active' : '' }}">
                        <a href="{{ route('manage.orders') }}"><i class="ti-more"></i>Manage Order</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ ($prefix == '/reports') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="bar-chart-2"></i> {{-- Ikon yang lebih relevan untuk Reports --}}
                    <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'admin.reports') ? 'active' : '' }}">
                        <a href="{{ route('admin.reports') }}"><i class="ti-more"></i>All Reports</a>
                    </li>
                </ul>
            </li>

             <li class="treeview {{ ($prefix == '/users') ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="users"></i> {{-- Ganti ikon ke 'users' agar relevan dengan menu Users --}}
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'admin.users') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}"><i class="ti-more"></i>All User</a>
                    </li>
                </ul>
            </li>



            
           <!-- <li class="header nav-small-cap">User Interface</li> -->

<!-- <li class="treeview"> -->
<!--     <a href="#"> -->
<!--         <i data-feather="grid"></i> -->
<!--         <span>Components</span> -->
<!--         <span class="pull-right-container"> -->
<!--             <i class="fa fa-angle-right pull-right"></i> -->
<!--         </span> -->
<!--     </a> -->
<!--     <ul class="treeview-menu"> -->
<!--         <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li> -->
<!--         <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li> -->
<!--         <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li> -->
<!--         <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li> -->
<!--         <li><a href="components_dropdown.html"><i class="ti-more"></i>Dropdown</a></li> -->
<!--         <li><a href="components_modals.html"><i class="ti-more"></i>Modal</a></li> -->
<!--         <li><a href="components_nestable.html"><i class="ti-more"></i>Nestable</a></li> -->
<!--         <li><a href="components_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li> -->
<!--     </ul> -->
<!-- </li> -->

<!-- <li class="treeview"> -->
<!--     <a href="#"> -->
<!--         <i data-feather="credit-card"></i> -->
<!--         <span>Cards</span> -->
<!--         <span class="pull-right-container"> -->
<!--             <i class="fa fa-angle-right pull-right"></i> -->
<!--         </span> -->
<!--     </a> -->
<!--     <ul class="treeview-menu"> -->
<!--         <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li> -->
<!--         <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li> -->
<!--         <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li> -->
<!--     </ul> -->
<!-- </li> -->
<!-- </ul> -->
<!-- </section> -->

<!-- <div class="sidebar-footer"> -->
<!--     <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a> -->
<!--     <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="Email"><i class="ti-email"></i></a> -->
<!--     <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="Logout"><i class="ti-lock"></i></a> -->
<!-- </div> -->

</aside>