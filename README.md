# Nüfus ve Vatandaşlık İadesi T.C. Kimlik Numarası Doğrulama Servisi
## Ne İşe Yarar?
Adı, Soyadı ve Doğum Yılı bilinen bir kişinin T.C. Kimlik Numarası'nın doğruluğunu kontrol eder.

## Nasıl Kullanılır?
Teknomavi\NVI composer ile kurulabilir. 
Projenizdeki composer.json dosyasında require bölümüne "teknomavi/nvi": "dev-master" eklemeniz ve composer update komutunu çalıştırmanız yeterlidir. 

composer kurulumu/kullanımı hakkında bilgiye ihtiyacınız varsa [bu bağlantıdaki]{http://www.teknomavi.com/yazilim/php/composer-paket-yoneticisi-nedir-nasil-kurulur-nasil-kullanilir/} dökümanı incelebilirsiniz.

### Örnek Kod
```php
include "../vendor/autoload.php";
try {
    $tckimlikno = new \Teknomavi\NVI\TCKimlikNo();
    $response   = $tckimlikno->Dogrula("12345678901", "AD", "SOYAD", 1981);
    if ($response) {
        echo "Doğrulama Başarılı";
    } else {
        echo "Doğrulama Başarısız";
    }
} catch ( \SoapFault $e ) {
    echo "NVI Servisinde bir hata oluştu: " . $e->getMessage();
} catch ( \Teknomavi\NVI\Exception\InvalidTCKimlikNo $e ) {
    echo "Girdiğiniz T.C. Kimlik Numarası geçersiz: " . $e->getMessage();
} catch ( \Exception $e ) {
    echo "Bir Hata Oluştu: " . $e->getMessage();
}

```
