<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendError($error, $errorMessages = [], $code = NULL)
    {

         if(empty($code)){
            $code = 403;
         }
    	$response = [
            "code" =>  $code,

            'success' => false,
            'error_message' => $error,
            'body'   =>[]
        ];

        if(!empty($errorMessages)){
            $response['error_message'] = (object) $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendSucess($error, $errorMessages = [], $code = NULL)
    {

         if(empty($code)){
            $code = 200;
         }
    	$response = [
            "code" =>  $code,
            'success' => True,
            'message' => $error,
            'body'   =>[]
        ];

        if(!empty($errorMessages)){
            $response['error_message'] = (object) $errorMessages;
        }

        return response()->json($response, $code);
    }
}
