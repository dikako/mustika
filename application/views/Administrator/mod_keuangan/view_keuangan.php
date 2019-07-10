<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="header">
              <h2>
                  DATA KEUANGAN
              </h2>
              <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                      <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_keuangan'>Tambahkan Data</a>
                  </li>
              </ul>
          </div>
          <div class="body">
                      <ul class="nav nav-tabs tab-nav-right" role="tablist">
                          <li role="presentation" class="active"><a href="#masuk" data-toggle="tab">PEMASUKAN</a></li>
                          <li role="presentation"><a href="#keluar" data-toggle="tab">PENGELUARAN</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                          <div role="tabpanel" class="tab-pane animated flipInX active" id="masuk">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Tanggal</th>
                                      <th>Dari</th>
                                      <th>Jumlah</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                <?php
                                  $mlebu = $this->db->query("SELECT status , SUM(jumlah) AS masuk FROM keuangan WHERE status = 'Masuk'")->result_array();
                                  foreach ($mlebu as $anu) {
                                    $a = $anu['masuk'];
                                    $b = number_format($a,2,",",".");
                                    echo "<tr>
                                      <th colspan='3'>Jumlah</th>
                                      <th colspan='2'>Rp. $b</th>   
                                    </tr>";
                                  }
                                ?>
                              </tfoot>
                              <tbody>
                                <?php 
                                  $no = 1;
                                  foreach ($masuk as $row){
                                    $tanggal = tgl_indo($row['tgl']);
                                    $angka = $row['jumlah'];
                                    $uang = number_format($angka,2,",",".");
                                  echo "<tr><td>$no</td>
                                            <td>$tanggal</td>
                                            <td>$row[tujuan]</td>
                                            <td>Rp. $uang</td>
                                            <td><center>
                                              <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_keuangan/$row[id_keuangan]'><span class='glyphicon glyphicon-edit'></span></a>
                                              <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_keuangan/$row[id_keuangan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                            </center></td>
                                        </tr>";
                                    $no++;
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                          <div role="tabpanel" class="tab-pane animated flipInX" id="keluar">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Tanggal</th>
                                      <th>Keperluan</th>
                                      <th>Jumlah</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                <?php
                                  $metu = $this->db->query("SELECT status , SUM(jumlah) AS keluar FROM keuangan WHERE status = 'keluar'")->result_array();
                                  foreach ($metu as $anu1) {
                                    $a1 = $anu1['keluar'];
                                    $b1 = number_format($a1,2,",",".");
                                    echo "<tr>
                                      <th colspan='3'>Jumlah</th>
                                      <th colspan='2'>Rp. $b1</th>   
                                    </tr>";
                                  }
                                ?>
                              </tfoot>
                              <tbody>
                                <?php 
                                  $no = 1;
                                  foreach ($keluar as $row1){
                                    $tanggal = tgl_indo($row1['tgl']);
                                    $angka = $row1['jumlah'];
                                    $uang = number_format($angka,2,",",".");

                                  echo "<tr><td>$no</td>
                                            <td>$tanggal</td>
                                            <td>$row1[tujuan]</td>
                                            <td>Rp. $uang</td>
                                            <td><center>
                                              <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_keuangan/$row1[id_keuangan]'><span class='glyphicon glyphicon-edit'></span></a>
                                              <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_keuangan/$row1[id_keuangan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                            </center></td>
                                        </tr>";
                                    $no++;
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                      </div>
                      <center><h1 class="card-inside-title">
                          SISA SALDO SAAT INI
                          <small>Pemasukan - Pengeluaran</small>
                      </h1></center>
                      <div class="demo-single-button-dropdowns">
                         <?php
                            $query = $this->db->query("SELECT ROUND ( SUM(IF(status = 'Masuk', jumlah, 0))-(SUM(IF( status = 'Keluar', jumlah, 0))) ) AS subtotal FROM keuangan");

                            foreach ($query->result_array() as $rows) {
                              $dwet = $rows['subtotal'];
                              $arto = number_format($dwet,2,",",".");
                               echo "<center><h2>Rp. $arto</h2></center>";
                             } 
                         ?>
                      </div>
                  </div>
              </div>
      </div>
  </div>
</div>