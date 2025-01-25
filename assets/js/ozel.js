// swiper  slider kodları
var swiper = new Swiper(".mySwiper",{
    slidesPerGroup: 1,
    navigation: {nextEl: ".swiper-button-next",prevEl: ".swiper-button-prev",},
    pagination: {el: ".swiper-pagination",clickable: true,},
    breakpoints: {768: {slidesPerView: 1,spaceBetween: 80,},992: {slidesPerView: 1,spaceBetween: 20}}});

$(function(){
    // BAKICI SİGNUP 
    $("#bakici_signup").click(function(){
        $.ajax({
            type:"post",
            url: 'http://localhost/proje/front/config/islem.php',
            data: $("#bakici_form").serialize(),
            success:function(){
                $("#positif").fadeIn(200);
                $("#bakici_form")[0].reset(); // Form sıfırlanıyor
            },
            error:function(hata){
                $("#negatif").fadeIn(200);
            }
        });
    });
     // BAKICI LOGİN
    $("#bakici_girisform").submit(function(e){
        e.preventDefault(); 
        $.ajax({
            type:"post",
            url:"http://localhost/proje/front/config/islem.php",
            data:$("#bakici_girisform").serialize(),
            success:function(cevap){
                if (cevap.success === true) {
                    window.location.href = "sitter.php"; 
                } else {
                    Swal.fire({
                        title: "HATALI GİRİŞ !",
                        text: cevap.message,
                        icon: "error"
                      });
                      setTimeout(function() {
                        window.location.reload();
                       }, 2000);
                }
            },
            error:function(xhr, status, error) {
                console.error("Hata:", error);
                console.log("xhr hatası :", xhr);
            }
        });

    });



    //İLAN SİGNUP
    $("#ilanloginbtn").click(function(){
        $.ajax({
            type:'post',
            url:'http://localhost/proje/front/config/islem.php',
            data:$("#iloginform").serialize(),
            success:function(cevap){
                $("#positif").fadeIn(200);
                $("#iloginform")[0].reset(); // Form sıfırlanıyor
            },
            error:function(){
                $("#negatif").fadeIn(200);
            },
        });
    });
    //İLAN LOGİN
    $("#ilan_giris_form").submit(function(event){
        event.preventDefault();
        $.ajax({
            type:"post",
            url:"http://localhost/proje/front/config/islem.php",
            data:$("#ilan_giris_form").serialize(),
            success:function(cevap){
                if (cevap.success === true) {
                    window.location.href = "advert.php"; 
                } else {
                    Swal.fire({
                        title: "HATALI GİRİŞ !",
                        text: cevap.message ,
                        icon: "error"
                      });
                      setTimeout(function() {
                        window.location.href = "login.php"; 
                    }, 2000);
                }
            },
            error:function(xhr, status, error) {
                console.error("Hata:", error);
                console.log("xhr hatası :", xhr);
            }

        });
    });

    
    //jquery takvim
    $(".dateinput").datepicker();


    //bakici filtreleme
    $("#filterButton").on('click', function() {
        var listele_city = $('#list-city').val();
        var listele_yil = $('#list-yil').val();
        var listele_calismazaman = $('#list-calismazaman').val();
        var listele_fiyat = $('#list-fiyat').val();

        console.log("Seçilen şehir: ", listele_city);
        console.log("Seçilen yil : ", listele_yil);
        console.log("Seçilen calisma: ", listele_calismazaman);
        console.log("Seçilen ücret: ", listele_fiyat);

        $.ajax({
            url: 'http://localhost/proje/front/config/islem.php',
            method: 'POST',
            data: { 
                'list-city': listele_city,
                'list-yil': listele_yil,
                'list-calismazaman': listele_calismazaman,
                'list-fiyat': listele_fiyat,
                'bakici_filtre' : 1
            }, 
            success: function(gelenbakici) {
                $('#sitter').html(gelenbakici);
                $('.sitter_cart').click(function() {
                    var bakicicard  = $(this).closest('#sitter').data('id');
                    var bakiciTarih = $(this).closest('#sitter').data('tarih');
                    var bakiciType = $(this).closest('#sitter').data('type');
                    var basvuranId =$(this).closest('#sitter').data('basvuran');
                    Swal.fire({
                        title: "Başvuru yapmak İstediğinize Emin Misiniz?",
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Evet",
                        denyButtonText: `Hayır`
                      }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "post",
                                url: "http://localhost/proje/front/config/islem.php",
                                data: {
                                    'bakici_ekle':bakicicard,
                                    'bakici_tarih':bakiciTarih,
                                    'bakici_type':bakiciType,
                                    'basvuran_id':basvuranId
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire("Başvuru Yapıldı", "", "success");
                                        setTimeout(function(){
                                            window.location.href = response.message;
                                        },1700);
                                    } else {
                                        alert(response.message);
                                    }
                                }
                             });
                        } else if (result.isDenied) {
                          Swal.fire("Başvuru Yapılmadı !", "", "error");
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error("Hata:", error);
                console.log("XHR nesnesi:", xhr);
            }
        });
    });
    // ilan filtreleme
    $("#ilan_filter_button").on('click',function(){

        var semt = $('#ilan_il').val();
        var yil = $('#ilan_deneyim').val();
        var calisma = $('#ilan_calismazaman').val();
        var maas = $('#ilan_maas').val();

        console.log(semt);
        console.log(yil);
        console.log(calisma);
        console.log(maas);

        $.ajax({
            method:'post',
            url:'http://localhost/proje/front/config/islem.php',
            data: {
                'ilan_il':semt,
                'ilan_deneyim':yil,
                'ilan_calismazaman':calisma,
                'ilan_maas':maas,
                'inputnone':1
              },
            success:function(gelencevap){
                $('.all').html(gelencevap);
                $('.work_cart').click(function() {
                    var ilancart = $(this).closest('#work').data('id'); 
                    var ilanTarih = $(this).closest('#work').data('tarih');
                    var ilanType = $(this).closest('#work').data('type');
                    var basvuranId = $(this).closest('#work').data('basvuran');
            
                    Swal.fire({
                        title: "Başvuru Yap !",
                        text:"Başvuru Yapmak İstediğinize Emin Misiniz ?",
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Evet , İstiyorum ",
                        denyButtonText: `Hayır , İstemiyorum `,
                      }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "post",
                                url: "http://localhost/proje/front/config/islem.php",
                                data: {
                                    'ilan_cart_id': ilancart,
                                    'ilan_tarih': ilanTarih,
                                    'ilan_type': ilanType,
                                    'basvuran_id': basvuranId
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire("Başvuru Yapıldı", "", "success");
                                        setTimeout(function(){
                                            window.location.href = response.message;
                                        },1700);
                                    } else if (response.status === 'error') {
                                        Swal.fire({
                                            title: 'Başvuru Yapamazsınız !',
                                            text: response.message,
                                            icon: 'error',
                                            confirmButtonText:'Tamam'
                                        });
                                    }
                                }
                            });
                        } else if (result.isDenied) {
                          Swal.fire("Başvuru Yapılamadı !", "", "error");
                        }
                      });
                }); 
            },
            error:function(xhr, status, error){
                console.error('zıkkım hatası ' + status + ' - ' + error);
            },
           
        });
    });
 


    //BAKICI veri ekleme
    $("#sitter_insert_form").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'http://localhost/proje/front/config/islem.php',
            data:$("#sitter_insert_form").serialize(),
            success:function(e){
            window.location.href='success.php';
            },
            error:function(){
                alert("başarısız");
            }
        });
    });




    //BAKICI  Özgeçmiş UPDATE
    $("#sitter_update_form").submit(function(ok){
        ok.preventDefault();
        
        // SweetAlert ile onay penceresi açılıyor
        Swal.fire({
            title: "Düzenlemeyi kaydetmek istiyor musunuz?",
            showDenyButton: true,
            confirmButtonText: "Kaydet",
            denyButtonText: "Vazgeçtim"
        }).then((result) => {
            // Kullanıcı 'Kaydet' butonuna tıkladıysa
            if (result.isConfirmed) {
                // AJAX isteği burada başlıyor
                $.ajax({
                    type: "POST",
                    url: 'http://localhost/proje/front/config/islem.php',
                    data: $("#sitter_update_form").serialize(),
                    success: function(response) {
                        // Başarılı olursa SweetAlert'te mesaj göster
                        Swal.fire("Kaydedildi", "", "success");
                        setTimeout(function(){
                            window.location.reload();
                        },1700);
                    },
                    error: function(response) {
                        // Hata olursa alert ile mesaj göster
                        alert(response.message);
                    }
                });
            } else if (result.isDenied) {
                // Kullanıcı 'Vazgeçtim' butonuna tıkladığında bir şey yapma
                Swal.fire("Değişiklikler kaydedilmedi", "", "info");
                window.location.reload();
            }
        });
    });

    //İLAN  Özgeçmiş UPDATE
    $("#advert_update_form").submit(function(event){
        event.preventDefault();
            Swal.fire({
                title: "Değişiklikler kaydedilsim mi?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Kaydet",
                denyButtonText: `Vazgeçtim`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:'post',
                            url: 'http://localhost/proje/front/config/islem.php',
                            data: $("#advert_update_form").serialize(),
                            success:function(response){
                                Swal.fire("Kaydedildi", "", "success");
                                setTimeout(function() {
                                   window.location.reload();
                                }, 1700);
                              
                            },
                            error:function(xhr, status, error){
                               alert("Response: " + xhr.message);
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Değişiklikler Kaydedilmedi", "", "info");
                        window.location.reload();
                    }
            } );

    });




    //İlan Kısmındaki Bakıcı Sepet
    $('.sitter_cart').click(function() {
            var bakicicard  = $(this).closest('#sitter').data('id');
            var bakiciTarih = $(this).closest('#sitter').data('tarih');
            var bakiciType = $(this).closest('#sitter').data('type');
            var basvuranId =$(this).closest('#sitter').data('basvuran');
            Swal.fire({
                title: "Başvuru yapmak İstediğinize Emin Misiniz?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Evet",
                denyButtonText: `Hayır`
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "http://localhost/proje/front/config/islem.php",
                        data: {
                            'bakici_ekle':bakicicard,
                            'bakici_tarih':bakiciTarih,
                            'bakici_type':bakiciType,
                            'basvuran_id':basvuranId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire("Başvuru Yapıldı", "", "success");
                                setTimeout(function(){
                                    window.location.href = response.message;
                                },1700);
                            } else {
                                Swal.fire(response.message,"","error");
                            }
                        }
                     });
                } else if (result.isDenied) {
                  Swal.fire("Başvuru Yapılmadı !", "", "error");
                }
            });
    });
    
    
    //Bakıcı Kısmındaki İlan sepet
    $('.work_cart').click(function() {
        var ilancart = $(this).closest('#work').data('id'); 
        var ilanTarih = $(this).closest('#work').data('tarih');
        var ilanType = $(this).closest('#work').data('type');
        var basvuranId = $(this).closest('#work').data('basvuran');

        Swal.fire({
            title: "Başvuru Yap !",
            text:"Başvuru Yapmak İstediğinize Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , İstiyorum ",
            denyButtonText: `Hayır , İstemiyorum `,
          }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "http://localhost/proje/front/config/islem.php",
                        data: {
                            'ilan_cart_id': ilancart,
                            'ilan_tarih': ilanTarih,
                            'ilan_type': ilanType,
                            'basvuran_id': basvuranId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire("Başvuru Yapıldı", "", "success");
                                setTimeout(function(){
                                    window.location.href = response.message;
                                },1700);
                            } else if (response.status === 'error') {
                                Swal.fire({
                                    title: 'Başvuru Yapamazsınız !',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText:'Tamam'
                                });
                            }
                        }
                    });
            } else if (result.isDenied) {
              Swal.fire("Başvuru Yapılamadı !", "", "error");
            }
          });
    });




      // Detail Bakıcı Kısmındaki İlan sepet
    $('.detail_cart').click(function() {
        var detailcart = $(this).closest('.detail_form').data('id'); 
        var detailTarih = $(this).closest('.detail_form').data('tarih');
        var detailType = $(this).closest('.detail_form').data('type');
        var basvuranId = $(this).closest('.detail_form').data('basvuran');

        Swal.fire({
            title: "Başvuru Yap !",
            text:"Başvuru Yapmak İstediğinize Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , İstiyorum ",
            denyButtonText: `Hayır , İstemiyorum `,
          }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "http://localhost/proje/front/config/islem.php",
                        data: {
                            'idetail_cart': detailcart,
                            'idetail_tarih': detailTarih,
                            'idetail_type': detailType,
                            'basvuran_id': basvuranId

                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire("Başvuru Yapıldı", "", "success");
                                setTimeout(function(){
                                    window.location.href = response.message;
                                },1700);
                            } else if (response.status === 'error') {
                                Swal.fire({
                                    title: 'Başvuru Yapamazsınız !',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText:'Tamam'
                                });
                            }
                        },
                        error:function(){
                            Swal.fire("işlem.php girmiyor ", "", "error");

                        }
                    });
            } else if (result.isDenied) {
              Swal.fire("Başvuru Yapılamadı !", "", "error");
            }
          });
    });

 






    
    //BAKICI ÇIKIS KISMI
    $('#bakici_login_cikis').click(function(){
        Swal.fire({
            title:"Çıkmak İstiyor Musunuz? ",
            showDenyButton: true,
            confirmButtonText: "Evet , Çıkmak İstiyorum",
            denyButtonText: `Hayır , Vazgeçtim !`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/proje/front/config/islem.php',
                    data: { bakici_login_cikis: 1 },  
                    success: function(cevap){
                        if (cevap.status === true){
                            Swal.fire("Çıkış Yapıldı", "", "success");
                            setTimeout(function() {
                                window.location.href = cevap.message;
                            }, 1700);
                        } else {
                            alert(cevap.message);
                        }
                    }
                });
            } else if (result.isDenied) {
              Swal.fire("Çıkış yapılmadı", "", "error");
            }
          });
       
    });

    //İLAN ÇIKIS KISMI
    $('#ilan_login_cikis').click(function(){
        Swal.fire({
            title:"Çıkmak İstiyor Musunuz? ",
            showDenyButton: true,
            confirmButtonText: "Evet , Çıkmak İstiyorum",
            denyButtonText: `Hayır , Vazgeçtim !`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/proje/front/config/islem.php',
                    data: { ilan_login_cikis: 1 },  
                    success: function(cevap){
                        if (cevap.status === true){
                            Swal.fire("Çıkış Yapıldı", "", "success");
                            setTimeout(function() {
                                window.location.href = cevap.message;
                            }, 1700);
                        } else {
                            alert(cevap.message);
                        }
                    }
                });
            } else if (result.isDenied) {
              Swal.fire("Çıkış yapılmadı", "", "error");
            }
          });
    });





    //BAKICI KULLANICI BİLGİ GÜNCELLEME KISMI
    $('#buser-guncelle').click(function(e){
        e.preventDefault();
        Swal.fire({
            title: "Güncellemek istiyor musunuz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet",
            denyButtonText: `Hayır`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:$('#buser-form').serialize(),
                    success:function(){
                        Swal.fire("Kaydedildi !", "", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1700);
                    }

                 });
            } else if (result.isDenied) {
              Swal.fire("İptal Edildi", "", "error");
              setTimeout(function(){
                window.location.reload();
               }, 900);
            }
          });




       

    });

    //İLAN KULLANICI BİLGİ GÜNCELLEME KISMI
    $('#iuser-guncelle').click(function(e){
        e.preventDefault();
        Swal.fire({
            title: "Güncellemek istiyor musunuz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet",
            denyButtonText: `Hayır`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:$('#iuser-form').serialize(),
                    success:function(){
                        Swal.fire("Kaydedildi !", "", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1700);
                    }
                 });
            } else if (result.isDenied) {
              Swal.fire("Güncelleme Gerçekleşmedi", "", "error");
              setTimeout(function(){
                window.location.reload();
               }, 900);
            }
          });
    });






    //BAKICI KULLANICI KISMINDA İLAN SİLME
    $('.cart_clean').click(function(){

        var cardid = $(this).closest('#work').data('id'); 

        Swal.fire({
            title: "Başvuruyu Silmek İstediğinizden Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , Sil",
            denyButtonText: `Hayır ,Silme`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:{'cart_sil':cardid},
                    success:function(cevap){
                        if(cevap.status == true){
                            Swal.fire(cevap.message, "", "success");
                            $('#work[data-id="' + cardid + '"]').remove();
                            setTimeout(function() {
                                window.location.reload();
                            }, 1700);
                        }
                    }
                });
            } else if (result.isDenied) {
              Swal.fire("Başvuru Silinmedi ! ", "", "error");
            }
          });
    });

     //İLAN KULLANICI KISMINDA BAKİCİ SİLME
     $('.bakici_clean').click(function(){
        var bakicid = $(this).closest('#sitter').data('id'); 
        Swal.fire({
            title: "Başvuruyu Silmek İstediğinizden Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , Sil",
            denyButtonText: `Hayır ,Silme`
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:{'bakici_sil':bakicid},
                    success:function(cevap){
                        if(cevap.status == true){
                            Swal.fire(cevap.message, "", "success");
                            $('#sitter[data-id="' + bakicid + '"]').remove();
                            setTimeout(function() {
                                window.location.reload();
                            }, 1700);
                        }
                    }
                });
            } else if (result.isDenied) {
              Swal.fire("Başvuru Silinmedi ! ", "", "error");
            }
          });
    });


    



    //İLAN KISMINDAKİ APPLİCATİON (APPLİCATİON-SEPET VE APPLİCATİON-DETAİL KISIMLARINDAN SİLME İŞLEMİ);
    $('.iapp_clean').click(function(){

        var gelen_id = $(this).closest('#app_sitter').data('id'); 
        var gelen_detail = $(this).closest('#detail_form_clean').data('id'); 

        Swal.fire({
            title: "Başvuruyu Silmek İstediğinizden Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , Sil",
            denyButtonText: `Hayır ,Silme`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:{
                        'i_app_sil': gelen_id,
                        'i_app_detail_sil':gelen_detail
                    },
                    success:function(cevap){
                        if(cevap.status == true){
                            Swal.fire(cevap.message, "", "success");

                            setTimeout(function(){
                                window.location.reload();
                            },1700);
                        }
                    },
                    error:function(){
                        Swal.fire(cevap.message, "", "error");
                    }
                });
            } else if (result.isDenied) {
            Swal.fire("Başvuru Silinmedi ! ", "", "error");
            }
        });
    });

    //BAKICI KISMIDAKİ APPLİCATİON (APPLİCATİON-SEPET VE APPLİCATİON-DETAİL KISMINDAN SİLME İŞLEMİ);
    $('.app_clean').click(function(){

        var gelen_id = $(this).closest('#app_work').data('id'); // aplication kısmı
        var gelen_detail = $(this).closest('.detail_form_clean').data('id'); // aplicationun detayına giridğimizdeki kısım

        Swal.fire({
            title: "Başvuruyu Silmek İstediğinizden Emin Misiniz ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Evet , Sil",
            denyButtonText: `Hayır ,Silme`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'http://localhost/proje/front/config/islem.php',
                    data:{
                        'app_sil': gelen_id,
                        'app_detail_sil':gelen_detail
                    },
                    success:function(cevap){
                        if(cevap.status == true){
                            Swal.fire(cevap.message, "", "success");
                            setTimeout(function(){
                                window.location.reload();
                            },1700);
                        }
                    },
                    error:function(){
                        Swal.fire(cevap.message, "", "error");
                    }
                });
            } else if (result.isDenied) {
            Swal.fire("Başvuru Silinmedi ! ", "", "error");
            }
        });
    });



   


// BAKICININ APPLİCATİON KISMINDA  ONAY DURUMU BİTMEDİİ!!!!!

$('.okBtn').click(function(){

    var app_onay = $(this).closest('#app_work').data('id');
    var iapp_onay = $(this).closest('#app_sitter').data('id');


    Swal.fire({
        title: "Başvuruyu Kabul Etmek İstediğinize Emin Misiniz?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Evet, Onaylıyorum",
        denyButtonText: "Hayır, Onaylamıyorum"
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX isteği gönder
            $.ajax({
                type: 'post',
                url: 'http://localhost/proje/front/config/islem.php',
                data: { 
                    'app_onay': app_onay,
                    'iapp_onay':iapp_onay
                 },
                success: function() {
                    // Onay mesajını otomatik kapanan Swal ile göster
                    let timerInterval;
                    Swal.fire({
                        title: "Başvurunuz Onaylandı!",
                        html: "Bilgileriniz İş Verene Gönderiliyor... <b></b> ",
                        timer: 3500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector('b');
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        // Zamanlayıcıyla kapandıktan sonra 
                        if (result.dismiss === Swal.DismissReason.timer) {
                            $('#app_work').remove();
                            $('#app_sitter').remove();

                        }
                    });
                },
                error: function() {
                    Swal.fire("İşlem başarısız oldu!", "", "error");
                }
            });
        } else if (result.isDenied) {
            Swal.fire("Başvuru reddedildi.", "", "info");
        }
    });
});





});


