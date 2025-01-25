<?php  require_once '../body/header.php';

if(isset($_GET['bakicId']) && !empty($_GET['bakicId'])){
    $bakicibilgisi = $db->prepare("SELECT * FROM bakici WHERE bakici_id =:bakici_all");
    $bakicibilgisi ->execute(['bakici_all'=> $_GET['bakicId']]);
    $bakicibilgi = $bakicibilgisi ->fetch(PDO::FETCH_ASSOC);

    $b_user_bilgi  = $db->prepare("SELECT * FROM bakici_login WHERE bakici_id =:bakici_id");
    $b_user_bilgi ->execute(['bakici_id'=> $_GET['bakicId']]);
    $b_user = $b_user_bilgi->fetch(PDO::FETCH_ASSOC);
}
?>
<section class="bg-color"style="padding-top:57px;padding-bottom:100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="detail-title">
                    <ul>
                        <li>Anasayfa <i class="fa-solid fa-angle-right"></i></li>
                        <li>Bakıcı <i class="fa-solid fa-angle-right"></i></li>
                        <li>Kullanıcı Bilgileri</li>
                    </ul>
                </div>
                <div class="detail-sitter" style="margin-left:auto;margin-right:auto;margin-top:56px;height:87%;box-shadow:rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <form action="" method="post" id="buser-form">
                       <h4 style="margin-bottom:30px;">Kullanıcı Bilgilerim</h4>
                        <div class="input-megabox">
                            <div class="user-inputbox">
                                <label for=""> Ad :</label>
                                <input type="text" class="user-input"  name="buser_ad" value="<?php echo $b_user['bakici_ad'];?>">
                            </div>
                            <div class="user-inputbox">
                                <label for="">Soyad :</label>
                                <input type="text" class="user-input" name="buser_soyad" value="<?php echo $b_user['bakici_soyad'];?>">
                            </div>
                        </div>
                        <div class="input-megabox">
                            <div class="user-inputbox">
                                <label for="">E-Posta Adresi :</label>
                                <input type="email" class="user-input" value="<?php echo $b_user['bakici_eposta'];?>"  disabled> 
                            </div>
                            <div class="user-inputbox">
                                <label for="">Şifre :</label>
                                <input type="password" class="user-input" name="buser_sifre" >
                            </div>
                        </div>
                        <button class="user-inputbox-btn" type="submit" id="buser-guncelle" value="1"><i class="fa-regular fa-floppy-disk"></i> Güncelle</button>
                        <a href="<?php echo base_url("front/sitters/sitter.php");?>" class="input-backbtn"><i class="fa-solid fa-rotate-left"></i> Geri </a>
                        <span class="input-date"><i class="fa-regular fa-calendar" style="margin-right:10px;"></i> <?php $bakici_tarih=$b_user['bakici_tarih'];   echo date('d.m.Y - H:i:s', strtotime($bakici_tarih)); ?></span>
                        <input type="hidden" name="buser-hidden" value="2">
                        <input type="hidden" name="buser_id" value="<?php echo $b_user['bakici_id']; ?>"> 
                        <input type="hidden" name="buser_tarih" value=" <?php echo $b_user['bakici_tarih']; ?>">
                    </form>  
                </div>
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>