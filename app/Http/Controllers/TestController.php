<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test()
    {
        return $this->getLatLong('河内大酒店');
    }


    function getLatLong($address){
        $ak='GPIrsdfZ-UNLRP-VBBDB-V3AGK-XL5KO-5DBNY';
        $address='深圳市龙华新区民治大道横岭5区';
//http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding 

$url="http://apis.map.qq.com/ws/geocoder/v1/?address={$address}&key={$ak}";
$json=file_get_contents($url);
$data=json_decode($json,TRUE);
dump($data);

    }


}
