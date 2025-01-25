<?php  require_once '../body/header.php';

session_start();

if(isset($_GET['id'])){
    $ilan_id = $_GET['id'];
    $ilansor = $db->prepare("SELECT * FROM ilan WHERE ilan_id =:ilan_id ");
    $ilansor->execute(['ilan_id'=> $ilan_id]);
    $ilancek = $ilansor->fetch(PDO::FETCH_ASSOC);

    if(!$ilancek){ // ilan idsi veritabanımda yok ise yönlendir
       header("location:list.php");
        exit;
    }


    $basvuru_getir = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 2 AND basvuran_id =:basvuran_id AND basvurulan_id =:basvurulan_id ");
    $basvuru_getir ->execute([
        'basvuran_id' => $ilan_id,
        'basvurulan_id' => $_SESSION['bakici_kullanici_id'],
    ]);
    $basvurular = $basvuru_getir ->fetch(PDO::FETCH_ASSOC);
       
}
?>
<section class="bg-color"style="padding-top:57px;padding-bottom:100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="detail-title">
                    <ul>
                        <li>Anasayfa <i class="fa-solid fa-angle-right"></i></li>
                        <li>Çocuk Bakıcısı İş İlanları </li>
                    </ul>
                </div>
                <div class="detail-sitter">
                 <div class="detail_form detail_form_clean" value="<?php echo $basvurular['basvuran_id']; ?>"
                    data-id="<?php echo $ilancek['ilan_id']; ?>"
                    data-tarih="<?php echo $ilancek['ilan_tarih']; ?>"
                    data-type="<?php echo $ilancek['ilan_type']; ?>"
                    data-basvuran="<?php echo $_SESSION['bakici_kullanici_id']; ?>">
                        <div class="detail-sitter-header ">
                            <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="detailimg">
                            <div class="detail-info">
                                <h6><?php echo $ilancek['ilan_baslik']; ?></h6>
                                <div class="detail-navigation">
                                    <i class="fa-solid fa-location-dot icon"></i> 
                                    <?php echo $ilancek['ilan_il']; ?> / <?php echo $ilancek['ilan_ilce']; ?>
                                </div>
                                <div class="detail-select"style="gap:40px;">
                                    <p><span>Yaş : </span> <?php echo $ilancek['ilan_yas']; ?></p>
                                    <p><span>E-posta : </span> <?php echo $ilancek['ilan_eposta']; ?></p>
                                    <p><span>Telefon : </span> <?php echo $ilancek['ilan_tel']; ?></p>
                                    <p><span>Kayıt Tarihi : </span> <?php echo $ilancek['ilan_tarih']; ?></p>
                                    <p><span>Başlama Tarihi :</span><?php echo $ilancek['ilan_isbasitarih']; ?></p>
                                </div>
                                <?php if(isset($basvurular['basvuran_id'])): ?>
                                   <span class="app_button app_clean" id="application_clean"> <i class="fa-solid fa-trash-arrow-up"></i> Talebi sil</span>
                               <?php endif;?>
                            </div>
                        </div>
                        <div class="detail-sitter-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="detail-sitter-text">
                                        <h4> <i class="fa-solid fa-pen-to-square"></i>Açıklama</h4>
                                        <p><?php echo $ilancek['ilan_aciklama']; ?></p>
                                    </div>
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-regular fa-rectangle-list"></i>Çocuk Bakıcısı Olarak Becerilerim</h4>
                                        <ul>
                                        <?php echo $ilancek['ilan_beceri']; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-solid fa-list-check"></i>Özet</h4>
                                        <div class="detail-sitter-summary">
                                        <p><span>Eğitim Durumu : </span><?php echo $ilancek['ilan_egitim']; ?></p>
                                        <p><span>İş Deneyimi : </span><?php echo $ilancek['ilan_deneyim']; ?>Yıl</p>
                                            <p><span>Cinsiyet :</span><?php echo $ilancek['ilan_cinsiyet']; ?></p>
                                            <p><span>Din : </span><?php echo $ilancek['ilan_din']; ?></p>
                                            <p><span>Yabancı Diller : </span><?php echo $ilancek['ilan_dil']; ?> </p>
                                            <p><span>Çalışma Şekli : </span> <?php echo $ilancek['ilan_calismazaman']; ?></p>
                                            <p><span>Sigara İçiyor musunuz ? : </span> <?php echo $ilancek['ilan_sigara']; ?></p>
                                            <p><span>Ehliyetiniz Var mı ? : </span> <?php echo $ilancek['ilan_ehliyet']; ?></p>
                                            <p><span>Hizmet Ücreti : </span> <?php echo $ilancek['ilan_maas']; ?></p>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 responsive-advertbtn">
                                <?php if(!isset($basvurular['basvuran_id']) || !isset($basvurular['basvurulan_id'])): ?>
                                  <p class="detail_cart detail-sitter-footer"type="button"><i class="fa-solid fa-user-plus"></i>BAŞVURU YAP</p>
                                  <p class="detail-btn"><a href="<?php  echo base_url('front/advert/list.php');?>">İlan Aramaya Geri Dön<i class="fa-solid fa-angle-right"></i></a></p>
                                <?php endif;?>
                            </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $ilancek['ilan_id']; ?>" name="cart-ilan-id">
                        <input type="hidden" value="<?php echo $ilancek['ilan_id']; ?>" name="detail-sil">
                    </div>
                </div>
            </div>   
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>