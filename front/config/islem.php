<?php 
require_once 'baglan.php';
ob_start();
session_start(); 

 //HATA KODLARIM  
error_reporting(E_ALL);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//BAKICI SİGNUP VERİ KAYDETME
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["bakici_signup_giris"]) && !empty($_POST["bakici_signup_giris"])) {

    $bakici_ad=$_POST['bakici_ad'];
    $bakici_soyad=$_POST['bakici_soyad'];
    $bakici_eposta=$_POST['bakici_eposta'];
    $bakici_sifre=md5($_POST['bakici_sifre']);

    $bakici = $db->prepare("INSERT INTO bakici_login SET
        bakici_ad =:bakici_ad,
        bakici_soyad =:bakici_soyad,
        bakici_eposta =:bakici_eposta,
        bakici_sifre =:bakici_sifre
    ");
   
    $insert = $bakici->execute(array(
        'bakici_ad' =>$bakici_ad,
        'bakici_soyad' =>$bakici_soyad,
        'bakici_eposta' =>$bakici_eposta,
        'bakici_sifre' =>$bakici_sifre
    ));
} 

 //BAKICI LOGİN GİRİŞ-KONTROL
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bakici_login_giris']) && !empty($_POST['bakici_login_giris'])) {

    header('Content-Type: application/json'); 

    $blogin_ad =$_POST['blogin_ad'];
    $blogin_sifre =md5($_POST['blogin_sifre']);
    $guvenlikod =$_POST['guvenlikod'];

    $bakicilogin = $db->prepare("SELECT * FROM bakici_login WHERE bakici_ad =:blogin_ad AND bakici_sifre =:blogin_sifre");
    $bakicilogin ->execute(array(
    'blogin_ad' =>$blogin_ad,
    'blogin_sifre' =>$blogin_sifre
    ));

    $bakiciget = $bakicilogin->fetch(PDO::FETCH_ASSOC);

    if (isset($bakiciget) && !empty($bakiciget) && $guvenlikod == $_SESSION['guvenlikod']) {
        $_SESSION['bakici_kullanici_ad'] = $bakiciget['bakici_ad'];  // bilgileri oturumda sakla
        $_SESSION['bakici_kullanici_id'] = $bakiciget['bakici_id']; 


        echo json_encode(["success" => true, "message" => "Giriş Başarılı"]);
        exit;

      } else {
        echo json_encode(["success" => false, "message" => "Giriş İşlemi Başarısız !! "]);
        exit;
    }

}


//BAKICI KULLANICI BİLGİ GÜNCELLE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["buser-hidden"]) && !empty($_POST["buser-hidden"])) {
    date_default_timezone_set('Europe/Istanbul');
    $guncel_tarih = date('Y-m-d H:i:s');

    // şifrenin doluluk durumuna göre güncelleme
    if (!empty($_POST['buser_sifre'])) {
        $buser_kullanici = $db->prepare("UPDATE bakici_login SET bakici_ad = :buser_ad, bakici_soyad = :buser_soyad, bakici_sifre = :buser_sifre , bakici_tarih =:buser_tarih WHERE bakici_id = :buser_id");
        $buser_kullanici->execute([
            'buser_ad' => $_POST['buser_ad'],
            'buser_soyad' => $_POST['buser_soyad'],
            'buser_sifre' => md5($_POST['buser_sifre']),
            'buser_tarih' => $guncel_tarih,
            'buser_id' => $_POST['buser_id']
        ]);
    } else {
        $buser_kullanici = $db->prepare("UPDATE bakici_login SET bakici_ad = :buser_ad, bakici_soyad = :buser_soyad, bakici_tarih =:buser_tarih WHERE bakici_id = :buser_id");
        $buser_kullanici->execute([
            'buser_ad' => $_POST['buser_ad'],
            'buser_soyad' => $_POST['buser_soyad'],
            'buser_id' => $_POST['buser_id'],
            'buser_tarih' => $guncel_tarih,

        ]);
    }
}

// İLAN SİGNUP VERİ KAYDETME
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ilan_signup_giris"]) && !empty($_POST["ilan_signup_giris"])){

    $ilan_ad = $_POST['ilan_ad'];
    $ilan_soyad = $_POST['ilan_soyad'];
    $ilan_eposta = $_POST['ilan_eposta'];
    $ilan_sifre = md5($_POST['ilan_sifre']);

    $ilanekle=$db->prepare("INSERT INTO ilan_login SET
       ilan_ad =:ilan_ad, 
       ilan_soyad =:ilan_soyad,
       ilan_eposta =:ilan_eposta,
       ilan_sifre =:ilan_sifre
    ");
    $ilan = $ilanekle->execute(array(
    'ilan_ad' =>$ilan_ad,
    'ilan_soyad' =>$ilan_soyad,
    'ilan_eposta' =>$ilan_eposta,
    'ilan_sifre' =>$ilan_sifre
    ));

     if($ilan){
        echo"başarılı";

     }else{
        echo"basarısız";
     }
}

//İLAN LOGİN GİRİŞ-KONTROL 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ilan_login_hidden"]) && !empty($_POST["ilan_login_hidden"])){

    header('Content-Type: application/json'); 

    $kullanici_ad = $_POST['ilogin_ad'];
    $kullanici_sifre = md5($_POST['ilogin_sifre']);
    $icode = $_POST['icode'];  

    $ilanlogin = $db->prepare("SELECT * FROM ilan_login WHERE ilan_ad = :ilogin_ad AND ilan_sifre = :ilogin_sifre");
    $ilanlogin->execute(array(
        'ilogin_ad' => $kullanici_ad,
        'ilogin_sifre' => $kullanici_sifre
    ));

    $ilangiris = $ilanlogin->fetch(PDO::FETCH_ASSOC);

    if($ilangiris && $icode == $_SESSION['icode']){
        $_SESSION['ilan_kullanici_ad'] =$ilangiris['ilan_ad'];
        $_SESSION['ilan_kullanici_id'] =$ilangiris['ilan_id'];
        
        echo json_encode(["success" => true, "message" => "Giriş Başarılı"]);
        exit; 

    }else{
        echo json_encode(["success" => false, "message" => "Giriş İşlemi Başarısız !! "]);
        exit;
    }

 
}

//İLAN KULLANICI BİLGİ GÜNCELLE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["iuser-hidden"]) && !empty($_POST["iuser-hidden"])) {
    date_default_timezone_set('Europe/Istanbul');
    $guncel_tarih = date('Y-m-d H:i:s');


    // şifrenin doluluk durumuna göre güncelleme
    if (!empty($_POST['iuser_sifre'])) {
        $iuser_kullanici = $db->prepare("UPDATE ilan_login SET ilan_ad =:iuser_ad, ilan_soyad =:iuser_soyad, ilan_sifre =:iuser_sifre , ilan_tarih =:iuser_tarih WHERE ilan_id =:iuser_id");
        $iuser_kullanici->execute([
            'iuser_ad' => $_POST['iuser_ad'],
            'iuser_soyad' => $_POST['iuser_soyad'],
            'iuser_sifre' => md5($_POST['iuser_sifre']),
            'iuser_tarih' => $guncel_tarih,
            'iuser_id' => $_POST['iuser_id']
        ]);
    } else {
        $iuser_kullanici = $db->prepare("UPDATE ilan_login SET ilan_ad =:iuser_ad, ilan_soyad =:iuser_soyad, ilan_tarih =:iuser_tarih WHERE ilan_id = :iuser_id");
        $iuser_kullanici->execute([
            'iuser_ad' => $_POST['iuser_ad'],
            'iuser_soyad' => $_POST['iuser_soyad'],
            'iuser_id' => $_POST['iuser_id'],
            'iuser_tarih' => $guncel_tarih,

        ]);
    }
}
// İLAN TÜM BİLGİLERİ VERİ EKLEME
if(isset($_POST['advert_insert'])){
        $advertext = $db->prepare("INSERT INTO ilan SET
        ilan_baslik =:ilan_baslik,
        ilan_il =:ilan_il,
        ilan_ilce =:ilan_ilce,
        ilan_yas =:ilan_yas,
        ilan_eposta =:ilan_eposta,
        ilan_tel =:ilan_tel,
        ilan_isbasitarih =:ilan_isbasitarih,
        ilan_aciklama =:ilan_aciklama,
        ilan_beceri =:ilan_beceri,
        ilan_egitim =:ilan_egitim,
        ilan_deneyim =:ilan_deneyim,
        ilan_cinsiyet =:ilan_cinsiyet,
        ilan_din =:ilan_din,
        ilan_dil =:ilan_dil,
        ilan_calismazaman =:ilan_calismazaman,
        ilan_ehliyet =:ilan_ehliyet,
        ilan_sigara =:ilan_sigara,
        ilan_maas =:ilan_maas
        ");
        $advertinsert = $advertext->execute(array(
        'ilan_baslik' => $_POST['ilan_baslik'],
        'ilan_il' => $_POST['ilan_il'],
        'ilan_ilce' => $_POST['ilan_ilce'],
        'ilan_yas' => $_POST['ilan_yas'],
        'ilan_eposta' => $_POST['ilan_eposta'],
        'ilan_tel' => $_POST['ilan_tel'],
        'ilan_isbasitarih' => $_POST['ilan_isbasitarih'],
        'ilan_aciklama' => $_POST['ilan_aciklama'],
        'ilan_beceri' => $_POST['ilan_beceri'],
        'ilan_egitim' => $_POST['ilan_egitim'],
        'ilan_deneyim' => $_POST['ilan_deneyim'],
        'ilan_cinsiyet' => $_POST['ilan_cinsiyet'],
        'ilan_din' => $_POST['ilan_din'],
        'ilan_dil' => $_POST['ilan_dil'],
        'ilan_calismazaman' => $_POST['ilan_calismazaman'],
        'ilan_ehliyet' => $_POST['ilan_ehliyet'],
        'ilan_sigara' => $_POST['ilan_sigara'],
        'ilan_maas' => $_POST['ilan_maas']
        ));
        if($advertinsert){
            Header("location:../advert/success.php");
            exit;
        }else{
            echo"olucak";
        }
}

//BAKICI TÜM BİLGİLERİ VERİ EKLEME
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["bakici_insert_hidden"])&& !empty($_POST["bakici_insert_hidden"])){

    $bakici_add = $db->prepare("INSERT INTO bakici SET
    bakici_ad =:bakici_ad,
    bakici_il =:bakici_il,
    bakici_ilce =:bakici_ilce,
    bakici_yas =:bakici_yas,
    bakici_eposta =:bakici_eposta,
    bakici_tel =:bakici_tel,
    bakici_ozgecmis =:bakici_ozgecmis,
    bakici_beceri =:bakici_beceri,
    bakici_egitim =:bakici_egitim,
    bakici_deneyim =:bakici_deneyim,
    bakici_cinsiyet =:bakici_cinsiyet,
    bakici_din =:bakici_din,
    bakici_dil =:bakici_dil,
    bakici_calismazaman =:bakici_calismazaman,
    bakici_ehliyet =:bakici_ehliyet,
    bakici_sigara =:bakici_sigara,
    bakici_maas =:bakici_maas
    ");

    $binsert= $bakici_add->execute(array(
    'bakici_ad' => $_POST['bakici_ad'],
    'bakici_il' => $_POST['bakici_il'],
    'bakici_ilce' =>  $_POST['bakici_ilce'],
    'bakici_yas' => $_POST['bakici_yas'],
    'bakici_eposta' => $_POST['bakici_eposta'],
    'bakici_tel' => $_POST['bakici_tel'],
    'bakici_ozgecmis' => $_POST['bakici_ozgecmis'],
    'bakici_beceri' => $_POST['bakici_beceri'],
    'bakici_egitim' => $_POST['bakici_egitim'],
    'bakici_deneyim' => $_POST['bakici_deneyim'],
    'bakici_cinsiyet' => $_POST['bakici_cinsiyet'],
    'bakici_din' => $_POST['bakici_din'],
    'bakici_dil' => $_POST['bakici_dil'],
    'bakici_calismazaman' => $_POST['bakici_calismazaman'],
    'bakici_ehliyet' => $_POST['bakici_ehliyet'],
    'bakici_sigara' => $_POST['bakici_sigara'],
    'bakici_maas' => $_POST['bakici_maas']
    ));
   
  

}




// BAKICI FİLTRELEME KISMI
if($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST["bakici_filtre"]) && !empty($_POST["bakici_filtre"])) {
    $listeli_city = isset($_POST['list-city']) ? $_POST['list-city'] : '';
    $listeli_yil = isset($_POST['list-yil']) ? $_POST['list-yil'] : '';
    $listeli_calismazaman = isset($_POST['list-calismazaman']) ? $_POST['list-calismazaman'] : '';
    $listeli_fiyat = isset($_POST['list-fiyat']) ? $_POST['list-fiyat'] : '';

    $query = "SELECT * FROM bakici WHERE "; 
    $params = [];

    // Şehir filtresi
    if ($listeli_city) {
        $queryStr[] = "bakici_il = :bakici_il";
        $params['bakici_il'] = $listeli_city;
    }
    // Deneyim yılı filtresi
    if ($listeli_yil) {
        $queryStr[] = "bakici_deneyim = :bakici_deneyim";
        $params['bakici_deneyim'] = $listeli_yil;
    }
    // Çalışma şekli filtresi
    if ($listeli_calismazaman) {
        $queryStr[] = "bakici_calismazaman = :bakici_calismazaman";
        $params['bakici_calismazaman'] = $listeli_calismazaman;
    }
    // Ücret filtresi
    if ($listeli_fiyat) {
        $queryStr[] = "bakici_maas = :bakici_maas";
        $params['bakici_maas'] = $listeli_fiyat;
    }
    $butun = implode(" AND ", $queryStr);

    // Sorgu
    $query = $db->prepare($query . $butun);
    $query->execute($params);
    $bakicilar = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($bakicilar) {
        foreach ($bakicilar as $bakici) {
            echo '<div class="sitter" id="sitter" data-id="'. $bakici['bakici_id']. '" data-tarih="'.$bakici['bakici_tarih'].'" data-type="'.$bakici['bakici_type'].'" data-basvuran=" '.$_SESSION['ilan_kullanici_id'].'" >';
            echo '<div class="sitter-image">';
            echo '<a href="http://localhost/proje/front/sitters/detail.php?id=' . $bakici['bakici_id'] . '">';
            echo '<img src="http://localhost/proje/assets/image/sitter.jpg" alt="" class="sitterimg">';
            echo '</a>';
            echo '</div>';
            echo '<div class="sitter-content" style="padding:0px 30px;">';
            echo '<div class="sitter-title">';
            echo '<a href="http://localhost/proje/front/sitters/detail.php?id=' . $bakici['bakici_id'] . '">';
            echo $bakici['bakici_ad'];
            echo '</a>';
            if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])):
            echo '<p class="sitter_cart sitter_cartc" >';
            echo '<i class="fa-solid fa-user-plus"></i>';
            echo '</p>';
            endif;
            echo '</div>';
            echo '<div class="sitter-navigation">';
            echo '<a href="#"><i class="fa-solid fa-location-dot icon"></i> ' . $bakici['bakici_il'] . ' / ' . $bakici['bakici_ilce'] . '</a>';
            echo '</div>';
            echo '<div class="sitter-feature">';
            echo '<p>Çalışma Şekli: <span class="age">' . $bakici['bakici_calismazaman'] . '</span></p>';
            echo '<p>İş Deneyimi :<span>' . $bakici['bakici_deneyim'] . ' YIL </span></p>';
            echo '<p>Hizmet Ücreti :<span>' . $bakici['bakici_maas'] . '</span></p>';
            echo '</div>';
            echo '<div class="sitter-text">';
            echo $bakici['bakici_ozgecmis'];
            echo '</div>';
            echo '<a href="http://localhost/proje/front/sitters/detail.php?id=' . $bakici['bakici_id'] . '">daha fazla göster...</a>';
            echo '<span class="date"> <i class="fa-regular fa-calendar" style="margin-right:10px;"></i> '. $bakici_tarih=$bakici['bakici_tarih']; date('d.m.Y', strtotime($bakici_tarih)) . '</span>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Filtrelere uygun bakıcı bulunamadı.";
    }
}

//İLAN FİLTELEME KISMI
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["inputnone"]) && !empty($_POST["inputnone"])){

    $semtsor = isset($_POST['ilan_il']) ? $_POST['ilan_il'] : '';
    $yilsor = isset($_POST['ilan_deneyim']) ? $_POST['ilan_deneyim'] : '';
    $calismasor = isset($_POST['ilan_calismazaman']) ? $_POST['ilan_calismazaman'] : '';
    $maassor = isset($_POST['ilan_maas']) ? $_POST['ilan_maas'] : '';

    $sorgu = "SELECT * FROM ilan WHERE ";
    $dizi = [];

    if($semtsor){
        $sor[] = "ilan_il = :ilan_il";
        $dizi['ilan_il'] = $semtsor;
    }
    if($yilsor){
        $sor[] ="ilan_deneyim = :ilan_deneyim";
        $dizi['ilan_deneyim'] = $yilsor;
    }

    if($calismasor){
        $sor[] ="ilan_calismazaman = :ilan_calismazaman";
        $dizi['ilan_calismazaman'] = $calismasor;
    }

    if($maassor){
        $sor[] ="ilan_maas = :ilan_maas";
        $dizi['ilan_maas'] = $maassor;
    }

    $hepsi = implode(" AND ", $sor);

    $sorgula = $db->prepare($sorgu . $hepsi);
    $sorgula->execute($dizi);
    $ilangetir = $sorgula->fetchAll(PDO::FETCH_ASSOC);

    if($ilangetir){
        foreach($ilangetir as $ilan){
            echo '<div class="work" id="work" data-id=" ' . $ilan['ilan_id'] . ' "  data-tarih=" ' . $ilan['ilan_tarih'] . ' "  data-type=" ' . $ilan['ilan_type'] . ' "  data-basvuran=" ' . $_SESSION['bakici_kullanici_id'] . ' ">';
            echo '<div class="col-lg-3">';
            echo '<a href="http://localhost/proje/front/advert/detail.php?id=' . $ilan['ilan_id'].'"><img src="http://localhost/proje/assets/image/advertdetail.jpg" class="advert-list-img"></a>';
            echo '</div>';
            echo '<div class="col-lg-9">';  
            echo '<div class="work-content" style="padding:24px;">';
            if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])):
            echo '<div class="work-body-cart">';
            echo '<p name="work_cart" id="work_cart"  class="work_cart">';
            echo '<i class="fa-solid fa-user-plus"></i>';
            echo '</p>';
            echo '</div>';   
            endif;       
            echo '<div class="work-body-title">';
            echo '<p><a href="http://localhost/proje/front/advert/detail.php?id=' . $ilan['ilan_id'].'"> '.$ilan['ilan_baslik'] . '</a></p>';               
            echo '</div>';
            echo '<div class="work-body-navigation">';
            echo '<i class="fa-solid fa-location-dot icon"></i>' . $ilan['ilan_il'] .' / ' . $ilan['ilan_ilce'];
            echo '</div>';
            echo '<div class="work-body-feature">';
            echo '<p>Çalışma Şekli :<span class="age">' . $ilan['ilan_calismazaman'] . '</span></p>';
            echo '<p>İş Deneyimi :<span>' . $ilan['ilan_deneyim'] . ' YIL </span></p>';
            echo '<p> Ücret :<span>' . $ilan['ilan_maas'] . '</span></p>';
            echo '</div>';
            echo '<div class="work-body-text">';
            echo '<a href="http://localhost/proje/front/advert/detail.php?id=' . $ilan['ilan_id'].'">';
            echo $ilan['ilan_aciklama'];
            echo '</a>';
            echo '</div>';
            echo ' <span class="date"><i class="fa-regular fa-calendar" style="margin-right:10px;"></i>'.$ilan_tarih=$ilan['ilan_tarih'];  date('d.m.Y - H:i:s', strtotime($ilan_tarih)) .'</span>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
    }else{
        echo "Filtrelemeye Uygun İlan Bulunamadı";
    }


}




//BAKICI VERİ UPDATE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["bakici_id"]) && !empty($_POST["bakici_id"])){

    header('Content-Type: application/json; charset=utf-8');

   $bakici_update =$db->prepare("UPDATE bakici SET
    bakici_ad =:bupdate_ad,
    bakici_il =:bupdate_il,
    bakici_ilce =:bupdate_ilce,
    bakici_yas =:bupdate_yas,
    bakici_eposta =:bupdate_eposta,
    bakici_tel =:bupdate_tel,
    bakici_ozgecmis =:bupdate_ozgecmis,
    bakici_beceri =:bupdate_beceri,
    bakici_egitim =:bupdate_egitim,
    bakici_deneyim =:bupdate_deneyim,
    bakici_cinsiyet =:bupdate_cinsiyet,
    bakici_din =:bupdate_din,
    bakici_dil =:bupdate_dil,
    bakici_calismazaman =:bupdate_calismazaman,
    bakici_ehliyet =:bupdate_ehliyet,
    bakici_sigara =:bupdate_sigara,
    bakici_maas =:bupdate_maas
    WHERE bakici_id =:bupdate_bakiciid
    ");
     
    $bupdate = $bakici_update->execute(array(
    'bupdate_ad' =>$_POST['bupdate_ad'],
    'bupdate_il' =>$_POST['bupdate_il'],
    'bupdate_ilce' =>$_POST['bupdate_ilce'],
    'bupdate_yas' =>$_POST['bupdate_yas'],
    'bupdate_eposta' =>$_POST['bupdate_eposta'],
    'bupdate_tel' =>$_POST['bupdate_tel'],
    'bupdate_ozgecmis' =>$_POST['bupdate_ozgecmis'],
    'bupdate_beceri' =>$_POST['bupdate_beceri'],
    'bupdate_egitim' =>$_POST['bupdate_egitim'],
    'bupdate_deneyim' =>$_POST['bupdate_deneyim'],
    'bupdate_cinsiyet' =>$_POST['bupdate_cinsiyet'],
    'bupdate_din' =>$_POST['bupdate_din'],
    'bupdate_dil' =>$_POST['bupdate_dil'],
    'bupdate_calismazaman' =>$_POST['bupdate_calismazaman'],
    'bupdate_ehliyet' =>$_POST['bupdate_ehliyet'],
    'bupdate_sigara' =>$_POST['bupdate_sigara'],
    'bupdate_maas' =>$_POST['bupdate_maas'],
    'bupdate_bakiciid' =>$_POST['bakici_id']
    ));

    $ornek = "Örnek metin burada yer almaktadır.";

    if($bupdate){
        echo json_encode(array("status" => true, "message" => $ornek));
    }else{
        echo json_encode(array("status" => false, "message" => "Teknik hata oluştu!"));
    }
}

//İLAN VERİ UPDATE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ilan_id"]) && !empty($_POST["ilan_id"])){

    header('Content-Type: application/json; charset=utf-8');

    $ilan_update = $db->prepare("UPDATE ilan SET 
        ilan_baslik =:iupdate_baslik,
        ilan_il =:iupdate_il,
        ilan_ilce =:iupdate_ilce,
        ilan_yas =:iupdate_yas,
        ilan_cinsiyet =:iupdate_cinsiyet,
        ilan_deneyim =:iupdate_deneyim,
        ilan_eposta =:iupdate_eposta,
        ilan_tel =:iupdate_tel,
        ilan_isbasitarih =:iupdate_isbasitarih,
        ilan_aciklama =:iupdate_aciklama,
        ilan_beceri =:iupdate_beceri,
        ilan_egitim =:iupdate_egitim,
        ilan_dil =:iupdate_dil,
        ilan_din =:iupdate_din,
        ilan_calismazaman =:iupdate_calismazaman,
        ilan_sigara =:iupdate_sigara,
        ilan_ehliyet =:iupdate_ehliyet,
        ilan_maas =:iupdate_maas 
        WHERE ilan_id =:ilan_id
    ");

    $iupdate = $ilan_update->execute(array(
        'iupdate_baslik' =>$_POST['iupdate_baslik'],
        'iupdate_il' =>$_POST['iupdate_il'],
        'iupdate_ilce' =>$_POST['iupdate_ilce'],
        'iupdate_yas' =>$_POST['iupdate_yas'],
        'iupdate_cinsiyet' =>$_POST['iupdate_cinsiyet'],
        'iupdate_deneyim' =>$_POST['iupdate_deneyim'],
        'iupdate_eposta' =>$_POST['iupdate_eposta'],
        'iupdate_tel' =>$_POST['iupdate_tel'],
        'iupdate_isbasitarih' =>$_POST['iupdate_isbasitarih'],
        'iupdate_aciklama' =>$_POST['iupdate_aciklama'],
        'iupdate_beceri' =>$_POST['iupdate_beceri'],
        'iupdate_egitim' =>$_POST['iupdate_egitim'],
        'iupdate_dil' =>$_POST['iupdate_dil'],
        'iupdate_din' =>$_POST['iupdate_din'],
        'iupdate_calismazaman' =>$_POST['iupdate_calismazaman'],
        'iupdate_sigara' =>$_POST['iupdate_sigara'],
        'iupdate_ehliyet' =>$_POST['iupdate_ehliyet'],
        'iupdate_maas' =>$_POST['iupdate_maas'],
        'ilan_id'=>$_POST['ilan_id']
    ));

    if($iupdate) {
        echo json_encode(array('success' => true, 'message' => 'İlan başarıyla güncellendi'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Güncelleme işlemi başarısız'));
    }



}



//BAKICI KISMINDAKİ İLAN BASVURU SEPETİ
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ilan_cart_id']) && !empty($_POST['ilan_cart_id'])) {

    header('Content-Type: application/json'); 

    $ilan_id = $_POST['ilan_cart_id']; 
    $basvuran_id = $_SESSION['bakici_kullanici_id']; // Kullanıcı ID

    // Kullanıcıya özel session'da basvuru_ilan anahtarı oluştur
    if (!isset($_SESSION['basvuru_ilan'][$basvuran_id])) {
        $_SESSION['basvuru_ilan'][$basvuran_id] = [];
    }

    $ilan_var = false;

     // Kullanıcının kendi ilan sepetinde o ilan var mı kontrol et
     foreach ($_SESSION['basvuru_ilan'][$basvuran_id] as $ilan) {
        if ($ilan['ilan_id'] == $ilan_id) {
            $ilan_var = true;
            break;
        }
    }
        // İlan sepette yoksa ekle, varsa hata mesajı gönder
    if (!$ilan_var) {
        $_SESSION['basvuru_ilan'][$basvuran_id][] = [
            'ilan_id' => $ilan_id,
        ];
        $basvuru_ilan = $db ->prepare("INSERT INTO basvuru SET 
            basvurulan_id =:ilan_cart_id,
            basvuru_tarih =:ilan_tarih,
            basvuru_type =:ilan_type,
            basvuran_id =:basvuran_id
            ");
         
         $basvuru = $basvuru_ilan ->execute(array(
             'ilan_cart_id'=> $_POST['ilan_cart_id'],
             'ilan_tarih'=> $_POST['ilan_tarih'],
             'ilan_type'=> $_POST['ilan_type'],
             'basvuran_id'=> $_POST['basvuran_id']
         )); 

        echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/sitters/cart.php?id=$ilan_id"]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Bu ilan zaten sepete eklenmiş.']);
    }
    exit;

    echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/sitters/cart.php?id=$ilan_id"]);
    exit;

} 

//İLAN KISMINDAKİ BAKİCİ BASVURU SEPETİ
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["bakici_ekle"]) && !empty($_POST["bakici_ekle"])){

    header('Content-Type: application/json'); 

    $card_id = $_POST['bakici_ekle'];
    $bakici_tarih = $_POST['bakici_tarih'];
    $bakici_type = $_POST['bakici_type'];
    $basvuran_id = $_SESSION['ilan_kullanici_id'];

    if(!isset($_SESSION['basvuru_bakici'][$basvuran_id])){
        $_SESSION['basvuru_bakici'][$basvuran_id] =[];
    }

   $bakici_var = false;
   foreach($_SESSION['basvuru_bakici'][$basvuran_id] as $basvuru){
        if($basvuru['bakici_id'] == $card_id){
            $bakici_var = true;
            break;
        }
   }

   if(!$bakici_var){
    $_SESSION['basvuru_bakici'][$basvuran_id][]=[
        'bakici_id' => $card_id,
    ];
    $basvuru_bakici = $db ->prepare("INSERT INTO basvuru SET 
    basvurulan_id =:bakici_ekle,
    basvuru_tarih =:bakici_tarih,
    basvuru_type =:bakici_type,
    basvuran_id =:basvuran_id
    ");
 
    $basvuru = $basvuru_bakici ->execute(array(
     'bakici_ekle'=> $_POST['bakici_ekle'],
     'bakici_tarih'=> $_POST['bakici_tarih'],
     'bakici_type'=> $_POST['bakici_type'],
     'basvuran_id'=> $_POST['basvuran_id']
    )); 

    echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/advert/cart.php?id=$card_id"]);
    
   }else {
    echo json_encode(['status' => 'error', 'message' => 'Bu Bakici Zaten Sepete Eklenmiş.']);
  }
    exit;
   echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/advert/cart.php?id=$card_id"]);
    exit;
} 



// DETAİL KISMINDAN (BAKICI VE İLAN ) BASVURU SEPETİ EKLE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idetail_cart']) && !empty($_POST['idetail_cart'])) {

    header('Content-Type: application/json'); 

    $ilan_id = $_POST['idetail_cart']; 
    $basvuran_id = $_POST['basvuran_id'];

    //bakıcı kısmından girildiğindeki advert-detail kısmı 
    if(isset($_SESSION['bakici_kullanici_id'])){
        
        if (!isset($_SESSION['basvuru_ilan'][$basvuran_id])) {
            $_SESSION['basvuru_ilan'][$basvuran_id] = [];
        }
        $ilan_var = false;
        // Kullanıcının kendi ilan sepetinde o ilan var mı kontrol et
        foreach ($_SESSION['basvuru_ilan'][$basvuran_id] as $ilan) {
            if ($ilan['ilan_id'] == $ilan_id) {
                $ilan_var = true;
                break;
            }
        }
            // İlan sepette yoksa ekle, varsa hata mesajı gönder
        if (!$ilan_var) {
            $_SESSION['basvuru_ilan'][$basvuran_id][] = [
                'ilan_id' => $ilan_id,
            ];
            $basvuru_ilan = $db ->prepare("INSERT INTO basvuru SET 
                basvurulan_id =:idetail_cart,
                basvuru_tarih =:idetail_tarih,
                basvuru_type =:idetail_type,
                basvuran_id =:basvuran_id
                ");
            
            $basvuru = $basvuru_ilan ->execute(array(
                'idetail_cart'=> $_POST['idetail_cart'],
                'idetail_tarih'=> $_POST['idetail_tarih'],
                'idetail_type'=> $_POST['idetail_type'],
                'basvuran_id'=> $basvuran_id
            )); 

            echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/sitters/cart.php?id=$ilan_id"]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Bu ilan zaten sepete eklenmiş.']);
            exit;
        }

    
     //ilan kısmından girildiğindeki sitter-detail kısmı 
    }else if(isset($_SESSION['ilan_kullanici_id'])){
                 // ilan kısmı
        if (!isset($_SESSION['basvuru_bakici'][$basvuran_id])) {
            $_SESSION['basvuru_bakici'][$basvuran_id] = [];
        }
        $ilan_var = false;

        // Kullanıcının kendi ilan sepetinde o ilan var mı kontrol et
        foreach ($_SESSION['basvuru_bakici'][$basvuran_id] as $bakici) {
            if ($bakici['bakici_id'] == $basvuran_id) {
                $ilan_var = true;
                break;
            }
        }
            if (!$ilan_var) {
                $_SESSION['basvuru_bakici'][$basvuran_id][] = [
                    'bakici_id' => $ilan_id,
                ];
                $basvuru_ilan = $db ->prepare("INSERT INTO basvuru SET 
                    basvurulan_id =:idetail_cart,
                    basvuru_tarih =:idetail_tarih,
                    basvuru_type =:idetail_type,
                    basvuran_id =:basvuran_id
                    ");
                
                $basvuru = $basvuru_ilan ->execute(array(
                    'idetail_cart'=> $_POST['idetail_cart'],
                    'idetail_tarih'=> $_POST['idetail_tarih'],
                    'idetail_type'=> $_POST['idetail_type'],
                    'basvuran_id'=> $basvuran_id
                )); 

                echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/advert/cart.php?id=$ilan_id"]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Bu ilan zaten sepete eklenmiş.']);
                exit;
            }
    }
     
    exit;

    echo json_encode(['status' => 'success', 'message' => "http://localhost/proje/front/sitters/cart.php?id=$ilan_id"]);
    exit;

} 













//BAKICI KISMINDAKİ İLAN SİLME KISMI
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_sil']) && !empty($_POST['cart_sil'])) {

    header('Content-Type: application/json'); 
    $ilan_id = $_POST['cart_sil']; 

    // Oturum açan kullanıcının ID'sini kontrol et
    if (isset($_SESSION['bakici_kullanici_id'])) {

        $kullanici_id = $_SESSION['bakici_kullanici_id'];

        if (isset($_SESSION['basvuru_ilan'][$kullanici_id])) {
            foreach ($_SESSION['basvuru_ilan'][$kullanici_id] as $key => $basvuru) { 
                if ($basvuru['ilan_id'] == $ilan_id) { 
                    // Session'dan silme işlemi
                    unset($_SESSION['basvuru_ilan'][$kullanici_id][$key]); 
                    
                    // Veritabanından silme işlemi
                    $basvuru_ilan_sil = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 1 AND basvurulan_id = :basvurulan_id AND basvuran_id = :basvuran_id");
                    $basvuru_ilan_sil->execute([
                        'basvurulan_id' => $ilan_id,
                        'basvuran_id' => $kullanici_id
                    ]);

                    echo json_encode([ "status" => true, "message" => "Başvuru başarıyla silindi."]);
                    exit;
                }
            }
        }
    } else {
        echo json_encode([ "status" => false, "message" => "Başvuru SİLİNEMEDİ!"]);
    }
    exit;
}

//İLAN  KISMINDAKİ BAKICI SİLME KISMI
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bakici_sil']) && !empty($_POST['bakici_sil'])) {

    header('Content-Type: application/json'); 
    $bakici_id = $_POST['bakici_sil']; 

    if (isset($_SESSION['ilan_kullanici_id'])) {
        $kullanici_id = $_SESSION['ilan_kullanici_id'];

    if (isset($_SESSION['basvuru_bakici'][$kullanici_id])){
        foreach ($_SESSION['basvuru_bakici'][$kullanici_id] as $key => $basvuru) {
            
            if ($basvuru['bakici_id'] == $bakici_id) {
                //sessiondan silme işlemi
                unset($_SESSION['basvuru_bakici'][$kullanici_id][$key]); 
                //veritabanından silme işlemi
                $basvuru_bakici_sil = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 2 AND  basvurulan_id =:basvurulan_id AND basvuran_id = :basvuran_id");
                $basvuru_bakici = $basvuru_bakici_sil->execute([
                    'basvurulan_id' =>$bakici_id,
                    'basvuran_id' =>$kullanici_id,                
                   ]); 
                echo json_encode([ "status" => true, "message" => "Başvuru başarıyla silindi."]);
                exit;
            }
          }
        }
    } else {
        echo json_encode([ "status" => false, "message" => "Başvuru SİLİNEMEDİ!"]);
    }
    exit;
}




//BAKICI ÇIKIS SESSİON KISMI 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["bakici_login_cikis"]) && !empty($_POST["bakici_login_cikis"]) ){

    header('Content-Type: application/json');
    
    unset($_SESSION['bakici_kullanici_ad']);
    unset($_SESSION['bakici_kullanici_id']);
    
    echo json_encode([
        "status" => true,
        "message" => "http://localhost/proje/index.php"
    ]);
   
} 

//İLAN ÇIKIŞ SESSİON KISMI
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ilan_login_cikis"]) && !empty($_POST["ilan_login_cikis"]) ){

    header('Content-Type: application/json');
    
    unset($_SESSION['ilan_kullanici_ad']);
    unset($_SESSION['ilan_kullanici_id']);
    
    echo json_encode([
        "status" => true,
        "message" => "http://localhost/proje/index.php"
    ]);
   
} 




   // BAKICI APPLİCATİON SİLME KISMI(APPLİCATİON SEPETİNDEN - DETAİL SAYFASINDAN SİLME ) İŞLEMİ ;

//talep kutusundan silme kısmı
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["app_sil"]) && !empty($_POST["app_sil"])) {
    header('Content-Type: application/json'); 
    $gelen_app = $_POST['app_sil'];

    if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])) {
       
        $kullanici_id = $_SESSION['bakici_kullanici_id'];

        if(isset($_SESSION['basvuru_bakici'][$gelen_app])) {
            foreach($_SESSION['basvuru_bakici'][$gelen_app] as $key => $gelen) {
                if ($gelen['bakici_id'] == $kullanici_id) {
                    // Session'dan silme işlemi
                        unset($_SESSION['basvuru_bakici'][$gelen_app][$key]);
                    //veritabaından silme işlemi
                        $appbasvuru = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 2 AND basvuran_id = :basvuran_id AND basvurulan_id = :basvurulan_id");
                        $appbasvuru->execute([
                            'basvuran_id' => $gelen_app,
                            'basvurulan_id' => $kullanici_id
                        ]);
                    echo json_encode(["status" => true, "message" => "Talep başarıyla silindi."]);
                    exit;
                }
            }
        }else {
            echo json_encode(["status" => false, "message" => "Başvuru kaydı bulunamadı!"]);
            exit;
        }
    } else {
        echo json_encode(["status" => false, "message" => "Oturum bilgisi bulunamadı!"]);
    }
    exit;
//detail kısmından talep silme kısmı
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["app_detail_sil"]) && !empty($_POST["app_detail_sil"])) {
    header('Content-Type: application/json'); 
    $detail_app = $_POST['app_detail_sil'];

    if(isset($_SESSION['bakici_kullanici_id']) && !empty($_SESSION['bakici_kullanici_id'])) {
       
        $kullanici_id = $_SESSION['bakici_kullanici_id'];

        if(isset($_SESSION['basvuru_bakici'][$detail_app])) {       
            foreach($_SESSION['basvuru_bakici'][$detail_app] as $key => $gelen) {
                if ($gelen['bakici_id'] == $kullanici_id) {
                    // Session'dan silme işlemi
                        unset($_SESSION['basvuru_bakici'][$detail_app][$key]);
                    //veritabaından silme işlemi
                        $appbasvuru = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 2 AND basvuran_id = :basvuran_id AND basvurulan_id = :basvurulan_id");
                        $appbasvuru->execute([
                            'basvuran_id' => $detail_app,
                            'basvurulan_id' => $kullanici_id
                        ]);
                    echo json_encode(["status" => true, "message" => "Talep başarıyla silindi."]);
                    exit;
                }
            }
        }else {
           echo json_encode(["status" => false, "message" => "Başvuru kaydı bulunamadı!"]);
            exit;
        }
    } else {
        echo json_encode(["status" => false, "message" => "Oturum bilgisi bulunamadı!"]);
    }
    exit;   
}




    //İLAN APPLİCATİON SİLME KISMI (APPLİCATİON SEPETİNDEN - DETAİL SAYFASINDAN SİLME ) İŞLEMİ ; 

 //talep kutusundan silme kısmı
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["i_app_sil"]) && !empty($_POST["i_app_sil"])) {

    header('Content-Type: application/json'); 
    $gelen_app = $_POST['i_app_sil'];

    if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])) {

        $kullanici_id = $_SESSION['ilan_kullanici_id'];
        if(isset($_SESSION['basvuru_ilan'][$gelen_app])) {
            
            foreach($_SESSION['basvuru_ilan'][$gelen_app] as $key => $gelen) {

                if ($gelen['ilan_id'] == $kullanici_id) {
                    // Session'dan silme işlemi
                        unset($_SESSION['basvuru_ilan'][$gelen_app][$key]);
                    //veritabaından silme işlemi
                        $appbasvuru = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 1 AND basvuran_id = :basvuran_id AND basvurulan_id = :basvurulan_id");
                        $appbasvuru->execute([
                            'basvuran_id' => $gelen_app,
                            'basvurulan_id' => $kullanici_id
                        ]);
                    echo json_encode(["status" => true, "message" => "Talep başarıyla silindi."]);
                    exit;
                }
            }
        }else {
            echo json_encode(["status" => false, "message" => "Başvuru kaydı bulunamadı!"]);
            exit;
        }
    } else {
        echo json_encode(["status" => false, "message" => "Oturum bilgisi bulunamadı!"]);
    }
    exit;
//detail kısmından talep silme kısmı
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["i_app_detail_sil"]) && !empty($_POST["i_app_detail_sil"])) {
    header('Content-Type: application/json'); 
    $detail_app = $_POST['i_app_detail_sil'];

   if(isset($_SESSION['ilan_kullanici_id']) && !empty($_SESSION['ilan_kullanici_id'])) {
      
    $kullanici_id = $_SESSION['ilan_kullanici_id'];

        // Eğer başvuru ilanları oturumda varsa
        if(isset($_SESSION['basvuru_ilan'][$detail_app])) {    
            foreach($_SESSION['basvuru_ilan'][$detail_app] as $key => $gelen) {
                if ($gelen['ilan_id'] == $kullanici_id) {
                    // Session'dan silme işlemi
                        unset($_SESSION['basvuru_ilan'][$detail_app][$key]);
                    //veritabaından silme işlemi
                        $appbasvuru = $db->prepare("DELETE FROM basvuru WHERE basvuru_type = 1 AND basvuran_id = :basvuran_id AND basvurulan_id = :basvurulan_id");
                        $appbasvuru->execute([
                            'basvuran_id' => $detail_app,
                            'basvurulan_id' => $kullanici_id
                        ]);
                    echo json_encode(["status" => true, "message" => "Talep başarıyla silindi."]);
                    exit;
                }
            }
        }else {
            echo json_encode(["status" => false, "message" => "Başvuru kaydı bulunamadı!"]);
            exit;
        }
    } else {
    echo json_encode(["status" => false, "message" => "Oturum bilgisi bulunamadı!"]);
    }
   exit;
}







?>











