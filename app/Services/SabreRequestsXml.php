<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 11/21/2017
 * Time: 10:56 AM
 */

namespace App\Services;

use App\Services\SabreConfig;
class SabreRequestsXml{
    public function __construct(){
        $this->sabreConfig = new SabreConfig();
    }

}