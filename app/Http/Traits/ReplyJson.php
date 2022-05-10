<?php
namespace App\Http\Traits;

trait ReplyJson {
    public function CreateJsonResponse($response_id,$status,$data,$error){
        return response()->json(['code'=>$response_id,'data'=>$data,'error'=>$error],200,[],JSON_NUMERIC_CHECK);
    }

    public function CreateJsonResponseFloat($response_id,$data,$error){
	return response()->json(['code'=>$response_id,'data'=>$data,'error'=>$error],200,[],JSON_PRESERVE_ZERO_FRACTION);
    }
}