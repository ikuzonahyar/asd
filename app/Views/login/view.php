<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="asset/plugin/font-icon/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css" >
    <link rel="icon" href="<?php echo base_url('image/logo.png'); ?>" type="image/x-icon">
    
    <?php echo view('login/css') ?>

    <title>TOKOUNIONJACK - Login</title>

  </head>
  <body id="login">
  <div class="login">
    
      <?php
        if(session()->getFlashdata('message')){ ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('message') ?>
        </div>
      <?php } ?>

<center><img src="public/image/LOGO.png" height="30%"  width="50%" ?></center>
<div class="alert alert-red text-center" style="display:none;" id="alert"><i class="fa fa-info-circle fa-lg"></i><p id="value">sdasdasd</p></div>
<form class="login-container" method="post" id="form-login" action="<?= base_url('login/auth') ?>">
<div id="panel-login">
      <form>
        <div class="group-input">
          <label> Username </label><br>
          <p><input type="text" name="email" id="email" required placeholder="Masukkan email deh kalau berani.."></p>
        </div>
        <div class="group-input">
          <label> Password </label><br>
          <p><input type="password" name="passwords" id="passwords" required placeholder="Masukkan password bila kamu yakin.."></p>
        </div>
        <button class="btn btn-green btn-full"><i class="fa fa-arrow-alt-circle-right text-white"></i> Login
        </button>
      </form>
    </div>
<?php echo view('login/js') ?>
<p>&copy TOKOUNIONJACK</p>

</body>
</html>