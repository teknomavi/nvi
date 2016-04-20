<?php
namespace Teknomavi\NVI\Service\KPSPublic;

class KPSPublic extends \SoapClient
{
    /**
     * Default class map for wsdl=>php.
     *
     * @var array
     */
    private static $classmap = [
        'TCKimlikNoDogrula'         => 'TCKimlikNoDogrulaRequest',
        'TCKimlikNoDogrulaResponse' => 'TCKimlikNoDogrulaResponse',
    ];

    /**
     * Constructor using wsdl location and options array.
     *
     * @param string $wsdl    WSDL location for this service
     * @param array  $options Options for the SoapClient
     */
    public function __construct($wsdl = 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL', $options = [])
    {
        foreach (self::$classmap as $wsdlClassName => $phpClassName) {
            if (!isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = '\\' . __NAMESPACE__ . '\\' . $phpClassName;
            }
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * Service Call: TCKimlikNoDogrula.
     *
     * @param TCKimlikNoDogrulaRequest $request
     *
     * @throws \Exception invalid function signature message
     *
     * @return TCKimlikNoDogrulaResponse
     */
    public function TCKimlikNoDogrula(TCKimlikNoDogrulaRequest $request)
    {
        return $this->__soapCall('TCKimlikNoDogrula', func_get_args());
    }
}
