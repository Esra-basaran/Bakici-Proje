<?php  require_once '../body/header.php';?>

<section style="margin-top:50px;margin-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-megadiv">
                    <form action="" method="POST" id="bakici_form" name="bakici_form">
                        <img src="<?php echo base_url('assets/image/sitterlogin.jpg'); ?> " alt="">
                        <h5>Bakıcı Kayıt Ol</h5>
                        <div class="alert alert-success" id="positif">İşlem Başarılı</div>
                        <div class="alert alert-danger" id="negatif">işlem Başarısız</div>
                        <div class="login-inputs">
                            <input type="text" placeholder="Adınızı Giriniz" name="bakici_ad" required="">
                        </div>
                        <div class="login-inputs">
                            <input type="text" placeholder="Soyadınızı Giriniz"name="bakici_soyad" required="">
                        </div>
                        <div class="login-inputs">
                            <input type="eposta" placeholder="E-posta Giriniz"name="bakici_eposta" required="">
                        </div>
                        <div class="login-inputs">
                            <input type="password" placeholder="Şifre Giriniz"name="bakici_sifre" required="">
                        </div>
                        <input type="hidden" name="bakici_signup_giris" value="1" id="bakici_giris">
                        <button class="sitterloginbtn" type="button" name="bakici_signup" id="bakici_signup">Giriş Yap</button>
                        <div class="login-inputs">
                        <a href="login.php">Giriş için Tıklayınız <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../body/footer.php';?>