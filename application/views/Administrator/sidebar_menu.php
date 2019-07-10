<!-- User Info -->
<div class="user-info">
    <div class='image'>
        <?php $usr = $this->Model_app->view_where('users', array('username'=> $this->session->username))->row_array();
            if (trim($usr['foto'])==''){ $foto = 'blank.png'; }else{ $foto = $usr['foto']; } ?>
        <img src='<?php echo base_url(); ?>/assets/foto_user/<?php echo $foto; ?>' width='48' height='48' alt='User' >
    </div>
    <div class='info-container'>
        <div class='name' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><?php echo $usr['nama_lengkap'] ?></div>
        <div class='email'><?php echo $usr['email'] ?></div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:void(0);"><i class="material-icons"></i>Profile</a></li>
                <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/logout"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- #User Info -->
<!-- Menu -->
<div class="menu">
    <ul class="list">
        <li class="header">MENU</li>
        <li class="active">
            <a href="<?php echo base_url() ?>administrator/home">
                <i class="material-icons"></i>
                <span>Home</span>
            </a>
        </li>
        <?php
            $cek=$this->Model_app->umenu_akses("identitaswebsite",$this->session->id_session);
            if($cek==1 OR $this->session->level=='admin'){
                echo "<li>
                    <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'>
                        <i class='material-icons'></i>
                        <span>Identitas Website</span>
                    </a>
                </li>";
            }
        ?>
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons"></i>
                <span>Modul Keuangan</span>
            </a>
            <ul class="ml-menu">
                <?php
                    $cek=$this->Model_app->umenu_akses("manajemenkeuangan",$this->session->id_session);
                    if($cek==1 OR $this->session->level=='admin'){
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenkeuangan'><i class='material-icons'></i> Kelola Keuangan</a></li>";
                    }

                    $cek=$this->Model_app->umenu_akses("detailkeuangan",$this->session->id_session);
                    if($cek==1 OR $this->session->level=='admin'){
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/laporan'><i class='material-icons'></i> Laporan Keuangan</a></li>";
                    }
                ?>
            </ul>
        </li>

         <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons"></i>
                <span>Modul User</span>
            </a>
            <ul class="ml-menu">
                <?php
                    $cek=$this->Model_app->umenu_akses("manajemenuser",$this->session->id_session);
                    if($cek==1 OR $this->session->level=='admin'){
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenuser'><i class='material-icons'></i> Manajemen User</a></li>";
                    }

                    $cek=$this->Model_app->umenu_akses("manajemenmodul",$this->session->id_session);
                    if($cek==1 OR $this->session->level=='admin'){
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenmodul'><i class='material-icons'></i> Manajemen Modul</a></li>";
                    }
                ?>
            </ul>
        </li>
       
    </ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
    <div class="copyright">
        <strong>&copy; <?php echo date('Y'); ?> All rights reserved.</strong> 
    </div>
    <div class="version">
        Developer By <b><a target='_BLANK' href="#">Mustika Corp</a></b>.
    </div>
</div><strong>Copyright &copy; <?php echo date('Y'); ?> <a target='_BLANK' href="#"> Mustika</a>.</strong> All rights reserved. 
<!-- #Footer -->