<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password'));
			$cek = $this->Model_app->cek_login($username,$password,'users');
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],
								   'level'=>$row['level'],
                                   'id_session'=>$row['id_session']));

				redirect($this->uri->segment(1).'/home');
			}else{
				$data['title'] = 'Username atau Password salah!';
				$this->load->view('administrator/view_login',$data);
			}
		}else{
			$data['title'] = 'Administrator &rsaquo; Log In';
			$this->load->view('administrator/view_login',$data);
		}
	}

	function reset_password(){
        if (isset($_POST['submit'])){
            $usr = $this->Model_app->edit('users', array('id_session' => $this->input->post('id_session')));
            if ($usr->num_rows()>=1){
                if ($this->input->post('a')==$this->input->post('b')){
                    $data = array('password'=>sha1($this->input->post('a')));
                    $where = array('id_session' => $this->input->post('id_session'));
                    $this->Model_app->update('users', $data, $where);

                    $row = $usr->row_array();
                    $this->session->set_userdata('upload_image_file_manager',true);
                    $this->session->set_userdata(array('username'=>$row['username'],
                                       'level'=>$row['level'],
                                       'id_session'=>$row['id_session']));
                    redirect('administrator/home');
                }else{
                    $data['title'] = 'Password Tidak sama!';
                    $this->load->view('administrator/view_reset',$data);
                }
            }else{
                $data['title'] = 'Terjadi Kesalahan!';
                $this->load->view('administrator/view_reset',$data);
            }
        }else{
            $this->session->set_userdata(array('id_session'=>$this->uri->segment(3)));
            $data['title'] = 'Reset Password';
            $this->load->view('administrator/view_reset',$data);
        }
    }

    function lupapassword(){
        if (isset($_POST['lupa'])){
            $email = strip_tags($this->input->post('email'));
            $cekemail = $this->Model_app->edit('users', array('email' => $email))->num_rows();
            if ($cekemail <= 0){
                $data['title'] = 'Alamat email tidak ditemukan';
                $this->load->view('administrator/view_login',$data);
            }else{
                $iden = $this->Model_app->edit('identitas', array('id_identitas' => 1))->row_array();
                $usr = $this->Model_app->edit('users', array('email' => $email))->row_array();
                $this->load->library('email');

                $tgl = date("d-m-Y H:i:s");
                $subject      = 'Lupa Password ...';
                $message      = "<html><body>
                                    <table style='margin-left:25px'>
                                        <tr><td>Halo $usr[nama_lengkap],<br>
                                        Seseorang baru saja meminta untuk mengatur ulang kata sandi Anda di <span style='color:red'>$iden[url]</span>.<br>
                                        Klik di sini untuk mengganti kata sandi Anda.<br>
                                        Atau Anda dapat copas (Copy Paste) url dibawah ini ke address Bar Browser anda :<br>
                                        <a href='".base_url()."administrator/reset_password/$usr[id_session]'>".base_url()."administrator/reset_password/$usr[id_session]</a><br><br>

                                        Tidak meminta penggantian ini?<br>
                                        Jika Anda tidak meminta kata sandi baru, segera beri tahu kami.<br>
                                        Email. $iden[email], No Telp. $iden[no_telp]</td></tr>
                                    </table>
                                </body></html> \n";
                
                $this->email->from($iden['email'], $iden['nama_website']);
                $this->email->to($usr['email']);
                $this->email->cc('');
                $this->email->bcc('');

                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->set_mailtype("html");
                $this->email->send();
                
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $data['title'] = 'Password terkirim ke '.$usr['email'];
                $this->load->view('administrator/view_login',$data);
            }
        }else{
            $data['title'] = 'Reset Password Administrator';
			$this->load->view('administrator/lupa_password',$data);
        }
    }

    function home(){
        $this->cek_admin();
    	$data['title'] = 'Halaman Dasboard Administrator';
        if ($this->session->level=='admin'){
          $this->template->load('administrator/template','administrator/view_home',$data);
        }else{
          $data['users'] = $this->Model_app->view_where('users',array('username'=>$this->session->username))->row_array();
          $data['modul'] = $this->Model_app->view_join_one('users','users_modul','id_session','id_umod','DESC');
          $this->template->load('administrator/template','administrator/view_home',$data);
        }
    }

    function identitaswebsite(){
        $this->cek_admin();
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('j');
            $hasil=$this->upload->data();

            if ($hasil['file_name']==''){
            	$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                'email'=>$this->db->escape_str($this->input->post('b')),
                                'url'=>$this->db->escape_str($this->input->post('c')),
                                'facebook'=>$this->input->post('d'),
                                'twitter'=>$this->input->post('d1'),
                                'instagram'=>$this->input->post('d2'),
                                'google'=>$this->input->post('d3'),
                                'youtube'=>$this->input->post('d4'),
                                'alamat'=>$this->db->escape_str($this->input->post('e')),
                                'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                'meta_deskripsi'=>$this->input->post('g'),
                                'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                'maps'=>$this->input->post('i'));
            }else{
            	$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                'email'=>$this->db->escape_str($this->input->post('b')),
                                'url'=>$this->db->escape_str($this->input->post('c')),
                               'facebook'=>$this->input->post('d'),
                                'twitter'=>$this->input->post('d1'),
                                'instagram'=>$this->input->post('d2'),
                                'google'=>$this->input->post('d3'),
                                'youtube'=>$this->input->post('d4'),
                                'alamat'=>$this->db->escape_str($this->input->post('e')),
                                'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                'meta_deskripsi'=>$this->input->post('g'),
                                'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                'favicon'=>$hasil['file_name'],
                                'maps'=>$this->input->post('i'));
            }
	    	$where = array('id_identitas' => $this->input->post('id'));
			$this->Model_app->update('identitas', $data, $where);

			redirect($this->uri->segment(1).'/identitaswebsite');
		}else{
			$proses = $this->Model_app->edit('identitas', array('id_identitas' => 1))->row_array();
			$data = array('record' => $proses);
			$data['title'] = 'Identitas Website';
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
	}

    // Controller Modul User

    function manajemenuser(){
        $this->cek_admin();
        $data['title'] = 'Data User';
        $data['record'] = $this->Model_app->view_ordering('users','username','DESC');
        $this->template->load('administrator/template','administrator/mod_users/view_users',$data);
    }

    function tambah_manajemenuser(){
        $this->cek_admin();
        $data['title'] = 'Tambah Data User';
        $id = $this->session->username;
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'assets/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>sha1($this->input->post('b')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }else{
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>sha1($this->input->post('b')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }
            $this->Model_app->insert('users',$data);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              $sess = md5($this->input->post('a')).'-'.date('YmdHis');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$sess,
                              'id_modul'=>$modul[$i]);
                $this->Model_app->insert('users_modul',$datam);
              }

            redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('a'));
        }else{
            $proses = $this->Model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
            $data = array('record' => $proses);
            $this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
        }
    }

    function edit_manajemenuser(){
        $this->cek_admin();
        $data['title'] = 'Edit Data User';
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'assets/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                   'password'=>sha1($this->input->post('b')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                  'password'=>sha1($this->input->post('b')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }
            $where = array('username' => $this->input->post('id'));
            $this->Model_app->update('users', $data, $where);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$this->input->post('ids'),
                              'id_modul'=>$modul[$i]);
                $this->Model_app->insert('users_modul',$datam);
              }

            redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('id'));
        }else{
            if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
                $proses = $this->Model_app->edit('users', array('username' => $id))->row_array();
                $akses = $this->Model_app->view_join_where('users_modul','modul','id_modul', array('id_session' => $proses['id_session']),'id_umod','DESC');
                $modul = $this->Model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
                $data = array('rows' => $proses, 'record' => $modul, 'akses' => $akses);
                $this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
            }else{
                redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->session->username);
            }
        }
    }

    function delete_manajemenuser(){
        $this->cek_admin();
        $id = array('username' => $this->uri->segment(3));
        $this->Model_app->delete('users',$id);
        redirect($this->uri->segment(1).'/manajemenuser');
    }

    function delete_akses(){
        $this->cek_admin();
        $id = array('id_umod' => $this->uri->segment(3));
        $this->Model_app->delete('users_modul',$id);
        redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->uri->segment(4));
    }

    // Controller Modul Modul

    function manajemenmodul(){
        $this->cek_admin();
        $data['title'] = 'Data Modul';
        if ($this->session->level=='admin'){
            $data['record'] = $this->Model_app->view_ordering('modul','id_modul','DESC');
        }else{
            $data['record'] = $this->Model_app->view_where_ordering('modul',array('username'=>$this->session->username),'id_modul','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
    }

    function tambah_manajemenmodul(){
        $this->cek_admin();
        $data['title'] = 'Tambah Modul';
        if (isset($_POST['submit'])){
            $data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
            $this->Model_app->insert('modul',$data);
            redirect($this->uri->segment(1).'/manajemenmodul');
        }else{
            $this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
        }
    }

    function edit_manajemenmodul(){
        $this->cek_admin();
        $data['title'] = 'Edit Modul';
        if (isset($_POST['submit'])){
            $data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
            $where = array('id_modul' => $this->input->post('id'));
            $this->Model_app->update('modul', $data, $where);
            redirect($this->uri->segment(1).'/manajemenmodul');
        }else{
            if ($this->session->level=='admin'){
                 $proses = $this->Model_app->edit('modul', array('id_modul' => $id))->row_array();
            }else{
                $proses = $this->Model_app->edit('modul', array('id_modul' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
        }
    }

    function delete_manajemenmodul(){
        $this->cek_admin();
        if ($this->session->level=='admin'){
            $id = array('id_modul' => $this->uri->segment(3));
        }else{
            $id = array('id_modul' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->Model_app->delete('modul',$id);
        redirect($this->uri->segment(1).'/manajemenmodul');
    }

     // Controller Modul Keuangan

    function manajemenkeuangan(){
        $this->cek_admin();
        $data['title'] = 'Manajemen Keuangan';
        $data['masuk'] = $this->db->query("SELECT * FROM keuangan WHERE status='Masuk' ORDER BY id_keuangan DESC")->result_array();
        $data['keluar'] = $this->db->query("SELECT * FROM keuangan WHERE status='Keluar' ORDER BY id_keuangan DESC")->result_array();
        $this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan',$data);
    }

    function tambah_keuangan(){
        $this->cek_admin();
        $data['title'] = 'Tambah Manajemen Keuangan';
        if (isset($_POST['submit'])){
            $data = array('username'=>$this->session->username,
                        'status'=>$this->db->escape_str($this->input->post('status')),
                        'tgl'=>$this->db->escape_str($this->input->post('tgl')),
                        'tujuan'=>$this->db->escape_str($this->input->post('tujuan')),
                        'jumlah'=>$this->db->escape_str($this->input->post('jumlah'))
            );
            $this->Model_app->insert('keuangan',$data);
            redirect($this->uri->segment(1).'/manajemenkeuangan');
        }else{
            $this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan_tambah', $data);
        }
    }

    function edit_keuangan(){
        $this->cek_admin();
        $data['title'] = 'Edit Manajemen Keuangan';
        if (isset($_POST['submit'])){
            $data = array('username'=>$this->session->username,
                        'status'=>$this->db->escape_str($this->input->post('status')),
                        'tgl'=>$this->db->escape_str($this->input->post('tgl')),
                        'tujuan'=>$this->db->escape_str($this->input->post('tujuan')),
                        'jumlah'=>$this->db->escape_str($this->input->post('jumlah'))
            );
            $where = array('id_keuangan' => $this->input->post('id'));
            $this->Model_app->update('keuangan', $data, $where);
            redirect($this->uri->segment(1).'/manajemenkeuangan');
        }else{
            $id = $this->uri->segment(3);
            if ($this->session->level=='admin'){
                 $proses = $this->Model_app->edit('keuangan', array('id_keuangan' => $id))->row_array();
            }else{
                $proses = $this->Model_app->edit('keuangan', array('id_keuangan' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan_edit',$data);
        }
    }

    function delete_keuangan(){
        $this->cek_admin();
        if ($this->session->level=='admin'){
            $id = array('id_keuangan' => $this->uri->segment(3));
        }else{
            $id = array('id_keuangan' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->Model_app->delete('keuangan',$id);
        redirect($this->uri->segment(1).'/manajemenkeuangan');
    }

    // Controller Modul Laporan

    function laporan(){
        $this->cek_admin();
        $data['title'] = 'Laporan Keuangan';
        $this->template->load('administrator/template','administrator/mod_laporan/view_laporan', $data);
    }

    function tampil_data(){
        $vtanggal=$this->input->post('vtanggal');
        $data['tampil_data']=$this->Model_app->tampil_data($vtanggal);
        $data['tampil_data1']=$this->Model_app->tampil_data1($vtanggal);
        $this->load->view('administrator/mod_laporan/tampil_data',$data);
    }

    function cetak_laporan(){
        $data['title'] = 'Cetak Laporan Keuangan';
        $vtanggal=$this->input->post('vtanggal');
        $data['tampil_data']=$this->Model_app->tampil_data($vtanggal);
        $data['tampil_data1']=$this->Model_app->tampil_data1($vtanggal);
        $this->load->view('administrator/mod_laporan/cetak_laporan',$data);
    }

    function cek_admin(){
        if(!$this->session->userdata('level')) {
            redirect ('administrator/index');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('administrator');
    }
}