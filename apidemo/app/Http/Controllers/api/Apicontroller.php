<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;         
use Validator;

class Apicontroller extends ApiController
{
    // 登录用户名标示为phone字段
    public function username()
    {
        return 'phone';
    }
    //登录接口，调用了ApiController中一些其他函数succeed\failed，上文未提及，用于接口格式化输出
    public function login(Request $request)
	{
    	$validator = Validator::make($request->all(), [
	        'phone'    => 'required|exists:users',
	        'password' => 'required|between:6,32',
        ]);

        if ($validator->fails()) {
	        $request->request->add([
	            'errors' => $validator->errors()->toArray(),
	            'code' => 401,
	            ]);                     
        	return $this->sendFailedLoginResponse($request);
    	}

	    $credentials = $this->credentials($request);

		if ($this->guard('api')->attempt($credentials, $request->has('remember'))) {
		    return $this->sendLoginResponse($request);
		}

    	return $this->failed('login failed',401);
    }
}
