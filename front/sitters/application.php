<?php  require_once '../body/header.php';

session_start();
if(isset($_GET['id'])){
    $basvurular = isset($_SESSION['basvuru_ilan']) ? $_SESSION['basvuru_ilan']:[] ;
}
$basvuru_getir = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 2 AND basvurulan_id =:basvurulan_id");
$basvuru_getir->execute(['basvurulan_id'=>$_GET['id']]);
$basvurular = $basvuru_getir->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])): ?>
    <main style="margin-bottom:170px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ilan-cart"style="margin-left:auto;margin-right:auto;width:80%;">
                            <h2>Size Gelen İş ilanları</h2>
                            <hr>
                            <br>
                           <?php foreach($basvurular as $basvuru): ?>
                            <div class="alert alert-primary" style="margin-left:auto;margin-right:auto;width:96%;">
                               <strong>Bilgi ! </strong>
                               İş Başvurusu Tekliflerinizi 24 saat içinde onaylamazsanız otomatik iptal edilecektir.
                            </div>
                            <?php
                            $ilan_bilgi = $db->prepare("SELECT * FROM ilan WHERE ilan_id =:ilan_id");
                            $ilan_bilgi -> execute(array('ilan_id'=>$basvuru['basvuran_id']));
                            $ilanlar = $ilan_bilgi->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($ilanlar as $ilan):?>
                                
                            <div class="work" id="app_work"  data-id="<?php echo $ilan['ilan_id']; ?>" name="<?php echo $ilan['ilan_id']; ?>"style="background-color:white;width:96%;">
                                    <div class="col-lg-3">
                                    <a href="<?php  echo base_url("front/advert/detail.php?id=". $ilan['ilan_id']);?>">
                                        <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="advert-list-img">
                                    </a>
                                    <span class= "app_clean cart_cleancss" value="<?php echo $ilan['ilan_id']; ?>"><i class="fa-regular fa-circle-xmark"></i></span>
                                    <span class="iapp_check okBtn" ><i class="fa-regular fa-circle-check"></i></span>
                                  </div>
                                    <div class="col-lg-9">
                                    <div class="work-content">
                                        <div class="work-body-title">
                                            <p><a href="<?php  echo base_url("front/advert/detail.php?id=". $ilan['ilan_id']);?>">
                                                    <?php echo $ilan['ilan_baslik']; ?>
                                            </a></p> 
                                        </div>
                                        <div class="work-body-navigation">
                                            <i class="fa-solid fa-location-dot icon"></i> 
                                            <?php echo $ilan['ilan_il']; ?> / <?php echo $ilan['ilan_ilce']; ?> /
                                        </div>
                                        <div class="work-body-feature">
                                            <p>Çalışma Şekli: <span class="age"> <?php echo $ilan['ilan_calismazaman']; ?> </span></p>
                                            <p>İş Deneyimi: <span><?php echo $ilan['ilan_deneyim']; ?> Yıl</span></p>
                                            <p>Ücret: <span><?php echo $ilan['ilan_maas']; ?></span></p>
                                        </div>
                                        <div class="work-body-text">
                                            <a href="<?php  echo base_url("front/advert/detail.php?id=". $ilan['ilan_id']);?>">
                                                <?php echo $ilan['ilan_aciklama']; ?>
                                            </a>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endforeach;?> 
                        <?php if(empty($basvurular)): ?>
                            <div class="remove-cart">
                                <img src="<?php echo base_url("assets/image/remove-cart.png");?>" style="width:9%;">
                                <div>
                                    <h5>Gelen Başvuru Bulunmamaktadır !</h5>
                                    <p> Kutunuz Boş </p>
                                </div>
                            </div>
                        <?php  endif;?>
                    </div>
                    </div>
                </div>
            </div>
    </main>
<?php else: ?>
    <p>GİRİŞ YAPMALISINZ !</p>
<?php endif; ?>

<?php  require_once '../body/footer.php';?>
