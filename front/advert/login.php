<?php  require_once '../body/header.php';
ob_start();
//session_start();

?>
<section style="margin-top:50px;margin-bottom:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               <form action="" method="post" id="ilan_giris_form">
                    <div class="login-megadiv">
                        <img src="<?php echo base_url('assets/image/advert2.jpg'); ?>" alt="">
                        <h5>İlan Girişi</h5>
                        <div class="login-inputs">
                            <input type="text" placeholder="Kullanıcı Adı Giriniz ..." name="ilogin_ad" id="ilogin_ad">
                        </div>
                        <div class="login-inputs">
                            <input type="password" placeholder="Şifre Giriniz ..."name="ilogin_sifre"id="ilogin_sifre">
                        </div>
                        <div class="login-inputs">
                            <label for="icode" class="guveninput">
                            <?php  
                                $security =substr(md5(microtime()),rand(0,9),5);
                                $_SESSION['icode'] = $security;
                                 echo $security;
                                ?>
                            </label>
                            <input type="text" placeholder="Güvenlik Kodunu Giriniz..." name="icode" id="icode"style="padding-left:80px;">
                        </div>
                        <input type="hidden" name="ilan_login_hidden" value="1">
                        <button class="sitterloginbtn" name="ilan_girisbtn"  id="ilan_girisbtn">Giriş Yap</button>
                        <div class="login-inputs">
                            <a href="signup.php">Kayıt Olmak İçin  <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>
                    </div>     
              </form>
            </div>
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>