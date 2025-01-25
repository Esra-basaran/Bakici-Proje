<?php  require_once '../body/header.php';?>
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
                        <li>Çocuk Bakıcısı İş İlanları </li>
                    </ul>
                </div>
                <div class="detail-sitter">
            <!--FORM BAŞLANGIÇ KISMI -->
                    <form action="<?php echo base_url('front/config/islem.php');?>" method="POST" id="advert-text-form">
                        <div class="detail-sitter-header">
                            <img src="<?php echo base_url('assets/image/advertdetail.jpg'); ?>" class="detailimg">
                            <div class="detail-info">
                                <h6><input type="text" placeholder="İlan Başlığı Giriniz.." class="inputitle" name="ilan_baslik"required></h6>
                                <div class="detail-navigation">
                                    <i class="fa-solid fa-location-dot icon"></i>
                                    <select class="form-select" aria-label="Default select example" name="ilan_il"required>
                                        <option selected>İl Seçiniz</option>
                                        <option value="İstanbul">İstanbul</option>
                                        <option value="Ankara">Ankara</option>
                                        <option value="İzmir">İzmir</option>
                                        <option value="Bursa">Bursa</option>
                                        <option value="Antalya">Antalya</option>
                                        <option value="Trabzon">Trabzon</option>
                                        <option value="Erzurum">Erzurum</option>
                                        <option value="Çanakkale">Çanakkale</option>
                                        <option value="Diyarbakır">Diyarbakır</option>
                                        <option value="Kayseri">Kayseri</option>
                                    </select>
                                    <input type="text"placeholder="İlçe Giriniz" name="ilan_ilce" required>
                                </div>
                                <div class="detail-select"style="gap:40px;flex-wrap:nowrap;">
                                    <p><span>Yaş : </span><input type="text" placeholder="Yaş Giriniz"name="ilan_yas"required></p>
                                    <p><span>E-posta : </span> <input type="email" placeholder="E-posta Giriniz" name="ilan_eposta"required></p>
                                    <p><span>Telefon : </span><input type="tel" placeholder="Tel Giriniz"name="ilan_tel"required></p>
                                    <p><span>Kayıt Tarihi : </span> <input type="text" class="dateinput"name="ilan_tarih"required></p>
                                    <p><span>Başlama Tarihi :</span><input type="text" class="dateinput"name="ilan_isbasitarih"required></p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-sitter-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="detail-sitter-text">
                                        <h4> <i class="fa-solid fa-pen-to-square"></i>Açıklama</h4>
                                        <div style="margin-top:30px;"><textarea name="ilan_aciklama" id="editor"></textarea></div>
                                    </div>
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-regular fa-rectangle-list"></i>Çocuk Bakıcısı Olarak Becerilerim</h4>
                                        <div style="margin-top:30px;"><textarea name="ilan_beceri" id="editor2"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="detail-sitter-text">
                                        <h4><i class="fa-solid fa-list-check"></i>Özet</h4>
                                        <div class="detail-sitter-summary">
                                        <p><span>Eğitim Durumu : </span> <input type="text" placeholder="Lise / Üniversite" class="col-input" name="ilan_egitim"required></p>
                                        <p><span>İş Deneyimi : </span> <input type="text" placeholder=" Kaç Yıl" class="col-input" name="ilan_deneyim"required></p>
                                            <p>
                                            <span>Cinsiyet :</span>
                                            <select class="form-select" aria-label="Default select example" name="ilan_cinsiyet" class="col-input"required>
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="KIZ">Kadın</option>
                                                    <option value="ERKEK">Erkek</option>
                                                </select>
                                            </p>
                                            <p><span>Din : </span> <input type="text" placeholder="İnancı" class="col-input" name="ilan_din"required></p>
                                            <p><span>Yabancı Diller : </span> <input type="text" placeholder="İngilizce / Almanca ..." class="" name="ilan_dil"required></p>
                                            <p>
                                                <span>Çalışma Şekli : </span>
                                                <select class="form-select" aria-label="Default select example" name="ilan_calismazaman"required>
                                                    <option selected value="" >Seçiniz</option>
                                                    <option value="PARTİME">Yarı Zamanlı(gündüzlü)</option>
                                                    <option value="FULL">Tam Zamanlı (kalmalı)</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Sigara Kullanımı Var mı ? </span>
                                                <select class="form-select" aria-label="Default select example"name="ilan_sigara"required>
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="kullanıyor">Evet</option>
                                                    <option value="kullanmiyor">Hayır</option>
                                                </select>
                                            </p>
                                            <p>
                                                <span>Ehliyetiniz Var mı ? : </span>
                                                <select class="form-select" aria-label="Default select example" name="ilan_ehliyet"required>
                                                    <option selected value="">Seçiniz</option>
                                                    <option value="var">Evet</option>
                                                    <option value="yok">Hayır</option>
                                                </select>
                                            </p>
                                            <p><span>Hizmet Ücreti : </span> <input type="text" placeholder="Maaş Fiyatı" class="" name="ilan_maas"required></p>
                                        </div>
                                    </div>
                                    <button type="submit" name="advert_insert" class="detail-sitter-footer"> İlanı Kaydet</button>
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