<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>
              MANAJEMEN MODUL
          </h2>
          <ul class="header-dropdown m-r--5">
            <li class="dropdown">
              <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_manajemenmodul'>Tambahkan Data</a>
            </li>
          </ul>
      </div>
      <div class="body">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Modul</th>
                  <th>Link</th>
                  <th>Publish</th>
                  <th>Aktif</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th>No</th>
                  <th>Nama Modul</th>
                  <th>Link</th>
                  <th>Publish</th>
                  <th>Aktif</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_modul]</td>
                              <td><a href='".base_url()."administrator/$row[link]'>".base_url()."administrator/$row[link]</a></td>
                              <td>$row[publish]</td>
                              <td>$row[aktif]</td>
                              <td>$row[status]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_manajemenmodul/$row[id_modul]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_manajemenmodul/$row[id_modul]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>