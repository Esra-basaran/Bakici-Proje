<?php require_once('front/body/header.php');
//veritablodan ilan bilgileri için
$ilansor = $db->prepare("SELECT * FROM ilan LIMIT 3");
$ilansor -> execute();
$ilanlar = $ilansor -> fetchAll(PDO::FETCH_ASSOC);
//veritablodan bakici bilgileri için
$bakicisor = $db->prepare("SELECT * FROM bakici LIMIT 3");
$bakicisor ->execute();
$bakicilar = $bakicisor ->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <div class="swiper mySwiper mt-20">
        <div class="swiper-wrapper">
            <div class="swiper-slide" >
                <img src="<?php echo base_url('assets/image/bakici14.jpg')?>">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo base_url('assets/image/bakici11.jpg')?>">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo base_url('assets/image/bakici13.jpg')?>">
            </div>
            <div class="swiper-slide">
                <img src="<?php echo base_url('assets/image/slider3.jpg')?>">
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</main>
 <section class="menu-bg " style="padding-top:50px;padding-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div style="width:100%;">
                    <h4 class="section-title"><i class="fa-solid fa-file"></i>İLANLAR</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="workcards">
                                <?php foreach($ilanlar as $ilan):?>
                                    <div class="workdiv">
                                        <div class="work-body">
                                            <div class="work-body-title">
                                                <h4><?php echo $ilan['ilan_baslik'];?></h4>
                                                <p> <i class="fa-regular fa-calendar" style="margin-right:10px;"></i><?php $ilan_tarih=$ilan['ilan_tarih'];  echo date('d.m.Y', strtotime($ilan_tarih)); ?></p>
                                            </div>
                                            <p> <?php echo $ilan['ilan_verenad'];?></p>
                                            <div class="work-body-navigation">
                                                <p><i class="fa-solid fa-location-dot icon"></i> <?php echo $ilan['ilan_il'] . ' / ' . $ilan['ilan_ilce'];?></p>
                                            </div>
                                            <div class="work-body-feature">
                                                <p>Yaş : <span class="age">  <?php echo $ilan['ilan_yas'];?></span></p>
                                                <p>İş Deneyimi :<span> <?php echo $ilan['ilan_calismazaman'];?></span></p>
                                                <p> Ücret :<span>  <?php echo $ilan['ilan_maas'];?> TL / Aylik</span></p>
                                            </div>
                                            <div class="work-body-text">
                                                <?php echo $ilan['ilan_aciklama'];?>
                                            </div>
                                            <p class="work-button"><a href="<?php echo base_url("front/advert/detail.php?id=" . $ilan['ilan_id']); ?>"><i class="fa-solid fa-magnifying-glass"></i> İncele</a></p>
                                        </div>                
                                    </div>
                                <?php endforeach; ?>
                                <a href="<?php echo base_url("front/advert/list.php"); ?>"><button class="work-mega-button"> Daha Fazla Görüntüle</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="section-title"><i class="fa-solid fa-file"></i>BAKICILAR </h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="babysitter">
                            <?php foreach($bakicilar as $bakici): ?>
                                <div class="row">
                                    <div class="sitter">
                                        <div class="col-lg-3">
                                           <a href="<?php echo base_url("front/sitters/detail.php?id=".$bakici['bakici_id']); ?>"><img src="<?php echo base_url('assets/image/sitter.jpg'); ?>" alt="" ></a>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="sitter-content">
                                                <div class="sitter-title">
                                                <a href="<?php echo base_url("front/sitters/detail.php?id=".$bakici['bakici_id']); ?>"><?php echo $bakici['bakici_ad'] .'  '. $bakici['bakici_soyad'];?></a>
                                                <span><i class="fa-regular fa-calendar" style="margin-right:10px;"></i><?php $bakici_tarih=$bakici['bakici_tarih'];  echo date('d.m.Y', strtotime($bakici_tarih)); ?></span>
                                                </div>
                                                <div class="sitter-navigation">
                                                    <p><i class="fa-solid fa-location-dot icon"></i><?php  echo $bakici['bakici_il'] . ' / ' . $bakici['bakici_ilce']; ?></p>
                                                </div>
                                                <div class="sitter-feature">
                                                    <p>Yaş : <span class="age"><?php echo $bakici['bakici_yas']; ?></span></p>
                                                    <p>İş Deneyimi :<span><?php echo $bakici['bakici_calismazaman']; ?></span></p>
                                                    <p> Hizmet Ücreti :<span><?php echo $bakici['bakici_maas']; ?>.000 TL / Aylik</span></p>
                                                </div>
                                                <div class="sitter-text">
                                                <?php echo $bakici['bakici_ozgecmis'];?>
                                                </div>
                                                <a href="<?php echo base_url("front/sitters/detail.php?id=".$bakici['bakici_id']); ?>">daha fazla göster...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           <?php endforeach; ?>
                           <a href="<?php echo base_url("front/sitters/list.php"); ?>"> <button class="sitter-button">Daha Fazla Görüntüle</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
<?php require_once ('front/body/footer.php'); ?>