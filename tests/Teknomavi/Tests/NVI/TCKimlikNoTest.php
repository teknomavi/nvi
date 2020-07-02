<?php
namespace Teknomavi\Tests\NVI;

use Teknomavi\NVI\Exception\InvalidTCKimlikNo;
use Teknomavi\NVI\TCKimlikNo;

class TCKimlikNoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Teknomavi\NVI\TCKimlikNo::dogrula
     * @covers \Teknomavi\NVI\Service\KPSPublic\KPSPublic::__construct
     * @covers \Teknomavi\NVI\Service\KPSPublic\KPSPublic::kimlikNoDogrula
     *
     * @uses   \Teknomavi\NVI\TCKimlikNo::kontrolEt
     */
    public function testDogrula()
    {
        try {
            $tckimlikno = new TCKimlikNo();
            $this->assertTrue($tckimlikno->dogrula('10000000146', 'GAZİ MUSTAFA KEMAL PAŞA', 'ATATÜRK', 1881));
            $this->assertFalse($tckimlikno->dogrula('10000000146', 'MUSTAFA KEMAL', 'ATATÜRK', 1881));
        } catch (\SoapFault $e) {
            echo 'NVI Servisinde bir hata oluştu: ' . $e->getMessage();
        } catch (InvalidTCKimlikNo $e) {
            echo 'Girdiğiniz T.C. Kimlik Numarası geçersiz: ' . $e->getMessage();
        } catch (\Exception $e) {
            echo 'Bir Hata Oluştu: ' . $e->getMessage();
        }
    }

    /**
     * @covers \Teknomavi\NVI\TCKimlikNo::kontrolEt
     */
    public function testKontrolEt()
    {
        $tckimlikno = new TCKimlikNo();
        $this->assertFalse($tckimlikno->kontrolEt('1000000014'));
        $this->assertFalse($tckimlikno->kontrolEt('10000000145'));
        $this->assertFalse($tckimlikno->kontrolEt('10200000148'));
        $this->assertTrue($tckimlikno->kontrolEt('10000000146'));
    }

    /**
     * @covers \Teknomavi\NVI\TCKimlikNo::dogrula
     *
     * @uses   \Teknomavi\NVI\TCKimlikNo::dogrula
     * @expectedException \Teknomavi\NVI\Exception\InvalidTCKimlikNo
     */
    public function testInvalidTCKimlikNo()
    {
        $tckimlikno = new TCKimlikNo();
        $tckimlikno->dogrula('12345678901', 'GAZİ MUSTAFA KEMAL PAŞA', 'ATATÜRK', 1881);
    }
}
