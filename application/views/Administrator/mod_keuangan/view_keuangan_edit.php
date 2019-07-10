<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="header">
              <h2>
                  EDIT DATA KEUANGAN
              </h2>
          </div>
          <div class="body table-responsive">
              <?php

                $attributes = array('role'=>'form');
                  echo form_open_multipart($this->uri->segment(1).'/edit_keuangan',$attributes); 
                  echo "<table class='table table-condensed table-bordered'>
                      <tbody>
                        <input type='hidden' name='id' value='$rows[id_keuangan]'>
                        <tr>
                          <th width='120px' scope='row'>Tanggal</th>  
                          <td><input type='text' name='tgl' class='datepicker form-control' value='$rows[tgl]'></td>
                        </tr>
                        <tr>
                          <th>Status</th>  
                          <td>
                            <select class='form-control show-tick' name='status' >";
                                if ($rows['status']=='keluar'){ 
                                  echo "<option  value='keluar'>--- PENGELUARAN ---</option>"; 
                                }else{ 
                                  echo "<option  value='masuk'>--- PEMASUKAN ---</option>"; 
                                }
                                echo"<option value='Masuk'>PEMASUKAN</option>
                                <option value='Keluar'>PENGELUARAN</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th>Tujuan</th>  
                          <td><input type='text' name='tujuan' class='form-control' value='$rows[tujuan]'></td>
                        </tr>
                        <tr>
                          <th>Jumlah (Rp.)</th>  
                          <td><input type='number' name='jumlah' class='form-control'  value='$rows[jumlah]'></td>
                        </tr>

                      </tbody>
                      </table>
                  
                  <div class='box-footer'>
                        <button type='submit' name='submit' class='btn btn-info'>Update</button>
                        <a href='".base_url().$this->uri->segment(1)."/manajemenkeuangan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        
                      </div>";
                echo form_close();
              ?>

          </div>
      </div>
  </div>
</div>