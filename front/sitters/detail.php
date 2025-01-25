<?php  require_once '../body/header.php';
session_start();

 if(isset($_GET['id'])){
    $bakici_id = $_GET['id'];
    $bakicidetail = $db->prepare("SELECT * FROM bakici WHERE bakici_id =:bakici_id");
    $bakicidetail -> execute(['bakici_id' => $bakici_id]);
    $bakici = $bakicidetail->fetch(PDO::FETCH_ASSOC);



    $basvuru_getir = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 1 AND basvuran_id =:basvuran_id AND basvurulan_id =:basvurulan_id");
    $basvuru_getir ->execute([
        'basvuran_id' => $bakici_id,
        'basvurulan_id'=> $_SESSION['ilan_kullanici_id']
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
                        <li>Çocuk Bakıcısı <i class="fa-solid fa-angle-right"></i></li>
                        <li>Çocuk Bakıcısı Sultan</li>
                    </ul>
                </div>
                <div class="detail_form " id="detail_form_clean" value="<?php echo $basvurular['basvuran_id']; ?>"
                   data-id="<?php echo $basvurular['basvuran_id']; ?>"
                    data-tarih="<?php echo $bakici['bakici_tarih']; ?>"
                    data-type="<?php echo $bakici['bakici_type']; ?>"
                    data-basvuran="<?php echo $_SESSION['ilan_kullanici_id']; ?>"
                >
                  <div class="detail-sitter">
                      <div class="detail-sitter-header">
                            <img src="<?php echo base_url('assets/image/sitterimg1.jpg'); ?>" class="detailimg">
                            <div class="detail-info">
                                <h6><?php echo $bakici['bakici_ad']; ?></h6>
                                <div class="detail-navigation">
                                    <a href="#"><i class="fa-solid fa-location-dot icon"></i><?php echo $bakici['bakici_il']; ?> / <?php echo $bakici['bakici_ilce']; ?></a>
                                </div>
                                <div class="detail-select">
                                    <p><span>Yaş : </span><?php echo $bakici['bakici_yas']; ?></p>
                                    <p><span>İş Deneyimi : </span><?php echo $bakici['bakici_deneyim']; ?></p>
                                    <p><span>E-posta : </span><?php echo $bakici['bakici_eposta']; ?></p>
                                    <p><span>Telefon : </span> <?php echo $bakici['bakici_tel']; ?></p>
                                    <p><span>Kayıt Tarihi : </span> <?php echo $bakici['bakici_tarih']; ?></p>
                                </div>
                                   <?php if($basvurular['basvuran_id']): ?>
                                       <span class="app_button iapp_clean" id="application_clean"> <i class="fa-solid fa-trash-arrow-up"></i> Talebi sil</span>
                                    <?php endif;?>
                                    <?php if(isset($_SESSION['ilan_kullanici_ad']) && !empty($_SESSION['ilan_kullanici_ad'])):?>
                                    <?php else: ?>
                                        <p class="detail-btn" style="width:fit-content;position:relative;left:85%;"><a href="<?php  echo base_url("front/advert/login.php");?>"> <i class="fa-regular fa-address-card"></i> Erişmek İçin Giriş Yap</a></p>
                                    <?php endif; ?>
                            </div>
                      </div>
                       <div class="detail-sitter-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="detail-sitter-text">
                                        <h4> <i class="fa-solid fa-pen-to-square"></i>Hakkımda</h4>
                                        <p><?php echo $bakici['bakici_ozgecmis']; ?></p>
                                    </div>
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-regular fa-rectangle-list"></i>Çocuk Bakıcısı Olarak Becerilerim</h4>
                                        <?php echo $bakici['bakici_beceri'];?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-solid fa-list-check"></i>Özet</h4>
                                        <div class="detail-sitter-summary">
                                        <p><span>Eğitim Durumu : </span><?php echo $bakici['bakici_egitim']; ?></p>
                                            <p><span>Cinsiyet :</span><?php echo $bakici['bakici_egitim']; ?></p>
                                            <p><span>Din : </span><?php echo $bakici['bakici_egitim']; ?></p>
                                            <p><span>Yabancı Diller : </span> <?php echo $bakici['bakici_egitim']; ?> </p>
                                            <p><span>Çalışma Şekli : </span><?php echo $bakici['bakici_calismazaman']; ?>
                                            <p><span>Sigara İçiyor musunuz ? : </span><?php echo $bakici['bakici_sigara']; ?></p>
                                            <p><span>Ehliyetiniz Var mı ? : </span><?php echo $bakici['bakici_ehliyet']; ?></p>
                                            <p><span>Hizmet Ücreti : </span> <?php echo $bakici['bakici_maas']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!isset($basvurular['basvuran_id']) || !isset($basvurular['basvurulan_id'])): ?>
                                    <div class="col-lg-12">
                                        <p class="detail_cart detail-sitter-footer "><i class="fa-solid fa-user-plus"></i> BAŞVURU YAP </p>
                                    </div>
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4">
                                        <p class="detail-sitter-footer"><a href="list.php"> Bakıcı Aramaya Geri Dön <i class="fa-solid fa-angle-right"></i></a></p>
                                    </div>    
                                    <?php else: ?>
                                        <p class="detail-sitter-footer"><a href="list.php">Bakıcı Aramaya Geri Dön<i class="fa-solid fa-angle-right"></i> </a></p>
                                    <?php endif; ?>      
                            </div>
                      </div>
                  </div>
                  <input type="hidden" name="cart-bakici-id" value=" <?php echo $bakici['bakici_id'];?>" >
                    <input type="hidden" name="cart-bakici-ad" value="<?php echo $bakici['bakici_ad'];?>" >
              </div>
            </div>   
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>