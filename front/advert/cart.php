<?php  require_once '../body/header.php'; 

session_start();
if(isset($_GET['id'])){
    $basvuran_id = $_SESSION['ilan_kullanici_id']; 
    $basvurular = isset($_SESSION['basvuru_bakici'][$basvuran_id]) ? $_SESSION['basvuru_bakici'][$basvuran_id]:[];
}
?>
<?php if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])): ?>
    <main style="margin-bottom:170px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
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
                                    $sepet_bakicilar = $db->prepare("SELECT * FROM bakici WHERE bakici_id =:bakici_id");
                                    $sepet_bakicilar->execute(array('bakici_id' => $basvuru['bakici_id']));
                                    $sepet_bakici = $sepet_bakicilar->fetch(PDO::FETCH_ASSOC);
                                ?>
                               <div class="sitter" id="sitter" data-id="<?php echo $sepet_bakici['bakici_id'];?>">
                                    <div class="sitter-image">
                                    <a href="<?php  echo base_url("front/sitters/detail.php?id=". $sepet_bakici['bakici_id']);?>">
                                        <img src="<?php echo base_url('assets/image/sitter.jpg'); ?>" alt="" class="sitterimg">
                                    </a>
                                    </div>
                                    <div class="sitter-content">
                                        <div class="sitter-title">
                                        <a href="<?php  echo base_url("front/sitters/detail.php?id=". $sepet_bakici['bakici_id']);?>">
                                            <?php echo $sepet_bakici['bakici_ad']; ?>
                                        </a>
                                            <span class="bakici_clean" name="bakici_clean" ><i class="fa-regular fa-circle-xmark"></i></span>
                                        </div>
                                        <div class="sitter-navigation">
                                           <i class="fa-solid fa-location-dot icon"></i> <?php echo $sepet_bakici['bakici_il']; ?>/ <?php echo $sepet_bakici['bakici_ilce']; ?>
                                        </div>
                                        <div class="sitter-feature">
                                            <p>Çalışma Şekli : <span class="age"><?php echo $sepet_bakici['bakici_calismazaman']; ?></span></p>
                                            <p>İş Deneyimi :<span><?php echo $sepet_bakici['bakici_deneyim']; ?> YIL</span></p>
                                            <p> Hizmet Ücreti :<span><?php echo $sepet_bakici['bakici_maas']; ?></span></p>
                                        </div>
                                        <div class="sitter-text">
                                            <?php echo $sepet_bakici['bakici_ozgecmis']; ?>
                                        </div>
                                        <a href="<?php  echo base_url("front/sitters/detail.php?id=". $sepet_bakici['bakici_id']);?>">daha fazla göster...</a>
                                    </div>
                                    <input type="hidden" name="cart-bakici-id" value=" <?php echo $sepet_bakici['bakici_id'];?>" >
                                    <input type="hidden" name="cart-bakici-ad" value="<?php echo $sepet_bakici['bakici_ad'];?>" >
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
                <div class="col-lg-5">
                    <div class="ilan-cart-content">
                        <h2>Başvuru Özeti</h2>
                        <?php foreach($basvurular as $basvur):?>
                            <?php  
                                $sepet_idler = $db->prepare("SELECT * FROM bakici WHERE bakici_id = :bakici_id");
                                $sepet_idler->execute(array('bakici_id' => $basvur['bakici_id']));
                                $sepet_id = $sepet_idler->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="cart-content-price">
                                <p>Başvuru ID: </p>
                                <p><?php echo $sepet_id['bakici_id']; ?></p>
                            </div>
                        <?php endforeach; ?>
                        <div class="cart-content-total">
                            <p>Toplam Başvuru Sayısı:</p>
                            <p><?php echo count($basvurular); ?></p>
                        </div>
                        <div class="cart-content-basket">
                            <a href="<?php echo base_url("front/sitters/list.php"); ?>" class="btn btn-dark">Başvuru Yapmaya Devam Et <i class="fa-solid fa-chevron-right"></i></a>
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
                       <a href="<?php echo base_url('front/advert/login.php'); ?>"><p class="backbtn" style="margin-top:200px;color:white;">ÜYE GİRİŞİ İÇİN <i class="fa-solid fa-arrow-right-to-bracket"></i></p></a>
                    </div>
                </div>      
            </div>
        </div>
    </main>
<?php endif; ?>
<?php  require_once '../body/footer.php';?>
