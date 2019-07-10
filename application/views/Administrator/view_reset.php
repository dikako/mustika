<!DOCTYPE html>
<!-- saved from url=(0042)https://egraduation.amikom.ac.id/dash/auth -->
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
  <script type="text/javascript">
    function nospaces(t){
        if(t.value.match(/\s/g)){
            alert('Maaf, Password Tidak Boleh Menggunakan Spasi,..');
            t.value=t.value.replace(/\s/g,'');
        }
    }
  </script>
</head>
<body>

<div class="container animated fadeIn">
  <div class="card card-container">
    <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>assets/images/favicon.png">
    <p id="profile-name" class="judul">Reset Password</p>
    <hr>
    <p class="text-center pb10">Silahkan isi form dibawah ini</p>
    <br><br>
    <?php 
        if ($this->input->post('id_session')!=''){
        echo "<div class='alert alert-warning'><center>$title</center></div>";
      }
    ?>
    <form action="<?php echo site_url('administrator/reset_password'); ?>" class="form-signin" role="form" method="post" accept-charset="utf-8">
      <div class="password">
        <input type="password" class="form-control" name='a' placeholder="Input Password Baru" onkeyup="nospaces(this)" required="" autofocus="">
      </div>
      <div class="password2">
        <input type="password" class="form-control" name='b' placeholder="Ulangi sekali lagi" onkeyup="nospaces(this)" required="" autofocus="">
         <input type="hidden" name='id_session' value='<?php echo $this->session->id_session; ?>'>
      </div>
      <button type="submit" name ="lupa" class="btn btn-primary btn-signin">Kirimkan Permintaan</button>
    </form>
    <a href="<?php echo site_url('administrator'); ?>"> Login Administrator?</a>
  </div>
</div>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
</html>