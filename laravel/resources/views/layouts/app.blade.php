<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/dist/css/fallback.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dist/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">

    <style>
        .leftContainer {
            overflow: auto;
            height: 200px;
        }

        .rightContainer {
            overflow: auto;
            height: 200px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
         <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/images/PTTimg.png') }}" height="80" width="80">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/home" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <!-- <div class="input-group">

                            <input id="search-input" type="search" id="form1" class="form-control" placeholder="Search">

                          <a hrfe="" class="d-flex justify-centent-center align-items-center bg-secondary p-2"><i class="fas fa-search fa-sm"></i></a>



                    </div>
                    -->

                </li>
                @if(auth()->user()->role == 'admin')
                <x-notification/>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home')}}" class="brand-link">
                <img src="{{ asset('assets/images/PTTimg.png') }}" alt="ptt Logo"
                    class="brand-image img-circle elevation-3" style="width:auto;, height:100px;">
                <span class="brand-text font-weight-light" style="color:#F5E5C0;">ပစ်တိုင်းထောင်</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu starts-->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">


                        <!--sales-->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    Sales
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('sale.create') }}" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Add Sale</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('sale.list')}}" class="nav-link">
                                        <i class="fas fa-list-ol nav-icon"></i>
                                        <p>Sale List</p>
                                    </a>
                                </li>
                                <!-- Trash Sale -->
                        @if(auth()->user()->role == 'admin')
                              <li class="nav-item">
                                  <a href="{{ route('saletrash.list') }}" class="nav-link">
                                     <i class="fas fa-trash-alt nav-icon"></i>
                                     <p>Trash Sale</p>
                                  </a>
                              </li>
                        @endif
                        <!-- Trash Sale -->
                            </ul>
                        </li>
                        <!--Sales-->
                        @if(auth()->user()->role == 'admin')
                        <!--purchases -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Purchases
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('purchase.create') }}" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Add Purchase</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('purchase.list')}}" class="nav-link">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Purchase List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('purchase.trash')}}" class="nav-link">
                                        <i class="fas fa-trash nav-icon"></i>
                                        <p>Trash Purchase List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--purchases-->


                        <!--Item-->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>
                                    Items
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('item.create') }}" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Add Item </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('item.list')}}" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Item List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--item manangent-->
                        <!--Categories -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>Add Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('category.list')}}" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Categories List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--Categories-->
                        <!--Company-->
                        <li class="nav-item ">
                            <a href="{{ route('company.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Company
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                        <!--Company-->

                        <!--admin-->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.create') }}" class="nav-link">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('user.list')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>User List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--admin-->
                        <!--customer -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customers
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customer.create') }}" class="nav-link">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Add Customer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('customer.list')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Customer List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--customer-->

                        <!--Account-->
                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Account
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('account.create') }}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>Add Account</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('account.list') }}" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Account List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('accounttype.create') }}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>Add Account Type</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Account -->
                        <!--Inventory-->
                        <li class="nav-item ">
                            <a href="{{route('inventory.list')}}" class="nav-link">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    Inventory
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                            <!--
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>Add Salary</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Salary List</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('report')}}" class="nav-link">
                                {{-- <i class="nav-icon fas fa-cash-register"></i> --}}
                                <i class="nav-icon fa-solid fa-chart-line"></i>
                                <p>
                                    Report
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                            <!--
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>Add Salary</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="fas fa-list-alt nav-icon"></i>
                                        <p>Salary List</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        </li>
                        @endif
                        <!--Salary -->
                    </ul>
                </nav>
                <!-- Sidebar Menu ends-->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        {{-- <footer class="main-footer text-center">
            <strong>Developed by <a href="https://siriertech.com" target="_blank">Sirier Tech</a> | All rights reserved.
                &copy; 2022.</strong>
        </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.session.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ asset('assets/dist/js/demo.js') }}"></script> -->

    <!-- data Table -->
    <script src="{{ asset('assets/dist/js/jquery.dataTables.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
    <!-- bar <script src="{{ asset('assets/dist/js/adminlte.min.js?v=3.2.0') }}"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/jquery.printPage.js') }}"></script>
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.js') }}"></script>
    <script src="{{ asset('assets/jsPDF-2.5.1/dist/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('assets/cookiejquery/jquery.cookie.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="{{ asset('assets/printjquery/dist/jQuery.print.min.js') }}"></script>
     {{-- @yield('script') --}}

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-Token':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
    @yield('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();

} );
    </script>
</body>

</html>
