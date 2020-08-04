<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

class SoapController
{
    /**
     * @var SoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }



    /**
     * Use the SoapWrapper
     */
    public function show(){
        $location = 'http://nwbc.socar.az:6000/sap/bc/srt/rfc/sap/yws_scholarship/600/yws_scholarship/yws_scholarship';
        $request = $this->soapWrapper->add('CreateSession', function ($service){
            $service
                ->wsdl('http://192.168.17.49:8000/sap/bc/srt/wsdl/flv_10002A101AD1/bndg_url/sap/bc/srt/rfc/sap/yws_scholarship/600/yws_scholarship/yws_scholarship?sap-client=600')
                ->trace(true)
                ->options([
                    'login' => 'hrregister',
                    'password' => 'HR@reg20',
                ]);
        });

//        var_dump($request);
        $data = [
            'ImFincode' =>'69gnac3'
        ];

        $response = $this->soapWrapper->call('CreateSession.YfmScholarship', $data);

        var_dump($response);
    }
}