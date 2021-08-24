<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
  <!-- Custome style -->
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  @livewireStyles()
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      @livewire('cart-count-component')

      @auth
      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{Auth::user()->name}}</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <li><a href="#" class="dropdown-item"><i class="fas fa-user-alt"></i> Hồ sơ</a></li>
          <li><a href="{{route('logout')}}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
        </ul>
      </li>
      @else
        <a href="{{route('login')}}" class="d-block" style="margin-top: 7px;"><i class="fas fa-user-lock"></i>Đăng nhập</a>
      @endauth
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Honghafeed</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                 Dashboard
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Dashboard v1</p>
                 </a>
               </li>
             </ul>
           </li>
           <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
               <p>
                 Đặt hàng
                 <i class="right fas fa-angle-left"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{ route('user.add.order') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Tạo đơn hàng</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="{{ route('user.cart') }}" class="nav-link {{ Request::is('cart') ? 'active' : '' }}">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Giỏ hàng</p>
                 </a>
               </li>
             </ul>
           </li>
           <li class="nav-item">
            <a href="{{ route('user.policy') }}" class="nav-link {{ Request::is('policy*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Chính sách
              </p>
            </a>
          </li>

           <li class="nav-header">HỆ THỐNG</li>
           <li class="nav-item">
             <a href="{{ route('admin.policies') }}" class="nav-link {{ Request::is('admin/policies*') ? 'active' : '' }}">
               <i class="nav-icon fas fa-book"></i>
               <p>
                 Chính sách
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('admin.products') }}" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
               <i class="nav-icon fas fa-cubes"></i>
               <p>
                 Sản phẩm
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('admin.prices') }}" class="nav-link {{ Request::is('admin/prices*') ? 'active' : '' }}">
               <i class="nav-icon fas fa-hand-holding-usd"></i>
               <p>
                 Bảng giá
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('admin.departments') }}" class="nav-link {{ Request::is('admin/departments*') ? 'active' : '' }}">
               <i class="nav-icon fas fa-university"></i>
               <p>
                 Phòng ban
               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="{{ route('admin.users') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
               <i class="nav-icon fas fa-users"></i>
               <p>
                 Người dùng
               </p>
             </a>
           </li>
        </ul>
      </nav>
    </div>
  </aside>

  {{ $slot }}

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2021 <a href="https://honghafeed.com.vn">Nguyễn Văn Cường</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<!-- Page specific script -->

@livewireScripts()
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>

@stack('scripts')
</body>
</html>
