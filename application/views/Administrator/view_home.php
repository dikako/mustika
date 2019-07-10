<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert bg-teal" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="row clearfix">
                <div class="col-lg-1" style="width: 40px">
                    <i class="material-icons"></i>
                </div>
                <div class="col-lg-11">
                    <?php
                        $warna=array(
                            "Ada dua perkara yang jika Anda Amalkan, Anda akan mendapatkan kebaikan dunia dan akhirat: Menerima sesuatu yang tidak Anda sukai, jika sesuatu itu disukai Allah. Dan membenci sesuatu yang Anda sukai, jika sesuatu itu dibenci oleh Allah.
                            <br><br><p style='float: right;font-size: 14px'>(Abu Hazim)</p>",

                            "Akhlak yang paling mulia adalah menyapa mereka yang memutus silaturahim, memberi kepada yang kikir terhadapmu, dan memaafkan mereka yang menyalahimu.
                            <br><br><p style='float: right;font-size: 14px'>(HR Ibnu Majah)</p>",

                            "Aku jamin rumah di dasar surga bagi yang menghindari berdebat sekalipun ia benar, dan aku jamin rumah di tengah surga bagi yang menghindari dusta walaupun dalam bercanda, dan aku jamin rumah di puncak surga bagi yang baik akhlaqnya.
                             <br><br><p style='float: right;font-size: 14px'>(HR Abu Daud)</p>",

                           "Amal yang paling baik adalah yang paling ikhlas dan paling benar. Jika amal itu ikhlas tapi tidak benar, maka tidaklah diterima. Jika amal itu benar tapi tidak ikhlas, juga tidak akan diterima kecuali jika dilakukan secara ikhlas. Ikhlas artinya dilakukan hanya karena Allah. Adapun benar artinya adalah sesuai dengan sunnah (tuntunan dan petunjuk Rasulullah shallallahu ‘alaihi wasallam).
                             <br><br><p style='float: right;font-size: 14px'>(Fudhail bin ‘Iyadh)</p>",

                            "Apabila akhirat ada dalam hati, maka akan datanglah dunia menemaninya. Tapi apabila dunia ada di hati maka akhirat tidaklah akan menemaninya. Itu karena akhirat mulia dan dermawan, sedangkan dunia adalah hina.
                             <br><br><p style='float: right;font-size: 14px'>(Abu Sulaiman Ad Daroni)</p>",

                            "Ayahku pernah mengatakan bahwa apabila ‘Ali bin al-Husain selesai berwudhu dan telah bersiap untuk shalat, tubuhnya akan gemetar dan menggigil. Pernah ada seorang lelaki yang bertanya kepadanya tentang hal itu, maka ‘Ali bin al-Husain menjawab, ‘Celakalah Engkau! Tidakkah kau tahu, kepada siapa aku akan menghadap? Dan kepada siapa aku akan bermunajat?
                             <br><br><p style='float: right;font-size: 14px'>(al-’Utaibi)</p>",

                            "Apa pendapat Anda bila ada seseorang yang pakaiannya terkena air kencing, lalu ia hendak mensucikannya dengan air kencing pula? Mungkinkah air kencing itu dapat mensucikannya? Tentu saja tidak! Kotoran tidak dapat disucikan kecuali dengan sesuatu yang suci. Begitu pula halnya keburukan yang pernah kita lakukan, tidak akan dapat terhapus kecuali dengan memperbanyak melakukan kebaikan.
                             <br><br><p style='float: right;font-size: 14px'>(Sufyan ats-Tsauri)</p>"
                        );
                        $i=date("w");
                        echo("<span style='font-size: 17px'>$warna[$i]</span>");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box-3 bg-blue hover-zoom-effect">
            <div class="icon">
                <i class="material-icons"></i>
            </div>
            <div class="content">
                <div class="text">SALDO SEKARANG</div>
                <?php
                    $query = $this->db->query("SELECT ROUND ( SUM(IF(status = 'Masuk', jumlah, 0))-(SUM(IF( status = 'Keluar', jumlah, 0))) ) AS subtotal FROM keuangan");

                    foreach ($query->result_array() as $rows) {
                      $dwet = $rows['subtotal'];
                      $arto = number_format($dwet,0,",",".");
                       echo "<div class='number'><b>Rp. $arto</b></div>";
                     } 
                 ?>
                
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box-3 bg-green hover-zoom-effect">
            <div class="icon">
                <i class="material-icons"></i>
            </div>
            <div class="content">
                <div class="text">PEMASUKAN</div>
                <?php
                    $mlebu = $this->db->query("SELECT status , SUM(jumlah) AS masuk FROM keuangan WHERE status = 'Masuk'")->result_array();
                    foreach ($mlebu as $anu) {
                        $a = $anu['masuk'];
                        $b = number_format($a,0,",",".");
                        echo "<div class='number'><b>Rp. $b</b></div>";
                    }
                ?>
                
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box-3 bg-red hover-zoom-effect">
            <div class="icon">
                <i class="material-icons"></i>
            </div>
            <div class="content">
                <div class="text">PENGELUARAN</div>
                <?php
                    $metu = $this->db->query("SELECT status , SUM(jumlah) AS keluar FROM keuangan WHERE status = 'keluar'")->result_array();
                    foreach ($metu as $anu1) {
                        $a1 = $anu1['keluar'];
                        $b1 = number_format($a1,0,",",".");
                        echo "<div class='number'><b>Rp. $b1</b></div>";
                    }
                ?>
                
            </div>
        </div>
    </div>
</div>