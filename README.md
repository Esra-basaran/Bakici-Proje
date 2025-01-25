## Bakıcı Platformu
Bu proje, bakıcı ilanlarını listeleyen ve iş arayanların başvuru yapabileceği bir PHP tabanlı platformdur. Aşağıda, projenin yapısı ve kurulum adımları detaylı bir şekilde açıklanmıştır.

## 🛠️ Proje Yapısı
assets/ -> CSS, JS, görsel dosyalar
front/ -> Ana çalışma dosyaları
  ├ advert/ -> İlanlarla ilgili dosyalar
  ├ body/   -> Sayfa yapısı bileşenleri
  ├ config/ -> Veritabanı bağlantı dosyası (baglan.php)
  ├ sitters/-> Bakıcı dosyaları
  
## ⚙️Kurulum 
Depoyu Klonla:
git clone https://github.com/kullaniciadiniz/bakici-platformu.git

Veritabanı Yapılandırması:

Veritabanı dosyasını MySQL sunucunuza aktarın:
mysql -u root -p proje < veritabani.sql

baglan.php Ayarı:
front/config/baglan.php dosyasındaki veritabanı bilgilerini düzenleyin.

Sunucuyu Başlat:
php -S localhost:8000

Proje Arayüzünü Aç:
http://localhost:8000

## 🚀 Temel Özellikler
Kullanıcı kayıt ve giriş sistemi
Bakıcı ilanlarını listeleme ve başvuru yapma
Modern ve kullanışlı arayüz

