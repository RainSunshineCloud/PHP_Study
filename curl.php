<?php

/**
 * @Author   RyanWu
 * @DateTime 2018-01-29
 * @param    string     $url       请求地址
 * @param    array      $field     请求参数
 * @param    string     $method    请求方法 ，现只用put,get,post,delete
 * @param    array      &$error    错误信息
 * @param    boolean    $isDisplay 是否直接输出显示
 * @return   mix                   请求返回信息
 */
function request_resource ($url,array $field =[],$method='get',array &$error=[],$isDisplay=false)
{
	//初始化
	if ( !$ch = curl_init($url) ) {

		$error = [
			'errMsg'=>curl_error($ch),
			'errorNo'=>curl_errno($ch),
		];

		return false;
	}

	//若为https请求，关闭对等证书验证
	if (stripos($url,'https://') === 0 ) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	}

	//请求方式
	$method = strtoupper((string)$method);
		if (! in_array($method,['PUT','GET','POST','DELETE'])) {
			$error = [
			'errMsg'=>'请求方式只能是PUT,GET,POST,DELETE里面的一种',
			'errorNo'=>100,
		];

		return false;
		}
    $opt[CURLOPT_CUSTOMREQUEST] = $method;

		//是否显示
		if ($isDisplay === false) {
			$opt[CURLOPT_RETURNTRANSFER] = true;
		} 

		//传参
		$opt[CURLOPT_POSTFIELDS] = json_encode($field);

		//执行
    curl_setopt_array($ch,$opt);
    $res = curl_exec($ch);
		if ( $res === false ) {
			$error = [
			'errMsg'=>curl_error($ch),
			'errorNo'=>curl_errno($ch),
		];
		return false;
		}
		curl_close($ch);
		return $res; 

}


