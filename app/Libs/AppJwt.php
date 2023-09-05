<?php

namespace App\Libs;

use Firebase\JWT\JWT;
use App\Libs\Config;

class AppJwt{

    const ISD_TOKEN = 1;
    const ISD_REFRESH_TOKEN = 2;
    const JWT_SECRET = "5482389d348cfbe3634d4cbacd12c4fd7cc2e4e6fbf77a129c773c45da1bbf09";
    const JWT_EXPIRE = 6000;

    public $secret;
    public $expire;

    public function __construct()
    {
        $this->secret = self::JWT_SECRET;
        $this->expire = self::JWT_EXPIRE;
    }

    public function create($data, $isd = self::ISD_TOKEN){
        $issuedAt   = time();
        $expire     = $issuedAt + $this->expire;
        
        $defaultParams = [
            'iat'  => $issuedAt,
            'exp'  => $expire,
            "iss" => self::encrypt($data['user_id'], $this->secret),
            "isd" => $isd, //1: token, 2: refrest token => encrypt 3DES
        ];
        $token = array_merge($data, $defaultParams);
        return JWT::encode($token, $this->secret, 'HS256');
    }

	public static function encrypt($str, $key){
        $iv = substr(hash('sha256', $key), 0, 16);
        return openssl_encrypt ($str, 'aes-256-cbc', $key, 0, $iv);
    }

    public static function decrypt($str, $key){
        $iv = substr(hash('sha256', $key), 0, 16);
        return openssl_decrypt ($str, 'aes-256-cbc', $key, 0, $iv);
    }
}