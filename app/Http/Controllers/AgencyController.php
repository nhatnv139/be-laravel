<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Exceptions\AppException;

class AgencyController extends Controller
{
    public function info(Request $request){

        $agency = Agency::where('id', $request->auto_uid)->where('status', Agency::ACTIVE)->first();
        // dd($agency);
        if(empty($agency)){

            throw new AppException(AppException::ERR_AGENCY_NOT_EXIST, __('agency.not_exist'));
        }
        return $this->_responseJson($agency, 1);
    }
}
