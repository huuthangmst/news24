<?php

namespace Modules\NewAPI\Http\Services;

class CheckApiKey
{
    public function __construct($request)
    {
        $this->key=$request;
    }
    public function ckeckApiKey($apiKeyDB){

        $key = $this->key->apiKey;

        $keyDB = json_decode($apiKeyDB->where('apiKey', $key)->get());

        if($keyDB != null){
            return true;
        }
        else{
            return false;
        }
    }
}