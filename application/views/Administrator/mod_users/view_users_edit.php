<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h2>
              TAMBAH DATA USER
          </h2>
      </div>
      <div class="body">

        <?php 
          $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_manajemenuser',$attributes); 
              if ($rows['foto']==''){ $foto = 'users.gif'; }else{ $foto = $rows['foto']; }
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value='$rows[username]'>
                      <input type='hidden' name='ids' value='$rows[id_session]'>
                      <tr>
                        <th width='170px' scope='row'>Username</th>   
                        <td><input type='text' class='form-control' name='a' value='$rows[username]' readonly='on'></td>
                      </tr>
                      <tr>
                        <th scope='row'>Password</th>                 
                        <td><input type='password' class='form-control' name='b' onkeyup=\"nospaces(this)\"></td>
                      </tr>
                      <tr>
                        <th scope='row'>Nama Lengkap</th>             
                        <td><input type='text' class='form-control' name='c' value='$rows[nama_lengkap]'></td>
                      </tr>
                      <tr>
                        <th scope='row'>Alamat Email</th>                    
                        <td><input type='email' class='form-control' name='d' value='$rows[email]'></td>
                      </tr>
                      <tr>
                        <th scope='row'>No Telepon</th>                  
                        <td><input type='number' class='form-control' name='e' value='$rows[no_telp]'></td>
                      </tr>
                      <tr>
                        <th scope='row'>Ganti Foto</th>                     
                        <td><input type='file' class='form-control' name='f'>
                          <hr style='margin:5px'>";
                            if ($rows['foto'] != ''){ 
                              echo "<i style='color:red'>Foto Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_user/$rows[foto]'>$rows[foto]</a>"; } echo "
                        </td>
                      </tr>
                      </td></tr>";
                      if ($this->session->level == 'admin'){
                        echo "<tr>
                          <th scope='row'>Blokir</th>                   
                          <td>"; if ($rows['blokir']=='Y'){ 
                            echo "<div class='demo-radio-button'>
                              <input name='h' type='radio' id='Y' value='Y' class='with-gap radio-col-deep-purple' checked/>
                              <label for='Y'>YA</label>
                              <input name='h' type='radio' id='N' value='N' class='with-gap radio-col-deep-purple' />
                              <label for='N'>TIDAK</label>
                            </div>"; 
                          }else{ 
                            echo "<div class='demo-radio-button'>
                              <input name='h' type='radio' id='Y' value='Y' class='with-gap radio-col-deep-purple'/>
                              <label for='Y'>YA</label>
                              <input name='h' type='radio' id='N' value='N' class='with-gap radio-col-deep-purple' checked />
                              <label for='N'>TIDAK</label>
                            </div>"; 
                          } echo "</td>

                        </tr>
                        <tr>
                          <th scope='row'>Tambah Akses</th>                    
                          <td>
                            <div class='demo-checkbox'>";
                              $no = 1;
                              foreach ($record as $row){
                                echo "<input type='checkbox' id='md_checkbox_$no' class='filled-in chk-col-indigo' value='$row[id_modul]' />
                                    <label for='md_checkbox_$no'>$row[nama_modul]</label>";
                                $no++;
                              }
                              
                            echo "</div>
                          </td>
                        </tr>
                        <tr>
                          <th scope='row'>Hak Akses</th>                    
                          <td>
                            <div class='demo-checkbox'>";
                              foreach ($akses as $ro){
                                echo "<span><a href='".base_url()."administrator/delete_akses/$ro[id_umod]/".$this->uri->segment(3)."' type='button' class='btn bg-red waves-effect'><i class='material-icons'>print</i></a></span>
                                <label for='md_checkbox_$no'>$row[nama_modul]</label>";
                              }
                            echo "</div>
                          </td>
                        </tr>";
                      }
                    echo "</tbody>
                  </table>
                </div>
                <div class='box-footer'>
                  <button type='submit' name='submit' class='btn btn-info'>Update</button>
                  <a href='".base_url().$this->uri->segment(1)."/manajemenuser'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>";
            echo form_close();
        ?>
      </div>
    </div>
  </div>
</div>