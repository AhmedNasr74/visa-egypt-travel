<?php

namespace App\Services;

use App\Interface\UserCheck;
use Illuminate\Http\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Illuminate\Support\Facades\Http;
use Hibit\GeoDetect;


class UserCountry implements UserCheck
{
        public function check($data){
            if($data){
            $geoDetect = new GeoDetect();
            $request=new Request();
            //dd($data->ip(),$request->ip());
            // $clientIpAddress = "156.193.237.172";
            $clientIp = $data->ip();
            $clientIpAddress = "198.16.66.101";
            $country = $geoDetect->getCountry($clientIp);
            $userConId=$country->getGeonameId();
            $userISO=$country->getIsoCode();
            $userConName=$country->getName();
            $userEro=$country->isInEuropeanUnion();
        if($userConName!=='Egypt'){
            $userConName="Other";
        }
        return $userConName;
            }
    }

}

