<?php  require_once '../body/header.php';

session_start();
if(isset($_GET['id'])){
    $basvuran_id = $_SESSION['ilan_kullanici_id']; 
    $basvurular = isset($_SESSION['basvuru_bakici'][$basvuran_id]) ? $_SESSION['basvuru_bakici'][$basvuran_id]:[];
}

$basvuru_goster = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 1 AND basvurulan_id =:basvurulan_id ");
$basvuru_goster ->execute(['basvurulan_id'=>$basvuran_id]);
$basvuranlar = $basvuru_goster->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])): ?>
<main style="margin-bottom:170px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10"style="margin:auto;">
                    <div class="ilan-cart">
                        <h2>Size Gelen İş ilanları</h2>
                        <hr>
                        <br>
                        <div class="row">
                        <?php foreach($basvuranlar as $basvuran): ?>
                            <?php  
                             $basvuran_bilgi = $db->prepare("SELECT * FROM bakici WHERE bakici_id =:bakici_id");
                             $basvuran_bilgi ->execute(['bakici_id'=>$basvuran['basvuran_id']]);
                             $bilgiler = $basvuran_bilgi->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php foreach($bilgiler as $bilgi ):?>
                                <div class="alert alert-primary" style="margin-left:auto;margin-right:auto;width:80%;">
                            <strong>Bilgi ! </strong>
                            İş Başvurusu Tekliflerinizi 24 saat içinde onaylamazsanız otomatik iptal edilecektir.
                        </div> 
                            <div class="sitter" id="app_sitter" data-id="<?php echo $bilgi['bakici_id'];?>" style="margin-left:auto;margin-right:auto;width:80%;padding:30px;">
                            <div class="col-lg-2">
                                <div class="sitter-image" >
                                <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bilgi['bakici_id']);?>">
                                    <img src="<?php echo base_url('assets/image/sitter.jpg'); ?>" alt=""style="width:100%;" >
                                </a>
                                </div>
                              </div>
                              <div class="col-lg-10">
                                <div class="sitter-content"style="padding-left:25px;position:relative;">
                                <span class= "iapp_clean cart_cleancss" value="<?php echo $ilan['ilan_id']; ?>"><i class="fa-regular fa-circle-xmark"></i></span>
                                <span class="iapp_check okBtn" style="left:86%;"><i class="fa-regular fa-circle-check"></i></span>
                                    <div class="sitter-title">
                                    <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bilgi['bakici_id']);?>">
                                        <?php echo $bilgi['bakici_ad']; ?>
                                    </a>
                                    </div>
                                    <div class="sitter-navigation">
                                         <i class="fa-solid fa-location-dot icon"></i> <?php echo $bilgi['bakici_il']; ?>/ <?php echo $bilgi['bakici_ilce']; ?>
                                    </div>
                                    <div class="sitter-feature">
                                        <p>Çalışma Şekli : <span class="age"><?php echo $bilgi['bakici_calismazaman']; ?></span></p>
                                        <p>İş Deneyimi :<span><?php echo $bilgi['bakici_deneyim']; ?> YIL</span></p>
                                        <p> Hizmet Ücreti :<span><?php echo $bilgi['bakici_maas']; ?></span></p>
                                    </div>
                                    <div class="sitter-text">
                                        <?php echo $bilgi['bakici_ozgecmis']; ?>
                                    </div>
                                    <a href="<?php  echo base_url("front/sitters/detail.php?id=". $bilgi['bakici_id']);?>">daha fazla göster...</a>  
                                </div>
                              </div>   
                            </div>
                            <?php endforeach;?>
                        <?php endforeach;?> 
                      <?php if(empty($basvuranlar)): ?>
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
        </div>
    </main>
<?php else: ?>
    <p>GİRİŞ YAPMALISINZ !</p>
<?php endif; ?>
<?php  require_once '../body/footer.php';?>
