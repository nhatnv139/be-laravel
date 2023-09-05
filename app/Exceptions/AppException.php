<?php 

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppException extends Exception{

	const ERR_NONE = '00';
	const ERR_VALIDATION = '01';
	const ERR_TOKEN_NULL = '02';
	const ERR_SYSTEM = '03';
    const ERR_LOGIN_FAIL = '04';
    const ERR_AUTHENTICATE_USER = '05';
    const ERR_USER_NOT_FOUND = '06';
    const ERR_CATEGORY_NOT_EXIST = '07';
    const ERR_PRODUCT_NOT_EXIST = '08';
    const ERR_TOPIC_NOT_EXIST = '09';
    const ERR_POST_NOT_EXIST = '10';
    const ERR_ORDER_PRODUCT_DUPLICATE = '11';
    const ERR_PHONE_INVALID = '12';
    const ERR_EMAIl_INVALID = '13';
    const ERR_FORBIDDEN = '14';
    const ERR_PROVINCE_NOT_EXIST = '15';
    const ERR_DISTRICT_NOT_EXIST = '16';
    const ERR_PROMOTION_CODE_INVALID = '17';
    const ERR_DEPARTMENT_NO_EXIST = '18';
    const ERR_ROLE_NO_EXIST = '18';
    const ERR_STAFF_NO_EXIST = '19';
    const ERR_USER_INACTIVE = '20';
    const ERR_NO_PERMISSION = '21';
    const ERR_BANK_NOT_FOUND = '22';
    const ERR_BALANCE_NOT_EXIST = '23';
    const ERR_PAYMENT_TYPE_NOT_EXIST = '24';
    const ERR_FUNCTION_MAINTAIN = '25';
    const ERR_OVER_MAX_AMOUNT = '26';
    const ERR_AMOUNT_OVER_BALANCE = '27';

    const ERR_AGENCY_NOT_EXIST = '28';

	public $code = '00';

	public $message  = '';

	public function __construct($code, $message, $data = []){

		if (!$message) {
            $message = trans('exception.'.$code, $data);
        }

        if (!$code) {
            $code = Response::HTTP_BAD_GATEWAY;
        }

        $this->code = $code;
        $this->message = $message ?: 'Server Exception';

        parent::__construct($message, $code);
	}

	public function render(Request $request) {
        $json = [
            'code' => $this->code,
//            'message' => [$this->message],
            'message' => $this->message,
            'data' => null,
            'count' => 0,
        ];
        return new JsonResponse($json);
    }

    public function report() {
        Log::emergency($this->message);
    }
}