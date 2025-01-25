<?php
 require_once(__DIR__ . '/../config/function.php'); 
 require_once(__DIR__ . '/../config/baglan.php');
 require_once(__DIR__ . '/../config/islem.php');
//session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAKICI / İLANLAR</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!--switalert2 cdn -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <div class="logobox">
                        <a href="<?php echo base_url('index.php'); ?>">
                          <img src="<?php echo base_url('assets/image/logo.jpg'); ?>" class="logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-11">
                    <?php if(isset($_SESSION['bakici_kullanici_id']) && !empty(($_SESSION['bakici_kullanici_id']))): ?>
                        <div class="nav-right">
                            <a href="<?php echo base_url("front/sitters/application.php?id=".$_SESSION['bakici_kullanici_id']);?>" style="color:#4a4a4a;">
                                <p class="bell">
                                        <i class="fa-regular fa-bell"></i>
                                        <span>
                                        <?php 
                                        $basvurular = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 2 AND basvurulan_id =:basvurulan_id");
                                        $basvurular -> execute(['basvurulan_id'=>$_SESSION['bakici_kullanici_id']]);
                                        $basvuru = $basvurular ->fetchAll(PDO::FETCH_ASSOC);
                                        echo count($basvuru);
                                        ?>
                                        </span>
                                </p>
                            </a>
                            <p class="loginbtn"><a href="<?php echo base_url("front/sitters/sitter.php");?>"><i class="fa-solid fa-user-large"></i> Hesabım</a></p>
                            <p class="loginbtn" id="bakici_login_cikis" name="bakici_login_cikis" value="1" style="color:#4A4A4A;"><i class="fa-solid fa-person-walking-arrow-right" style="margin-right:10px;"></i>ÇIKIŞ</p> 
                        </div>
                    <?php elseif(isset($_SESSION['ilan_kullanici_id']) && !empty(($_SESSION['ilan_kullanici_id']))):?>
                        <div class="nav-right">
                            <a href="<?php echo base_url("front/advert/application.php?id=".$_SESSION['ilan_kullanici_id']);?>" style="color:#4a4a4a;">
                            <p class="bell">
                                    <i class="fa-regular fa-bell"></i>
                                    <span>
                                    <?php 
                                    $basvurular = $db->prepare("SELECT * FROM basvuru WHERE basvuru_type = 1 AND basvurulan_id =:basvurulan_id");
                                    $basvurular -> execute(['basvurulan_id'=>$_SESSION['ilan_kullanici_id']]);
                                    $basvuru = $basvurular ->fetchAll(PDO::FETCH_ASSOC);
                                    echo count($basvuru);
                                    ?>
                                    </span>
                                </p>
                            </a>
                            <p class="loginbtn"><a href="<?php echo base_url("front/advert/advert.php");?>"><i class="fa-solid fa-user-large"></i> Hesabım</a></p>
                            <p class="loginbtn" id="ilan_login_cikis" name="ilan_login_cikis" value="1" style="color:#4A4A4A;"><i class="fa-solid fa-person-walking-arrow-right" style="margin-right:10px;"></i>ÇIKIŞ</p> 
                        </div>
                     <?php else: ?>
                    <div class="nav-right">
                        <p class="loginbtn"><a href="<?php echo base_url('front/sitters/login.php'); ?>"><i class="fa-solid fa-person-breastfeeding"></i> Bakıcı Giriş</a></p>
                        <p class="loginbtn" ><a href="<?php echo base_url('front/advert/login.php'); ?>"> <i class="fa-regular fa-address-card"></i>İlan Giriş</a></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <header class="menu-bg"style="margin-top:20px;"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="responsiv"><i class="fa-solid fa-bars"></i></span>
                    <div class="menu">
                        <ul>
                        <li><a href="<?php echo base_url('index.php'); ?>">ANASAYFA</a></li> 
                        <li><a href="<?php echo base_url('front/advert/list.php'); ?>">İLANLAR</a></li>   
                        <li><a href="<?php echo base_url('front/sitters/list.php'); ?>">BAKICILAR</a></li>   
                        <li><a href="">İLETİŞİM</a></li>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

