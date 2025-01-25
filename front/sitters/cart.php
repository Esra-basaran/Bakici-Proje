<?php  require_once '../body/header.php'; 

//session_start();
if(isset($_GET['id'])){
    $basvuran_id = $_SESSION['bakici_kullanici_id']; 
    $basvurular = isset($_SESSION['basvuru_ilan'][$basvuran_id]) ? $_SESSION['basvuru_ilan'][$basvuran_id] : [];
}
?>
<?php if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])): ?>
    <main style="margin-bottom:170px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ilan-cart">
                        <h2>Yapılan Başvurularım</h2>
                        <?php if(!empty($basvurular)):?>
                                <div class="alert alert-warning">
                                    <strong>Bilgi !</strong>
                                    Başvurularınız onay aşamasında , 24 Saat içinde değerlendirilicektir.
                                </div>
                                <?php endif;?>
                            <?php foreach($basvurular as $basvuru): ?>
                                <?php
                                    //döngü her döndükce  basvuruya karşılık gelen bilgiyi yansıtması için
                                    $sepet_ilanlar = $db->prepare("SELECT * FROM ilan WHERE ilan_id =:ilan_id ");
                                    $sepet_ilanlar->execute(array('ilan_id' => $basvuru['ilan_id']));
                                    $sepet_ilan = $sepet_ilanlar->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="work" id="work" data-id="<?php echo $sepet_ilan['ilan_id']; ?> " name="<?php echo $sepet_ilan['ilan_id']; ?> " style="background-color:white;padding:10px;">
                                    <div class="col-lg-3">
                                        <a href="<?php echo base_url("front/advert/detail.php?id=".$sepet_ilan['ilan_id']);?>">
                                            <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="advert-list-img">
                                        </a>
                                    </div>
                                    <div class="col-lg-9">
                                      <div class="work-content">
                                        <div class="work-body-title">
                                           <p><a href="<?php echo base_url("front/advert/detail.php?id=".$sepet_ilan['ilan_id']);?>"><?php echo $sepet_ilan['ilan_baslik']; ?></a></p>
                                            <span class="cart_clean cart_cleancss" name="cart_clean" value="<?php echo $sepet_ilan['ilan_id']; ?>" ><i class="fa-regular fa-circle-xmark"></i></span>
                                        </div>
                                        <div class="work-body-navigation">
                                            <i class="fa-solid fa-location-dot icon"></i> 
                                            <?php echo $sepet_ilan['ilan_il']; ?> / <?php echo $sepet_ilan['ilan_ilce']; ?>
                                        </div>
                                        <div class="work-body-feature">
                                            <p>Çalışma Şekli: <span class="age"><?php echo $sepet_ilan['ilan_calismazaman']; ?></span></p>
                                            <p>İş Deneyimi: <span><?php echo $sepet_ilan['ilan_deneyim']; ?> Yıl</span></p>
                                            <p>Ücret: <span><?php echo $sepet_ilan['ilan_maas']; ?></span></p>
                                        </div>
                                        <div class="work-body-text">
                                         <a href="<?php echo base_url("front/advert/detail.php?id=".$sepet_ilan['ilan_id']);?>"><?php echo $sepet_ilan['ilan_aciklama']; ?></a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            <?php endforeach; ?> 
                            <?php if(empty($basvurular)):?>
                                <div class="remove-cart">
                                    <img src="<?php echo base_url("assets/image/remove-cart.png");?>" style="width:9%;">
                                    <div>
                                        <h5>Sepetiniz Boş!</h5>
                                        <p>Yapılan Başvuru bulunmamaktadır ... </p>
                                    </div>
                                </div>
                            <?php endif;?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ilan-cart-content">
                        <h2>Başvuru Özeti</h2>
                        <?php foreach($basvurular as $basvur):?>
                            <?php  
                                $sepet_idler = $db->prepare("SELECT * FROM ilan WHERE ilan_id = :ilan_id");
                                $sepet_idler->execute(array('ilan_id' => $basvur['ilan_id']));
                                $sepet_id = $sepet_idler->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="cart-content-price">
                                <p>Başvuru ID: </p>
                                <p><?php echo $sepet_id['ilan_id']; ?></p>
                            </div>
                        <?php endforeach; ?>
                        <div class="cart-content-total">
                            <p>Toplam Başvuru Sayısı:</p>
                            <p><?php echo count($basvurular); ?></p>
                        </div>
                        <div class="cart-content-basket">
                            <a href="<?php echo base_url("front/advert/list.php"); ?>" class="btn btn-dark">Başvuru Yapmaya Devam Et <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php else: ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img src="<?php echo base_url('assets/image/no-cart.png'); ?>" alt="" class="w-100">
                </div>
                <div class="col-lg-7">
                    <div class="exitbox">
                        <h1>Başvuru Yapılamadı !</h1>
                        <h6>Üye Girişi Yapmadan İş Başvurusu Yapamazsınız...</h6>
                       <a href="<?php echo base_url('front/sitters/login.php'); ?>"><p class="backbtn" style="margin-top:200px;color:white;">ÜYE GİRİŞİ İÇİN <i class="fa-solid fa-arrow-right-to-bracket"></i></p></a>
                    </div>
                </div>      
            </div>
        </div>
    </main>
<?php endif; ?>
<?php  require_once '../body/footer.php';?>
