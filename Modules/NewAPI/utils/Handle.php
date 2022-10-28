<?php

namespace Modules\NewAPI\utils;

class Handle
{
    public function errorHandle($status, $statusCode, $message){
        $error_data = [
            'status'=>$status,
            'statusCode'=>$statusCode,
            'message'=>$message,
        ];
        return response()->json($error_data, $statusCode);
    }
    
}