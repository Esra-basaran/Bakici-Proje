<?php  require_once '../body/header.php';?>
<section class="bg-color"style="padding-top:57px;padding-bottom:100px;">
    <div class="container"> 
        <div class="row">
          <div class="col-lg-5">
            <img src="<?php echo base_url('assets/image/exit.png'); ?>" alt="" class="w-100">
          </div>
          <div class="col-lg-7">
            <div class="exitbox">
                <h1>Yetkisiz Giriş !</h1>
                <h6>Bu Sayfayı Görüntülemeye Yetkiniz Bulunmamaktadır.</h6>
                <p class="backbtn" style="margin-top:200px;"><a href="<?php echo base_url('index.php'); ?>"> Anasayfaya Geri Dön  <i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
            </div>
          </div>      
        </div>
    </div>
</section>

<?php require_once '../body/footer.php';?>
