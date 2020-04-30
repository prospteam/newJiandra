<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>New Jiandra Enterprises</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  	<link rel="icon" type="image/png" href="<?php echo base_url('assets/login/images/icons/newjiandra.png'); ?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/style.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/responsive.dataTables.min.css'); ?>">

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"> -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" id="theme-styles">
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css');?>">
    <!-- <link rel="stylesheet" href="<?php //secho base_url('assets/dist/css/_select2.scss'); ?>"> -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/custom.css'); ?>">
</head>

<body class="hold-transition sidebar-mini">
  <div class="loader-cont" style="display:none;position: fixed; z-index: 999; width: 100%; height: 100%; background: rgba(23,23,23,0.701);">
            <div class="sk-cube-grid xr_ar" style="left: 0; top: 35%; width: 80px; height: 80px; position: absolute; right: 0;">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">

        </a>

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">


              <div class="image">

                <p class="account">
                  <!-- <img src="<?php// echo base_url('assets/dist/img/user.png'); ?>" class="img-circle elevation-2" alt="User Image"> -->
                   <span class="acc_name"> <?php echo $this->session->userdata('fullname'); ?> </span> &nbsp; <i class="fas fa-angle-down"></i>
                 </p>
              </div>

            <!-- <p> Proweaver Test &nbsp; <i class="fas fa-angle-down"></i></p> -->

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <a href="<?php echo base_url('logout') ?>" class="dropdown-item">
            <i class="fas fa-sign-out mr-2"></i> Logout

          </a>



        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/logo.png'); ?>"
           class="logo" alt="New Jiandra Logo">
      <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview <?php if(isset($dbpresent)) {echo "menu-open";} ?>">
            <a href="<?= base_url('dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Enrollment
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('users'); ?>" class="nav-link">
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('supplier'); ?>" class="nav-link">
                  <p>Suppliers</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="../layout/fixed-sidebar.html" class="nav-link">
                  <p>Accounts</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?php echo base_url('vehicle'); ?>" class="nav-link">
                  <p>Vehicles</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-file"></i> -->
              <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.66667 0.666748C0.75 0.666748 0.00833352 1.41675 0.00833352 2.33341L0 15.6667C0 16.5834 0.741666 17.3334 1.65833 17.3334H11.6667C12.5833 17.3334 13.3333 16.5834 13.3333 15.6667V5.66675L8.33333 0.666748H1.66667ZM7.5 6.50008V1.91675L12.0833 6.50008H7.5Z" fill="#545454"/>
              </svg>

              <p>
                Purchase Order
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('purchaseorders'); ?>" class="nav-link">
                  <p>View Purchase Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('purchaseorders/viewAddSupplier'); ?>" class="nav-link">
                  <p>Add Purchase Order</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                 <!-- <i class="nav-icon fas fa-list-ul"></i> -->
                 <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M0.166992 8.08331H3.33366V4.91665H0.166992V8.08331ZM0.166992 12.0416H3.33366V8.87498H0.166992V12.0416ZM0.166992 4.12498H3.33366V0.958313H0.166992V4.12498ZM4.12533 8.08331H13.6253V4.91665H4.12533V8.08331ZM4.12533 12.0416H13.6253V8.87498H4.12533V12.0416ZM4.12533 0.958313V4.12498H13.6253V0.958313H4.12533Z" fill="#545454"/>
                 </svg>
              <p>
                Inventory <span class="manage">Management</span>
                <span class="badge badge-info right">3</span>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('products'); ?>" class="nav-link">
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('warehouse_management') ?>" class="nav-link">
                  <p>Warehouse Management</p>
                </a>
              </li>
               <li class="nav-item has-treeview">
                  <a href="<?php echo base_url('stocksmanagement'); ?>" class="nav-link">
                   <p>
                     Stock <span class="manage">Management</span>
                     <span class="badge badge-info right">2</span>
                     <i class="fas fa-angle-left right"></i>
                   </p>
                </a>
                   <!-- <ul class="nav nav-treeview"> -->
                   <ul style="list-style-type:none;">
                       <li class="nav-item">
                        <a href="<?php echo base_url('stockreceive'); ?>" class="nav-link">
                           <p>Stock Receive</p>
                        </a>
                       </li>
                       <li class="nav-item">
                        <a href="<?php echo base_url('stocktransfer'); ?>" class="nav-link">
                           <p>Stock Transfer</p>
                        </a>
                       </li>
                       <li class="nav-item">
                       <a href="<?php echo base_url('stockout'); ?>" class="nav-link">
                          <p>Stock Out</p>
                       </a>
                      </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-file"></i> -->
              <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.66667 0.666748C0.75 0.666748 0.00833352 1.41675 0.00833352 2.33341L0 15.6667C0 16.5834 0.741666 17.3334 1.65833 17.3334H11.6667C12.5833 17.3334 13.3333 16.5834 13.3333 15.6667V5.66675L8.33333 0.666748H1.66667ZM7.5 6.50008V1.91675L12.0833 6.50008H7.5Z" fill="#545454"/>
              </svg>

              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../forms/general.html" class="nav-link">
                  <p>Top Selling Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/advanced.html" class="nav-link">
                  <p>Inventory Reports</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-file"></i> -->
              <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.66667 0.666748C0.75 0.666748 0.00833352 1.41675 0.00833352 2.33341L0 15.6667C0 16.5834 0.741666 17.3334 1.65833 17.3334H11.6667C12.5833 17.3334 13.3333 16.5834 13.3333 15.6667V5.66675L8.33333 0.666748H1.66667ZM7.5 6.50008V1.91675L12.0833 6.50008H7.5Z" fill="#545454"/>
              </svg>

              <p>
                CSV Imports
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('productsimport'); ?>" class="nav-link">
                  <p>Products Import</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('poimport') ?>" class="nav-link">
                  <p>Purchase Order Imports</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <script type="text/javascript">
             $(".sidebar nav ul.nav li a").filter(function () {
                return this.href == location.href.replace(/#.*/, "");
             }).addClass('active');

             // for sub navigation
             $(".sidebar nav ul.nav li a").filter(function () {
                return this.href == location.href.replace(/#.*/, "");
             }).parents('.nav .nav-treeview').show();

             $(".sidebar nav ul.nav li a").filter(function () {
                return this.href == location.href.replace(/#.*/, "");
             }).parents('.has-treeview').addClass('menu-open');
       })
          </script> -->


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
