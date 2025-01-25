<?php  require_once '../body/header.php';?>
<section style="margin-top:50px;margin-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-megadiv">
                    <form action="" method="POST" id="iloginform">
                        <img src="<?php echo base_url('assets/image/advert2.jpg'); ?>" alt="">
                        <h5>İlanlar İçin Kayıt Ol</h5>
                        <div class="alert alert-success" id="positif">İşlem Başarılır</div>
                        <div class="alert alert-danger" id="negatif">işlem Başarısız</div>
                        <div class="login-inputs">
                            <input type="text" placeholder="Adınızı Giriniz" name="ilan_ad"  id="ilan_ad">
                        </div>
                        <div class="login-inputs">
                            <input type="text" placeholder="Soyadınızı Giriniz"name="ilan_soyad" id="ilan_soyad">
                        </div>
                        <div class="login-inputs">
                            <input type="eposta" placeholder="E-posta Giriniz"name="ilan_eposta" id="ilan_eposta">
                        </div>
                        <div class="login-inputs">
                            <input type="password" placeholder="Şifre Giriniz" name="ilan_sifre" id="ilan_sifre">
                        </div>
                        <input type="hidden"name="ilan_signup_giris" value="1">
                        <button class="sitterloginbtn" type="button" name="ilanloginbtn" id="ilanloginbtn">Üye Ol</button>
                    </form>
                    <div class="login-inputs">
                       <a href="login.php">Giriş Yapmak İçin <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>