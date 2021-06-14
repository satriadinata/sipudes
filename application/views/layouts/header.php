<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url('assets/logo.jpg') ?>" type="image/x-icon">

  <title>SIPUDES</title>

  <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>DataTables/datatables.min.css"/>
  <script type="text/javascript" src="<?php echo base_url('assets/') ?>DataTables/datatables.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <?php if ($this->session->flashdata('message')!=null):?>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
      <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="mr-auto">Sukses</strong>
          <small></small>
          <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="toast-body"><?php echo $this->session->flashdata('message'); ?></div>
      </div>
    </div>
  <?php endif ?>
  <?php if ($this->session->flashdata('errPE')!=null):?>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
      <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="mr-auto"><?php echo $this->session->flashdata('errPE'); ?></strong>
          <small></small>
          <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="toast-body"><?php echo $this->session->flashdata('message'); ?></div>
      </div>
    </div>
  <?php endif ?>
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

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
            <span class="badge badge-warning navbar-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="<?php echo site_url('auth/logout') ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i>Logout
            </a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4"  >
      <!-- Brand Logo -->
      <a style="text-align: center;" href="<?php echo site_url('home') ?>" class="brand-link">
        <!-- <img src="<?php echo base_url('assets/logo.jpg') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <h3 class="brand-text font-weight-light">SIPUDES</h3>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: flex-start;align-items: center;" >
          <div style= class="image">
            <img style="margin: auto;" src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <h5 style="color: white;" class="d-block"><?php echo $user['email']; ?></h5>
            <span style="color: white;" >
              <?php 
                if ($user['user_role']==9) {
                  echo "Superadmin";
                }elseif ($user['user_role']==5) {
                  echo "Akun Desa ".$user['nama_desa'];
                }elseif ($user['user_role']==4) {
                  echo "Akun Operator ".$user['nama_desa'];
                }elseif ($user['user_role']==3) {
                  echo "Akun Kepala Desa".$user['nama_desa'];
                }elseif ($user['user_role']==2) {
                  echo "Akun RW ".$user['nama_desa'];
                }elseif ($user['user_role']==1) {
                  echo "Akun RT ".$user['nama_desa'];
                }
               ?>
            </span style="color: white;">
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2"  style="padding-bottom: 100px;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

           <?php if ($user['user_role']==5):?>

            <li class="nav-header">PENDUDUK</li>


            <li class="nav-item">
              <a href="<?php echo site_url('home') ?>" class="nav-link <?php echo $title=='Dashboard' ? 'active':'' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('warga') ?>" class="nav-link <?php echo $title=='Warga' ? 'active':'' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Penduduk
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('KartuK') ?>" class="nav-link <?php echo $title=='Kartu Keluarga' ? 'active':'' ?>">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                  Kartu Keluarga
                </p>
              </a>
            </li>

            

          <!--   <li class="nav-item">
              <a href="<?php echo site_url('nikah') ?>" class="nav-link <?php echo $title=='Surat Nikah' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Surat Nikah
                </p>
              </a>
            </li> -->
            <li class="nav-header">SURAT-SURAT</li>

            <li class="nav-item">
              <a href="<?php echo site_url('sk_domisili') ?>" class="nav-link <?php echo $title=='Surat Keterangan Domisili' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SK Domisili
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sk_usaha') ?>" class="nav-link <?php echo $title=='Surat Keterangan Usaha' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SK Usaha
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sktm_sekolah') ?>" class="nav-link <?php echo $title=='SKTM Sekolah' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SKTM Sekolah
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sk_merantau') ?>" class="nav-link <?php echo $title=='SK Perjalanan Merantau' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SK Perjalanan Merantau
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sp_pindah') ?>" class="nav-link <?php echo $title=='Surat Pengantar Pindah' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Pengantar Pindah
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sktm_berobat') ?>" class="nav-link <?php echo $title=='SKTM Berobat' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SKTM Berobat
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('kematian') ?>" class="nav-link <?php echo $title=='Data Kematian' ? 'active':'' ?>">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Surat Kematian
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('sk_kelahiran') ?>" class="nav-link <?php echo $title=='Surat Keterangan Kelahiran' ? 'active':'' ?> ">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  SK Kelahiran
                </p>
              </a>
            </li>

            <li class="nav-header">AKUN</li>


            <li class="nav-item">
              <a href="<?php echo site_url('akun_kepdes') ?>" class="nav-link <?php echo $title=='Akun KEPDES' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Akun KEPDES
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('akun_operator') ?>" class="nav-link <?php echo $title=='Akun Operator' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Akun Operator
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('akun') ?>" class="nav-link <?php echo $title=='Akun RT/RW' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Akun RT/RW
                </p>
              </a>
            </li>

            <li class="nav-header">SETTING</li>

            <li class="nav-item">
              <a href="<?php echo site_url('profil') ?>" class="nav-link <?php echo $title=='Profil Desa' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Profil Desa
                </p>
              </a>
            </li>
            <?php elseif ($user['user_role']==4):?>

            <li class="nav-header">PENDUDUK</li>
              <li class="nav-item">
              <a href="<?php echo site_url('home') ?>" class="nav-link <?php echo $title=='Dashboard' ? 'active':'' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('warga') ?>" class="nav-link <?php echo $title=='Warga' ? 'active':'' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Penduduk
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo site_url('KartuK') ?>" class="nav-link <?php echo $title=='Kartu Keluarga' ? 'active':'' ?>">
                <i class="nav-icon fas fa-address-card"></i>
                <p>
                  Kartu Keluarga
                </p>
              </a>
            </li>

            <li class="nav-header">SETTING</li>

            <li class="nav-item">
              <a href="<?php echo site_url('profil') ?>" class="nav-link <?php echo $title=='Profil Desa' ? 'active':'' ?> ">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Profil Desa
                </p>
              </a>
            </li>

            <?php elseif ($user['user_role']==2 || $user['user_role']==1):?>

            <li class="nav-header">PENDUDUK</li>

              <li class="nav-item">
                <a href="<?php echo site_url('home') ?>" class="nav-link <?php echo $title=='Dashboard' ? 'active':'' ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('rtrw') ?>" class="nav-link <?php echo $title=='Warga' ? 'active':'' ?>">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Warga
                  </p>
                </a>
              </li>

              <?php elseif ($user['user_role']==9):?>

                <li class="nav-item">
                  <a href="<?php echo site_url('home') ?>" class="nav-link <?php echo $title=='Dashboard' ? 'active':'' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo site_url('desa') ?>" class="nav-link <?php echo $title=='Akun Desa' ? 'active':'' ?>">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                      Akun Desa
                    </p>
                  </a>
                </li>
              <?php endif ?>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
              <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol> -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <!-- /.content-header -->