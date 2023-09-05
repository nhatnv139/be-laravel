<?php

namespace App\Http\Middleware;

use closure;
use Illuminate\Http\Request;
use App\Exceptions\AppException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libs\AppJwt;
use Exception;


class DetectAgent
{
    // @param \I
    public function handle(Request $request, Closure $next)
    {
        try {
            //code...
            $token = $request->header('Authorization');
            if ($token && !strlen($token)) {
                return response()->json([
                    'code' => AppException::ERR_TOKEN_NULL,
                    'message' => 'Unauthorization',
                    'count' => 0,
                    'data' => [],
                ]);
            }
            $token = str_replace(' ', '', $token);
            $token = str_replace('Bearer', '', $token);
            $data = JWT::decode($token, new Key(AppJwt::JWT_SECRET, 'HS256'));
            // dd($data);
            $userID = $data->user_id;
            $userIDVerify = AppJwt::decrypt($data->iss, AppJwt::JWT_SECRET);
        } catch (\Throwable $e) {
            //throw $th;
            $excepClass = last(explode('\\', get_class($e)));
            //todo dung co che exception cua bao kim
            return response()->json([
                'code' => AppException::ERR_TOKEN_NULL,
                'message' => __('auth.token_invalid'),
                'count' => 0,
                'data' => [],
            ]);
        }
        if ((int)$userID === (int)$userIDVerify) {
            $request->merge(['auto_uid' => $userID]);
            return $next($request);
        } else {

            throw new AppException(AppException::ERR_AUTHENTICATE_USER, __('auth.authenticate_fail'));
        }
    }
}
