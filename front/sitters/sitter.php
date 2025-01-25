<?php 
require_once '../body/header.php';
ob_start();
//session_start();
?>
<main style="margin-bottom:100px;">
    <div class="container">
        <div class="row">
        <h4 class="welcome-title">HOŞGELDİNİZ  <i class="fa-solid fa-angle-right"></i> <?php  $büyük = strtoupper($_SESSION['bakici_kullanici_ad']);  echo $büyük ;?> <i class="fa-solid fa-angle-right"></i>  Başvuru No :
        <?php  echo $_SESSION['bakici_kullanici_id'];?> </h4>
            <div class="col-lg-12">
                <div class="mega-box-buttons">
                    <a href="http://localhost/proje/front/sitters/resume.php?bakicId=<?php echo $_SESSION['bakici_kullanici_id'];?>">
                        <div class="buttons">
                            <img src="<?php echo base_url("assets/image/cv-icon.png");?>"class="sitter-icons">
                            <p>ÖZGEÇMİŞ BİLGİLERİM </p>
                        </div>
                    </a>
                    <a href="http://localhost/proje/front/sitters/user.php?bakicId=<?php echo $_SESSION['bakici_kullanici_id'];?>">
                        <div class="buttons">
                            <img src="<?php echo base_url("assets/image/login-icon.png");?>"class="sitter-icons" >
                            <p> KULLANICI AYARLARI </p>
                        </div>
                    </a>
                    <a href="<?php echo base_url("front/advert/list.php");?>">
                        <div class="buttons">
                            <img src="<?php echo base_url("assets/image/list-icon.png");?>" class="sitter-icons">
                            <p>İŞ  İLANLAR</p>
                        </div>
                    </a>
                    <a href="http://localhost/proje/front/sitters/cart.php?id=<?php echo $_SESSION['bakici_kullanici_id'];?>">
                        <div class="buttons">
                           <img src="<?php echo base_url("assets/image/basket-icon.png");?>"class="sitter-icons">
                            <p> YAPTIĞIN BAŞVURULAR </p>
                        </div>
                    </a>
                    <a href="http://localhost/proje/front/sitters/application.php?id=<?php echo $_SESSION['bakici_kullanici_id'];?>">
                        <div class="buttons">
                           <img src="<?php echo base_url("assets/image/talep-icon.png");?>" class="sitter-icons">
                            <p>TALEPLER </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../body/footer.php';?>