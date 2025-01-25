<?php  require_once '../body/header.php';
ob_start();
//session_start();
?>
<section style="margin-top:50px;margin-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-megadiv">
                    <form action="" method="POST" id="bakici_girisform">
                        <img src="<?php echo base_url('assets/image/sitterlogin.jpg'); ?>" >
                        <h5>Bakıcı Girişi</h5>
                        <div class="login-inputs">
                            <input type="text" placeholder="Kullanıcı Adı Giriniz ..." name="blogin_ad">
                        </div>
                        <div class="login-inputs">
                            <input type="password" placeholder="Şifre Giriniz ..."name="blogin_sifre">
                        </div>
                        <div class="login-inputs">
                            <label for="guvenlikod" class="guveninput">
                                <?php 
                                $guven=substr(md5(microtime()),rand(0,9),5);
                                $_SESSION['guvenlikod'] = $guven;
                                 echo $guven;
                                 ?>
                            </label>
                            <input type="text" placeholder="Güvenlik Kodunu Giriniz... " name="guvenlikod" id="guvenlikod"style="padding-left:80px;">
                        </div>
                        <input type="hidden" name="bakici_login_giris" value="1">
                        <button class="sitterloginbtn" type="submit" name="bakici_login" id="bakici_login">Giriş Yap</button>
                    </form>
                    <div class="login-inputs">
                        <a href="signup.php">Kayıt Olmak İçin<i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>
