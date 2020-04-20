<?php

namespace App\Responses;

class BaseResponse
{
    public function __construct()
    {
    }


    public function success($code="",$status=200) {
        return response()->json([
            'code'=>$code
        ],$status);
    }

    public function successWithData($code="",$data,$status=200){
        return response()->json([
            'code'=>$code,
            'result'=>$data
        ],$status);
    }

    public function error($code="",$status=400) {
        return response()->json([
            'code'=>$code
        ],$status);
    }

    public function errorWithMessage($code,$msg,$status=400){
        return response()->json([
            'code'=>$code,
            'msg'=>$msg
        ],$status);
    }

    public function validationErrors($errors,$status=400){
        return response()->json([
            'errors'=>$errors,
            'code'=>'validation_errors'
        ],$status);
    }

    public function webError($msg,$status=400){
        return response()->view('errors.webError',['error'=>$msg]);
    }

    public function webSuccess($msg,$status=200){
        return response()->view('success.webSuccess',['msg'=>$msg]);
    }

    // public function relogin($status=401){
    //     return response()->json([
    //         'code'=>'relogin'
    //     ],$status);
    // }

    //function only removes the signature params for security
    protected function sanitizeQueryParams($params){
        if(isset($params['Parameters']) && is_array($params['Parameters'])){
            foreach($params['Parameters'] as $key=>$obj){
                if($obj['Name']=="s" || $obj['Name']=="sg"){
                    unset($params['Parameters'][$key]);
                }
            }
        }
        return $params;
    }
}