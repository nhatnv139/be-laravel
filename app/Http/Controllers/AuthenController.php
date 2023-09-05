<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AppException;
use App\Libs\AppJwt;

class AuthenController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'

        ]);
        $agency = Agency::where('username', $request->username)->first();
        // dd( $agency);
        
        if(!$agency){
            return self::_responseErrorJson(AppException::ERR_USER_NOT_FOUND, "Agency is not exist");
        }
        if($agency->status == Agency::INACTIVE){
            throw new AppException(AppException::ERR_USER_INACTIVE, "Agency is inactive");
        }
        // dd(Hash::check(trim($request->password), $agency->password));
       
        if(Hash::check(trim($request->password), $agency->password)){
            $data = [
                'user_id' => $agency->id,
                'username' => $agency->username,
                'email' => $agency->email,
                'address' => $agency->status,
            ];
            $model = new AppJwt();
            $data['token']= $model->create($data);
            $data['expires_in'] = AppJwt::JWT_EXPIRE;
            // dd( $data);
    
            return self::_responseJson($data, 1, __('common.success'));
        }
        throw new AppException(AppException::ERR_LOGIN_FAIL, "Username or password invalid");
    }
}
