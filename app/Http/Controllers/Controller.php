<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\AppException;
use App\Models\Agency;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function _responseJson($data, $count = 0, $message = '')
    {   
        if(!$message){
            $message = __('common.success');
        }
        return response()->json([
            'code'=>AppException::ERR_NONE,
            'message'=> $message,
            'count'=>$count,
            'data'=>$data,
        ]);
    }

    public function _responseErrorJson($code, $message = ''){
        if (!$message) {
            $message = trans('exception.'.$code);
        }
        return response()->json([
            'code'=>$code,
            'message'=>$message,
            'count'=>0,
            'data'=>[],
        ]);
    }

    public function getAgency($request){
        // DB::connection()->enableQueryLog();
        $agency = Agency::where('id', $request->auto_uid)->where('status', Agency::ACTIVE)->first();
        // Log::info(DB::getQueryLog());
        if(empty($agency)){
            throw new AppException(AppException::ERR_AGENCY_NOT_EXIST, __('agency.not_exist'));
            
        }
        return $agency;
    }
}
