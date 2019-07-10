<html>
<head>
<title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
  <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
</head>
<body onload="window.print()">
<div class="col-xs-12">
  <div style="text-align:justify; margin-top: 20px">
    <img src="<?php echo base_url(); ?>assets/images/logo_sragen.jpg" style="width: 78px; height: 80px; float:left; margin:0 8px 4px 0;"/>
    <p style="text-align: center; line-height: 20px">
      <span style="font-size: 15px">POLITEKNIK NEGERI LAMPUNG</span><br/>
      <span style="font-size: 20px;"><strong>BANDAR LAMPUNG</strong></span><br/>
      <span style="font-size: 12px">Jln. LINTAS SUMATERA No. 534 Telp. (271) 891068 LAMPUNG 57272</span><br/>
      <span style="font-size: 12px">Website : </span>
    </p>
  </div>
  <div style="clear:both"></div><br/>
  <hr style="border: 2px groove #000000;margin-top: -2px; width:100%"/>
  <hr style="border: 1px groove #000000; margin-top: -19px; width:100%"/>
</div>
<div class="col-xs-12">
  <h3>PEMASUKAN KEUANGAN</h3>
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Dari</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
          $no = 1;
          foreach ($tampil_data->result_array() as $rows) {
            $tanggal1 = tgl_indo($rows['tgl']);
        ?>
        <tr>
            <th scope="row"><?php echo $no ?></th>
            <td><?php echo $rows['tujuan'] ?></td>
            <td><?php echo $tanggal1 ?></td>
            <td><?php echo $rows['jumlah'] ?></td>
        </tr>
        <?php $no++; } ?>
    </tbody>
  </table>

  <h3>PEMASUKAN KEUANGAN</h3>
  <table class="table table-bordered table-striped">
      <thead>
          <tr>
              <th>No</th>
              <th>Keperluan</th>
              <th>Tanggal</th>
              <th>Jumlah</th>
          </tr>
      </thead>
      <tbody>
         <?php
            $no = 1;
            foreach ($tampil_data1->result_array() as $rows1) {
              $tanggal = tgl_indo($rows1['tgl']);
          ?>
          <tr>
              <th scope="row"><?php echo $no ?></th>
              <td><?php echo $rows1['tujuan'] ?></td>
              <td><?php echo $tanggal ?></td>
              <td><?php echo $rows1['jumlah'] ?></td>
          </tr>
          <?php $no++; } ?>
      </tbody>
  </table>
</div>

  <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.js"></script>
</body>
</html>