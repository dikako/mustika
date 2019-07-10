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
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemenuser',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Username</th>   <td><input type='text' class='form-control' name='a' onkeyup=\"nospaces(this)\" required></td></tr>
                    <tr><th scope='row'>Password</th>                 <td><input type='password' class='form-control' name='b' onkeyup=\"nospaces(this)\" required></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>             <td><input type='text' class='form-control' name='c' required></td></tr>
                    <tr><th scope='row'>Alamat Email</th>             <td><input type='email' class='form-control' name='d' required></td></tr>
                    <tr><th scope='row'>No Telepon</th>               <td><input type='number' class='form-control' name='e' required></td></tr>
                    <tr><th scope='row'>Upload Foto</th>              <td><input type='file' class='form-control' name='f'></td></tr>
                    <tr>
                      <th scope='row'>Level</th>                   
                      <td>
                        <div class='demo-radio-button'>
                          <input name='g' type='radio' id='user' value='user' class='with-gap radio-col-deep-purple' />
                          <label for='user'>User Biasa</label>
                          <input name='g' type='radio' id='admin' value='admin' class='with-gap radio-col-deep-purple' />
                          <label for='admin'>Administrator</label>
                        </div>
                      </td>
                    <tr>
                      <th scope='row'>Akses Modul</th>                    
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
                  </tbody>
                  </table></div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/manajemenuser'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>";
            echo form_close();
        ?>


      </div>
    </div>
  </div>
</div>