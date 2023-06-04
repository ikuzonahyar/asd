<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('image/title.png'); ?>" type="image/x-icon">
    <title>
        <?php
            echo $title
        ?>
    </title>

    <?php
        echo $css
    ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url('template/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

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
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <center><a href="#" class="brand-link"><span class="brand-text font-weight-light"><b>Enkripsi & Dekripsi </b></span></a></center>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('/') ?>" class="nav-link">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Transaction')?>" class="nav-link">
              <i class="fa fa-recycle" aria-hidden="true"></i>
              <p>
                Transaction
              </p>
            </a>
          </li>
          <?php if(session()->get('role') == 1) {?>
          <li class="nav-item">
            <a href="<?php echo base_url('User')?>" class="nav-link">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="<?php echo base_url('Login/logout')?>" class="nav-link">
              <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php
    echo $content
  ?>
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">TOKOUNIONJACK</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
    echo $js
?>

</body>
</html>
