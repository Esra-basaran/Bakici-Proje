<?php  require_once '../body/header.php';

//session_start();

$bakicisor =$db->prepare("SELECT * FROM bakici");
$bakicisor ->execute();
$bakicigetir =$bakicisor->fetchAll(PDO::FETCH_ASSOC);

?>

<main style="margin-bottom:100px;margin-top:50px;"> 
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-category">
                    <div class="list-title">BAKICI İLANLARI</div>
                    <form id="filter-form" method="post">
                        <div class="list-inputs">
                            <label for="semt">Semt</label>
                            <select class="form-select" aria-label="Default select example" name="list-city" id="list-city">
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
                           <label for="semt">İş Deneyimi</label>
                            <select class="form-select" aria-label="Default select example" name="list-yil" id="list-yil">
                                <option selected value="0">Yıl Seçiniz</option>
                                <option value="1 yıl">1 yıl</option>
                                <option value="3 yıl">3 yıl</option>
                                <option value="5 yıl">5 yıl</option>
                                <option value="7 yıl">7 yıl</option>
                                <option value="10 yıl">10 yıl</option>
                            </select>
                        </div>
                        <div class="list-inputs">
                           <label for="semt">Çalışma Şekli</label>
                            <select class="form-select" aria-label="Default select example"name="list-calisma" id="list-calismazaman">
                                <option selected value="0">Zaman Seçiniz</option>
                                <option value="Parttime">Parttime</option>
                                <option value="Fulltime">Fulltime</option>
                            </select>
                        </div>
                        <div class="list-inputs">
                           <label for="semt"> Aylık Ücret</label>
                            <select class="form-select" aria-label="Default select example"name="list-fiyat" id="list-fiyat">
                                <option selected value="0">Aralık Seçiniz</option>
                                <option value="17.000">17.000 TL</option>
                                <option value="20.000">20.000 TL</option>
                                <option value="30.000">30.000 TL</option>
                                <option value="40.000">40.000 TL</option>
                                <option value="50.000">50.000 TL</option>
                                <option value="60.000">60.000 TL</option>
                            </select>
                        </div>
                        <button class="filtbtn btn " type="button" id="filterButton">Filtrele</button>
                    </form> 
                </div>
            </div>
            <div class="col-lg-9">
                 <div class="sitters" id="sitter">
                 <?php foreach($bakicigetir as $bakici):?>
                    <div class="sitter" id="sitter" 
                        data-id="<?php echo $bakici['bakici_id'];?>"
                        data-tarih="<?php echo $bakici['bakici_tarih'];?>"
                        data-type="<?php echo $bakici['bakici_type'];?>"
                        data-basvuran="<?php echo $_SESSION['ilan_kullanici_id'];?>"
                        >
                            <div class="sitter-image">
                               <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bakici['bakici_id']);?>">
                                <img src="<?php echo base_url('assets/image/sitter.jpg'); ?>" alt="" class="sitterimg">
                               </a>
                            </div>
                            <div class="sitter-content"style="padding:0px 30px;">
                                <div class="sitter-title">
                                    <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bakici['bakici_id']);?>"><?php echo $bakici['bakici_ad']; ?></a>
                                <?php if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])):?>
                                    <p name="sitter_cart " id="sitter_cart" class="sitter_cart sitter_cartc" value="1"><i class="fa-solid fa-user-plus"></i></p>
                                <?php endif; ?>
                                </div>
                                <div class="sitter-navigation">
                                    <a href="#"> <i class="fa-solid fa-location-dot icon"></i> <?php echo $bakici['bakici_il']; ?>/ <?php echo $bakici['bakici_ilce']; ?></a>
                                </div>
                                <div class="sitter-feature">
                                    <p>Çalışma Şekli : <span class="age"><?php echo $bakici['bakici_calismazaman']; ?></span></p>
                                    <p>İş Deneyimi :<span><?php echo $bakici['bakici_deneyim']; ?> YIL</span></p>
                                    <p> Hizmet Ücreti :<span><?php echo $bakici['bakici_maas']; ?></span></p>
                                </div>
                                <div class="sitter-text">
                                    <?php echo $bakici['bakici_ozgecmis']; ?>
                                </div>
                                <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bakici['bakici_id']);?>">daha fazla göster...</a>
                                <span class="date"> <i class="fa-regular fa-calendar" style="margin-right:10px;"></i><?php $bakici_tarih=$bakici['bakici_tarih'];  echo date('d.m.Y', strtotime($bakici_tarih)); ?></span>
                            </div>
                    </div>
                 <?php endforeach;?>
                    <p class="sitter-btn"><a href="#">Bir Sonraki Sayfa</a></p>     
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once '../body/footer.php';?>

