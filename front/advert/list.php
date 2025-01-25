<?php  require_once '../body/header.php';

//session_start();

 $advertsor = $db->prepare('SELECT * FROM ilan');
 $advertsor->execute();
 $advertgetir = $advertsor->fetchAll(PDO::FETCH_ASSOC);




?>
<main style="margin-bottom:100px;margin-top:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <form action="" method="POST">
                    <input type="hidden" name="input_none" id="input_none">
                    <div class="list-category">
                        <div class="list-title">İŞ İLANLARI</div>
                        <div class="list-inputs">
                            <label for="semt">Semt</label>
                            <select class="form-select" aria-label="Default select example" name="ilan_il" id="ilan_il">
                                <option selected value="">Semt Seçiniz</option>
                                <option value="istanbul">İstanbul</option>
                                <option value="İzmir">İzmir</option>
                                <option value="Ankara">Ankara</option>
                                <option value="Bursa">Bursa</option>
                                <option value="Antalya">Antalya</option>
                                <option value="Trabzon">Trabzon</option>
                                <option value="Erzurum">Erzurum</option>
                                <option value="Çanakkale">Çanakkale</option>
                                <option value="Diyarbakir">Diyarbakir</option>
                                <option value="Kayseri">Kayseri</option>
                            </select>
                        </div>
                        <div class="list-inputs">
                            <label for="deneyim">İş Deneyimi</label>
                            <select class="form-select" aria-label="Default select example" name="ilan_deneyim" id="ilan_deneyim">
                                <option selected value="">Yıl Seçiniz</option>
                                <option value="1">1 yıl</option>
                                <option value="3">3 yıl</option>
                                <option value="5">5 yıl</option>
                                <option value="7">7 yıl</option>
                                <option value="10">10 yıl</option>
                            </select>
                        </div>
                        <div class="list-inputs">
                            <label for="calisma">Çalışma Şekli</label>
                            <select class="form-select" aria-label="Default select example"name="ilan_calismazaman" id="ilan_calismazaman">
                                <option selected value="">Zaman Seçiniz</option>
                                <option value="Parttime">Parttime</option>
                                <option value="Fulltime">Fulttime</option>
                            </select>
                        </div>
                        <div class="list-inputs">
                            <label for="maas"> Aylık Ücret</label>
                            <select class="form-select" aria-label="Default select example"name="ilan_maas" id="ilan_maas">
                                <option selected value="">Aralık Seçiniz</option>
                                <option value="17.000">17.000 TL</option>
                                <option value="20.000">20.000 TL</option>
                                <option value="30.000">30.000 TL</option>
                                <option value="40.000">40.000 TL</option>
                                <option value="50.000">50.000 TL</option>
                                <option value="60.000">60.000 TL</option>
                            </select>
                        </div>
                        <button class="filtbtn btn " type="button" id="ilan_filter_button" name="ilan_filter_button">Filtrele</button>
                    </div>
                </form>
            </div>
             <!--ilanların alanı -->
            <div class="col-lg-9 all">
            <?php foreach($advertgetir as $advert): ?>
                <div class="work" id="work" 
                    data-id="<?php echo $advert['ilan_id']; ?>" 
                    data-tarih="<?php echo $advert['ilan_tarih']; ?>" 
                    data-type="<?php echo $advert['ilan_type']; ?>" 
                    data-basvuran="<?php echo $_SESSION['bakici_kullanici_id']; ?>">
                    <div class="col-lg-3 ">
                        <a href="<?php echo base_url("front/advert/detail.php?id=".$advert['ilan_id']);?>">
                          <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="advert-list-img">
                        </a>
                    </div>
                    <div class="col-lg-9 ">
                      <div class="work-content"style="padding:24px;">
                        <?php if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])):?>
                        <div class="work-body-cart">
                            <p name="work_cart" id="work_cart" class="work_cart">
                                <i class="fa-solid fa-user-plus"></i>
                            </p>
                        </div>
                        <?php endif;?>
                        <div class="work-body-title">
                          <p><a href="<?php echo base_url("front/advert/detail.php?id=".$advert['ilan_id']);?>"><?php echo $advert['ilan_baslik']; ?></a></p>
                        </div>
                        <div class="work-body-navigation">
                            <i class="fa-solid fa-location-dot icon"></i>
                            <?php echo $advert['ilan_il']; ?> / <?php echo $advert['ilan_ilce']; ?>
                        </div>
                        <div class="work-body-feature">
                            <p>Çalışma Şekli <span class="age"><?php echo $advert['ilan_calismazaman']; ?></span></p>
                            <p>İş Deneyimi: <span><?php echo $advert['ilan_deneyim']; ?> YIL</span></p>
                            <p>Ücret: <span><?php echo $advert['ilan_maas']; ?></span></p>
                        </div>
                        <div class="work-body-text">
                        <a href="<?php echo base_url("front/advert/detail.php?id=".$advert['ilan_id']);?>"> <?php echo $advert['ilan_aciklama']; ?></a>
                        </div>
                        <span class="date"><i class="fa-regular fa-calendar" style="margin-right:10px;"></i> <?php $ilan_tarih=$advert['ilan_tarih'];  echo date('d.m.Y - H:i:s', strtotime($ilan_tarih)); ?></span>
                       </div>
                    </div>
                </div>
            <?php endforeach; ?>
                <p class="sitter-btn"><a href="#">Bir Sonraki Sayfa</a></p>
            </div>
        </div>
    </div>
</main>
<?php require_once '../body/footer.php';?>

