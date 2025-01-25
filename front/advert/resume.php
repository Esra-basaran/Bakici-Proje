<?php  require_once '../body/header.php';

session_start();

 if(isset($_GET['ilanId']) && !empty( $_GET['ilanId'])){

    $ilanbilgiler = $db->prepare("SELECT * FROM ilan WHERE ilan_id =:ilan_all ");
    $ilanbilgiler ->execute(['ilan_all' => $_GET['ilanId']]);
    $ilan = $ilanbilgiler->fetch(PDO::FETCH_ASSOC);

    $ilan_city =$ilan['ilan_il'];
    $ilan_cinsiyet=$ilan['ilan_cinsiyet'];
    $ilan_calismazaman=$ilan['ilan_calismazaman'];
    $ilan_sigara=$ilan['ilan_sigara'];
    $ilan_ehliyet=$ilan['ilan_ehliyet'];
     
 }
?>
<style>
 /* jquery takvim */
 .ui-datepicker { background-color: white;border:1px solid #f0f0f4;font-size: 13px;padding:10px;}
 .ui-state-default {color: black; }
 .ui-state-default:hover {color:blue;font-weight:500;}
 /*ck editor */
 .ck-editor__editable {height:200px;}
</style>
<section class="bg-color"style="padding-top:57px;padding-bottom:100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="detail-title">
                    <ul>
                        <li>Anasayfa <i class="fa-solid fa-angle-right"></i></li>
                        <li>Çocuk Bakıcısı İlan Bilgileri </li>
                    </ul>
                </div>
                <div class="detail-sitter">
            <!--FORM BAŞLANGIÇ KISMI -->
                    <form action="" method="post" id="advert_update_form">
                        <div class="detail-sitter-header">
                            <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="detailimg">
                            <div class="detail-info">
                                <h6><input type="text" placeholder="İlan Başlığı Giriniz.."value="<?php echo $ilan['ilan_baslik']; ?>" class="inputitle" name="iupdate_baslik"></h6>
                                <div class="detail-navigation">
                                    <i class="fa-solid fa-location-dot icon"></i>
                                    <select class="form-select" aria-label="Default select example" name="iupdate_il">
                                        <option selected>İl Seçiniz</option>
                                        <option value="İstanbul" <?php if($ilan_city =='İstanbul') echo 'selected'; ?>>İstanbul</option>
                                        <option value="Ankara"<?php if($ilan_city =='Ankara') echo 'selected'; ?>>Ankara</option>
                                        <option value="İzmir"<?php if($ilan_city =='İzmir') echo 'selected'; ?>>İzmir</option>
                                        <option value="Bursa"<?php if($ilan_city =='Bursa') echo 'selected'; ?>>Bursa</option>
                                        <option value="Antalya"<?php if($ilan_city =='Antalya') echo 'selected'; ?>>Antalya</option>
                                        <option value="Trabzon"<?php if($ilan_city =='Trabzon') echo 'selected'; ?>>Trabzon</option>
                                        <option value="Erzurum"<?php if($ilan_city =='Erzurum') echo 'selected'; ?>>Erzurum</option>
                                        <option value="Çanakkale"<?php if($ilan_city =='Çanakkale') echo 'selected'; ?>>Çanakkale</option>
                                        <option value="Diyarbakır"<?php if($ilan_city =='Diyarbakır') echo 'selected'; ?>>Diyarbakır</option>
                                        <option value="Kayseri"<?php if($ilan_city =='Kayseri') echo 'selected'; ?>>Kayseri</option>
                                    </select>
                                    <input type="text"placeholder="İlçe Giriniz" name="iupdate_ilce" value="<?php echo $ilan['ilan_ilce']; ?>">
                                </div>
                                <div class="detail-select"style="gap:40px;flex-wrap:nowrap;">
                                    <p><span>Yaş : </span><input type="text" placeholder="Yaş Giriniz"name="iupdate_yas" value="<?php echo $ilan['ilan_yas']; ?>"></p>
                                    <p><span>E-posta : </span> <input type="email" placeholder="E-posta Giriniz" name="iupdate_eposta" value="<?php echo $ilan['ilan_eposta']; ?>"></p>
                                    <p><span>Telefon : </span><input type="tel" placeholder="Tel Giriniz"name="iupdate_tel" value="<?php echo $ilan['ilan_tel']; ?>"></p>
                                    <p><span>Kayıt Tarihi : </span> <input type="text" class="dateinput"name="iupdate_tarih" value="<?php echo $ilan['ilan_tarih']; ?>"></p>
                                    <p><span>Başlama Tarihi :</span><input type="text" class="dateinput"name="iupdate_isbasitarih" value="<?php echo $ilan['ilan_isbasitarih']; ?>"></p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-sitter-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="detail-sitter-text">
                                        <h4> <i class="fa-solid fa-pen-to-square"></i>Açıklama</h4>
                                        <div style="margin-top:30px;"><textarea name="iupdate_aciklama" id="editorilan" ><?php echo $ilan['ilan_aciklama']; ?></textarea></div>
                                    </div>
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-regular fa-rectangle-list"></i>Çocuk Bakıcısı Olarak Becerilerim</h4>
                                        <div style="margin-top:30px;"><textarea name="iupdate_beceri" id="editorilan1"><?php echo $ilan['ilan_beceri']; ?></textarea></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-solid fa-list-check"></i>Özet</h4>
                                        <div class="detail-sitter-summary">
                                        <p><span>Eğitim Durumu : </span> <input type="text" placeholder="Lise / Üniversite" class="col-input" name="iupdate_egitim" value="<?php echo $ilan['ilan_egitim']; ?>"></p>
                                        <p><span>İş Deneyimi : </span> <input type="text" placeholder=" Kaç Yıl" class="col-input" name="iupdate_deneyim" value="<?php echo $ilan['ilan_deneyim']; ?>"></p>
                                            <p>
                                            <span>Cinsiyet :</span>
                                            <select class="form-select" aria-label="Default select example" name="iupdate_cinsiyet" class="col-input">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="Kadın" <?php if($ilan_cinsiyet =='Kadın') echo 'selected'; ?>>Kadın</option>
                                                    <option value="Erkek" <?php if($ilan_cinsiyet =='Erkek') echo 'selected'; ?>>Erkek</option>
                                                </select>
                                            </p>
                                            <p><span>Din : </span> <input type="text" placeholder="İnancı" class="col-input" name="iupdate_din" value="<?php echo $ilan['ilan_din']; ?>"></p>
                                            <p><span>Yabancı Diller : </span> <input type="text" placeholder="İngilizce / Almanca ..." class="" name="iupdate_dil" value="<?php echo $ilan['ilan_dil']; ?>"></p>
                                            <p>
                                                <span>Çalışma Şekli : </span>
                                                <select class="form-select" aria-label="Default select example" name="iupdate_calismazaman">
                                                    <option selected value="" >Seçiniz</option>
                                                    <option value="Parttime" <?php if($ilan_calismazaman =='Parttime') echo 'selected'; ?>>Parttime</option>
                                                    <option value="Fulltime" <?php if($ilan_calisazaman =='Fulltime') echo 'selected'; ?>>Fulltime</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Sigara Kullanımı Var mı ? </span>
                                                <select class="form-select" aria-label="Default select example" name="iupdate_sigara">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="kullanıyor" <?php if($ilan_sigara =='Kullanıyor') echo'selected'; ?>>Kullaniyor</option>
                                                    <option value="kullanmiyor"<?php if($ilan_sigara =='Kullanmiyor') echo'selected'; ?>>Kullanmiyor</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Ehliyetiniz Var mı ? : </span>
                                                <select class="form-select" aria-label="Default select example" name="iupdate_ehliyet">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="Var" <?php if($ilan_ehliyet =='Var') echo 'selected'; ?>>Var</option>
                                                    <option value="Yok" <?php if($ilan_ehliyet =='Yok') echo 'selected'; ?>>Yok</option>
                                                </select>
                                            </p>
                                            <p><span>Hizmet Ücreti : </span> <input type="text" placeholder="Maaş Fiyatı" class="" name="iupdate_maas" value="<?php echo $ilan['ilan_maas']; ?>"></p>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $ilan['ilan_id']; ?>" name="ilan_id">
                                    <button type="submit" name="advert_update_button" class="detail-sitter-footer "> İlanı Güncelle </button>
                                    <a href="<?php echo base_url("front/advert/advert.php");?>" style="float:right;" class="input-backbtn"><i class="fa-solid fa-rotate-left"></i> Geri </a>
                                </div>
                            </div>
                        </div>
                    </form>
         <!--FORM BİTİŞ KISMI -->
                </div>
            </div>   
        </div>
    </div>
</section>
<?php require_once '../body/footer.php';?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

<!-- CK EDİTÖR JS KODLARI-->
<script>
    // 1.editör scriptleri
        ClassicEditor
            .create(document.querySelector('#editorilan'), {
                // Özelleştirilmiş toolbar
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', '|',
                        'undo', 'redo', '|',
                        'imageUpload', 'mediaEmbed'
                    ]
                },
                // Resim yükleme seçenekleri
                ckfinder: {
                    uploadUrl: '/path/to/upload/image', // Sunucu tarafında resim yükleme URL'i
                },
                language: 'tr', // Türkçe dil desteği
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .then(editor => {
                console.log('Editor yüklendi:', editor);
            })
            .catch(error => {
                console.error('Bir hata oluştu:', error);
            });

    // 2.editör scriptleri
            ClassicEditor
            .create(document.querySelector('#editorilan1'), {
                // Özelleştirilmiş toolbar
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', '|',
                        'undo', 'redo', '|',
                        'imageUpload', 'mediaEmbed'
                    ]
                },
                // Resim yükleme seçenekleri
                ckfinder: {
                    uploadUrl: '/path/to/upload/image', // Sunucu tarafında resim yükleme URL'i
                },
                language: 'tr', // Türkçe dil desteği
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .then(editor => {
                console.log('Editor yüklendi:', editor);
            })
            .catch(error => {
                console.error('Bir hata oluştu:', error);
            });
</script>