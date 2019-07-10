<!DOCTYPE html>
<html class="bg-black">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo $title; ?></title>
  <meta name="author" content="BPC Amikom Yogyakarta">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/kc.png" type="image/png">
  <link href="<?php echo base_url(); ?>assets/login/plugin/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/login/plugin/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/login/app/css/app-login-v1.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/login/plugin/sweetalert/css/sweetalert.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url(); ?>assets/login/plugin/sweetalert/js/sweetalert.min.js"></script>
</head>
<body>

<div class="container animated fadeIn">
  <div class="card card-container">
    <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>assets/images/favicon.png">
    <p id="profile-name" class="judul">Reset Password <br>Administrator</p>
    <hr>
    <p class="text-center pb10">Masukan Email anda, Kami akan mengirimkan Konfirmasi Reset Password melalui email tersebut.</p>
    <br><br>
    <form action="<?php echo site_url('administrator/lupapassword'); ?>" class="form-signin" role="form" method="post" accept-charset="utf-8">
      <div class="email">
        <input type="email" name="email" class="form-control" placeholder="Masukan Email yang Terdaftar" required="" autofocus="">
      </div><br>
      <button type="submit" name ="lupa" class="btn btn-primary btn-signin">Kirimkan Permintaan</button>
    </form>
    <a href="<?php echo site_url('administrator'); ?>"> Login Administrator?</a>
  </div>
</div>

</body>
</html>