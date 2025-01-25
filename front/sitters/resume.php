<?php  require_once '../body/header.php';

if(isset($_GET['bakicId']) && !empty($_GET['bakicId'])){
    $bakicibilgisi = $db->prepare("SELECT * FROM bakici WHERE bakici_id =:bakici_all");
    $bakicibilgisi ->execute(['bakici_all'=> $_GET['bakicId']]);
    $bakicibilgi = $bakicibilgisi ->fetch(PDO::FETCH_ASSOC);

    $bakici_city = $bakicibilgi['bakici_il'];
    $bakici_egitim = $bakicibilgi['bakici_egitim'];
    $bakici_cinsiyet= $bakicibilgi['bakici_cinsiyet'];
    $bakici_calismazaman = $bakicibilgi['bakici_calismazaman'];
    $bakici_sigara = $bakicibilgi['bakici_sigara'];
    $bakici_ehliyet = $bakicibilgi['bakici_ehliyet'];
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
                        <li>Çocuk Bakıcısı İçin Özgeçmiş</li>
                    </ul>
                </div>
                <div class="detail-sitter">
                <!--FORM BAŞLANGIÇ KISMI -->
                    <form action="" method="post" id="sitter_update_form">
                        <div class="detail-sitter-header">
                            <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="detailimg">
                            <div class="detail-info">
                                <h6><input type="text" placeholder="Ad / Soyad Giriniz.." class="inputname" value="<?php echo $bakicibilgi['bakici_ad']; ?>" name="bupdate_ad"></h6>
                                <div class="detail-navigation">
                                    <i class="fa-solid fa-location-dot icon"></i>
                                    <select class="form-select" aria-label="Default select example" name="bupdate_il" >
                                        <option selected>İl Seçiniz</option>
                                        <option value="İstanbul" <?php if($bakici_city =='İstanbul') echo 'selected'; ?>>İstanbul</option>
                                        <option value="Ankara" <?php if($bakici_city =='Ankara') echo 'selected'; ?>>Ankara</option>
                                        <option value="İzmir" <?php if($bakici_city =='İzmir') echo 'selected'; ?>>İzmir</option>
                                        <option value="Bursa" <?php if($bakici_city =='Bursa') echo 'selected'; ?>>Bursa</option>
                                        <option value="Antalya" <?php if($bakici_city =='Antalya') echo 'selected'; ?>>Antalya</option>
                                        <option value="Trabzon" <?php if($bakici_city =='Trabzon') echo 'selected'; ?>>Trabzon</option>
                                        <option value="Erzurum" <?php if($bakici_city =='Erzurum') echo 'selected'; ?>>Erzurum</option>
                                        <option value="Çanakkale" <?php if($bakici_city =='Çanakkale') echo 'selected'; ?>>Çanakkale</option>
                                        <option value="Diyarbakır" <?php if($bakici_city =='Diyarbakır') echo 'selected'; ?>>Diyarbakır</option>
                                        <option value="Kayseri" <?php if($bakici_city =='Kayseri') echo 'selected'; ?>>Kayseri</option>
                                    </select>
                                    <input type="text"placeholder="İlçe Giriniz" value="<?php echo $bakicibilgi['bakici_ilce']; ?>" name="bupdate_ilce">
                                </div>
                                <div class="detail-select"style="gap:40px;flex-wrap:nowrap;">
                                    <p><span>Yaş : </span><input type="text" placeholder="Yaş Giriniz" value="<?php echo $bakicibilgi['bakici_yas']; ?>"name="bupdate_yas" ></p>
                                    <p><span>E-posta : </span> <input type="email" placeholder="E-posta Giriniz"  value="<?php echo $bakicibilgi['bakici_eposta']; ?>" name="bupdate_eposta"></p>
                                    <p><span>Telefon : </span><input type="tel" placeholder="Tel Giriniz" value="<?php echo $bakicibilgi['bakici_tel']; ?>" name="bupdate_tel"></p>
                                    <p><span>Kayıt Tarihi : </span> <input type="text" class="dateinput" value="<?php echo $bakicibilgi['bakici_tarih']; ?>" name="bupdate_tarih"></p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-sitter-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="detail-sitter-text">
                                        <h4> <i class="fa-solid fa-pen-to-square"></i>Hakkımda</h4>
                                        <div style="max-width:575px;margin-top:30px;display:block;"><textarea  id="editor" name="bupdate_ozgecmis" ><?php echo $bakicibilgi['bakici_ozgecmis']; ?></textarea></div>
                                    </div>
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-regular fa-rectangle-list"></i>Çocuk Bakıcısı Olarak Becerilerim</h4>
                                        <div style="max-width:575px;margin-top:30px;display:block;"><textarea id="editor2" name="bupdate_beceri"><?php echo $bakicibilgi['bakici_beceri']; ?></textarea></div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-solid fa-list-check"></i>Özet</h4>
                                        <div class="detail-sitter-summary">
                                            <p><span>Eğitim Durumu : </span> <input type="text" placeholder="Lise / Üniversite"  value="<?php echo $bakicibilgi['bakici_egitim']; ?>" name="bupdate_egitim"></p>
                                            <p><span>İş Deneyimi : </span> <input type="text" placeholder=" Kaç Yıl" value="<?php echo $bakicibilgi['bakici_deneyim']; ?> " name="bupdate_deneyim"></p>
                                            <p>
                                                <span>Cinsiyet :</span>
                                                <select class="form-select" aria-label="Default select example" name="bupdate_cinsiyet">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="Kadın" <?php if($bakici_cinsiyet =='Kadın') echo 'selected'; ?>>Kadın</option>
                                                    <option value="Erkek" <?php if($bakici_cinsiyet =='Erkek') echo 'selected'; ?>>Erkek</option>
                                                </select>
                                            </p>
                                            <p><span>Din : </span> <input type="text" placeholder="İnancı" value="<?php echo $bakicibilgi['bakici_din']; ?>" name="bupdate_din"></p>
                                            <p><span>Yabancı Diller : </span> <input type="text" placeholder="İngilizce / Almanca ..."  value="<?php echo $bakicibilgi['bakici_dil']; ?>" name="bupdate_dil"></p>
                                            <p>
                                                <span>Çalışma Şekli : </span>
                                                <select class="form-select" aria-label="Default select example" value="<?php echo $bakicibilgi['bakici_calismazaman']; ?>" name="bupdate_calismazaman">
                                                    <option selected value="" >Seçiniz</option>
                                                    <option value="Parttime" <?php if($bakici_calismazaman =='Parttime') echo 'selected'; ?>>Parttime</option>
                                                    <option value="Fulltime"<?php if($bakici_calismazaman =='Fulltime') echo 'selected'; ?>>Fulltime</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Sigara Kullanımı Var mı ? </span>
                                                <select class="form-select" aria-label="Default select example"name="bupdate_sigara">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="kullanıyor" <?php if($bakici_sigara =='Kullanıyor') echo 'selected' ?>>Evet</option>
                                                    <option value="kullanmiyor"<?php if($bakici_sigara =='Kullanmiyor') echo 'selected' ?>>Hayır</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Ehliyetiniz Var mı ? : </span>
                                                <select class="form-select" aria-label="Default select example" name="bupdate_ehliyet">
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="Var" <?php if($bakici_ehliyet == 'Var') echo 'selected' ?>>Evet</option>
                                                    <option value="Yok" <?php if($bakici_ehliyet == 'Yok') echo 'selected' ?>>Hayır</option>
                                                </select>
                                            </p>
                                            <p><span>Hizmet Ücreti : </span> <input type="text" placeholder="Maaş Fiyatı"  value="<?php echo $bakicibilgi['bakici_maas'];?>" name="bupdate_maas"></p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="bakici_id" value="<?php echo $bakicibilgi['bakici_id']; ?>">
                                    <button type="submit" name="sitters_update" class="detail-sitter-footer"> Güncelle</button>
                                    <a href="<?php echo base_url("front/sitters/sitter.php");?>" style="float:right;" class="input-backbtn"><i class="fa-solid fa-rotate-left"></i> Geri </a>
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
            .create(document.querySelector('#editor'), {
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
            .create(document.querySelector('#editor2'), {
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