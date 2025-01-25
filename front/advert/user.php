<?php  require_once '../body/header.php';

if(isset($_GET['id']) && !empty($_GET['id'])){

    $ilanbilgisi = $db->prepare("SELECT * FROM ilan WHERE ilan_id =:ilan_all");
    $ilanbilgisi ->execute(['ilan_all'=> $_GET['id']]);
    $ilanbilgi = $ilanbilgisi ->fetch(PDO::FETCH_ASSOC);

    $i_user_bilgi  = $db->prepare("SELECT * FROM ilan_login WHERE ilan_id =:ilan_id");
    $i_user_bilgi ->execute(['ilan_id'=> $_GET['id']]);
    $i_user = $i_user_bilgi->fetch(PDO::FETCH_ASSOC);
}
?>

<section class="bg-color"style="padding-top:57px;padding-bottom:100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="detail-title">
                    <ul>
                        <li>Anasayfa <i class="fa-solid fa-angle-right"></i></li>
                        <li>İlan <i class="fa-solid fa-angle-right"></i></li>
                        <li>Kullanıcı Bilgileri</li>
                    </ul>
                </div>
                <div class="detail-sitter" style="margin-left:auto;margin-right:auto;margin-top:56px;height:87%;box-shadow:rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <form action="" method="post" id="iuser-form">
                       <h4 style="margin-bottom:30px;">Kullanıcı Bilgilerim</h4>
                        <div class="input-megabox">
                            <div class="user-inputbox">
                                <label for=""> Ad :</label>
                                <input type="text" class="user-input"  name="iuser_ad" value="<?php echo $i_user['ilan_ad'];?>">
                            </div>
                            <div class="user-inputbox">
                                <label for="">Soyad :</label>
                                <input type="text" class="user-input" name="iuser_soyad" value="<?php echo $i_user['ilan_soyad'];?>">
                            </div>
                        </div>
                        <div class="input-megabox">
                            <div class="user-inputbox">
                                <label for="">E-Posta Adresi :</label>
                                <input type="email" class="user-input" value="<?php echo $i_user['ilan_eposta'];?>"  disabled> 
                            </div>
                            <div class="user-inputbox">
                                <label for="">Şifre :</label>
                                <input type="password" class="user-input" name="iuser_sifre" >
                            </div>
                        </div>
                        <button class="user-inputbox-btn" type="submit" id="iuser-guncelle" value="1"><i class="fa-regular fa-floppy-disk"></i> Güncelle</button>
                        <a href="<?php echo base_url("front/advert/advert.php");?>" class="input-backbtn"><i class="fa-solid fa-rotate-left"></i> Geri </a>
                        <span class="input-date"><i class="fa-regular fa-calendar" style="margin-right:10px;"></i>
                            <?php $ilan_tarih = $i_user['ilan_tarih']; echo date('d.m.Y - H:i:s', strtotime($ilan_tarih)); ?></span>
                        <input type="hidden" name="iuser-hidden" value="2">
                        <input type="hidden" name="iuser_id" value="<?php echo $i_user['ilan_id']; ?>"> 
                        <input type="hidden" name="iuser_tarih" value=" <?php echo $i_user['ilan_tarih']; ?>">
                    </form>  
                </div>
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>