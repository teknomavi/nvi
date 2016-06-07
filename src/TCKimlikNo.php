<?php
namespace Teknomavi\NVI;

use Teknomavi\Common\Text;
use Teknomavi\NVI\Service\KPSPublic\KPSPublic;
use Teknomavi\NVI\Service\KPSPublic\TCKimlikNoDogrulaRequest;

class TCKimlikNo
{
    /**
     * Kimlik bilgileri verilen kişinin T.C. Numarasının doğruluğunu kontrol eder.
     *
     * @param int    $TCKimlikNo T.C. Kimlik Numarası
     * @param string $ad         Ad
     * @param string $soyad      Soyad
     * @param int    $dogumYili  4 basamaklı doğum yılı ( Örn: 1981 )
     *
     * @throws Exception\InvalidTCKimlikNo
     * @return bool
     */
    public function dogrula($TCKimlikNo, $ad, $soyad, $dogumYili)
    {
        if (!$this->kontrolEt($TCKimlikNo)) {
            throw new Exception\InvalidTCKimlikNo($TCKimlikNo);
        }
        $client = new KPSPublic('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
        $request = new TCKimlikNoDogrulaRequest();
        // Webservise gönderilen talepte TC Kimlik Numarası integer olmalı.
        $request->TCKimlikNo = $TCKimlikNo * 1;
        $request->Ad = Text::strToUpper($ad);
        $request->Soyad = Text::strToUpper($soyad);
        $request->DogumYili = $dogumYili * 1;
        $response = $client->kimlikNoDogrula($request);

        return $response->TCKimlikNoDogrulaResult;
    }

    /**
     * Verilen numarayı T.C. Kimlik Numarası algoritması ile kontrol eder
     *
     * @see http://tr.wikipedia.org/wiki/Türkiye_Cumhuriyeti_Kimlik_Numarası
     *
     * @param mixed $number
     *
     * @return bool
     */
    public function kontrolEt($number)
    {
        $number = (string) $number;
        if (strlen($number) != 11) {
            return false;
        }
        $l = str_split($number);
        if (($l[0] + $l[1] + $l[2] + $l[3] + $l[4] + $l[5] + $l[6] + $l[7] + $l[8] + $l[9]) % 10 != $l[10]) {
            return false;
        }
        if ((($l[0] + $l[2] + $l[4] + $l[6] + $l[8]) * 8) % 10 != $l[10]) {
            return false;
        }
        if ((($l[0] + $l[2] + $l[4] + $l[6] + $l[8]) * 7 + ($l[1] + $l[3] + $l[5] + $l[7]) * 9) % 10 != $l[9]) {
            return false;
        }

        return true;
    }
}
