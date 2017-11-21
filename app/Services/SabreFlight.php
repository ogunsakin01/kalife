<?php

namespace App\Services;

use App\Services\SabreConfig;

class SabreFlight
{
    public function __construct(){
      $this->sabreConfig = new SabreConfig();
    }
    public function doCall($headersXml, $body, $action) {
        //Data, connection, auth
        $soapUrl = "https://sws-crt.cert.havail.sabre.com";
        // xml post structure
        $xml_post_string = '<SOAP-ENV:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">'
            . '<SOAP-ENV:Header>'
            . $headersXml
            . '</SOAP-ENV:Header>'
            . '<SOAP-ENV:Body>'
            . $body
            . '</SOAP-ENV:Body>'
            . '</SOAP-ENV:Envelope>';

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: " . $action,
            "Content-length: " . strlen($xml_post_string)
        );


    }

    public function xmlHeader()
    {
        $xml = new \DOMDocument('', '');
        $xml_env = $xml->createElement('SOAP-ENV:Envelope');

        $xml->appendChild($xml_env);

    }

}