<?php

trait CheckParam
{

	/*
	* 检查request_token
	*/
	public  function checkRequestToken($provider) 
	{

		return OAUTH_OK;
	}


	public  function checkOAuthorizeToken()
	{
		$old = $this->store->checkRequestToken($_POST['oauth_token']);
		
		if ($old) {
			$this->store->deleteRequestToken($_POST['oauth_token']);
			return true;
		} 

		return false;
	}


	/*
	* 检查CK和secret
	*/
	public  function checkKeyAndSecret($provider) 
	{
		
		$secret = '7dfbb03a0e';
		// if (empty($secret)) {
		// 	return OAUTH_CONSUMER_KEY_UNKNOWN;
		// }

		$provider->consumer_secret = $secret;
		return OAUTH_OK;
		

	}	

	
	/*
	*检查时间戳和随机字符串
	*/
	public  function checktimestampNonce($provider)
	{
		
		// if (empty($provider->nonce)) {
		// 	return 'false';
		// }
		// if (empty($provider->timestamp)) {
		// 	return 'false';
		// }
	
		return OAUTH_OK;
	}

}