<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/20/2017
 * Time: 2:47 PM
 */

namespace App\Services;


class SabreConfig{
    public $client_domain = 'EXT';
    public $client_group = 'DEVCENTER';
    public $user_id = 'i2rin8bj06voqx9u';
    public $client_secret = '4RAilVp3';
    public $format_version = 'V1';
    public $restTestEnvironment = 'https://api-crt.cert.havail.sabre.com';
    public $restProductionEnvironment = ' https://api.havail.sabre.com';
    public $soapTestEnvironment = 'https://sws-crt.cert.havail.sabre.com';
    public $soapProductionEnvironment = 'https://webservices.havail.sabre.com';
    public function buildClientId(){
        return $this->format_version.":".$this->user_id.":".$this->client_group.":".$this->client_domain;
    }
}